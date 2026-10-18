#!/usr/bin/env bash
# Run from any directory. Never delete another checkout or overwrite repairs.
set -euo pipefail
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"
if ! php -r 'exit(in_array("sqlite", PDO::getAvailableDrivers(), true) ? 0 : 1);' ; then
  if command -v apt-get >/dev/null && command -v sudo >/dev/null; then
    sudo apt-get update -qq
    sudo apt-get install -y php-sqlite3
  fi
fi
php -r 'exit(in_array("sqlite", PDO::getAvailableDrivers(), true) ? 0 : 1);'  || { echo "PHP PDO SQLite is required; contact your instructor."; exit 1; }
mkdir -p .lab-runtime reports
for copy in site fixed; do
  [ -f "$copy/router.php" ] || { echo "Missing $copy/router.php; reopen the correct course folder."; exit 1; }
  if [ "$copy" = site ]; then port=8080; else port=8081; fi
  pidfile="$ROOT/.lab-runtime/$copy.pid"
  if [ -f "$pidfile" ]; then
    pid="$(cat "$pidfile")"
    if [[ "$pid" =~ ^[0-9]+$ ]] && ps -p "$pid" -o command= | grep -F -- "$ROOT/$copy/router.php" >/dev/null; then
      kill "$pid" 2>/dev/null || true
      sleep 1
    fi
  fi
  (
    cd "$ROOT/$copy"
    # Each process reads only its own environment and database.
    if [ -f .env ]; then set -a; . ./.env; set +a; fi
    nohup php -d opcache.enable=0 -d opcache.enable_cli=0 -d "session.name=TECHCORP_$copy" -S "0.0.0.0:$port" -t "$ROOT/$copy" "$ROOT/$copy/router.php" > "$ROOT/.lab-runtime/$copy.log" 2>&1 &
    echo $! > "$pidfile"
  )
  sleep 1
  pid="$(cat "$pidfile")"
  if ! kill -0 "$pid" 2>/dev/null || grep -q 'Failed to listen' ".lab-runtime/$copy.log"; then
    echo "Could not start $copy on port $port. See .lab-runtime/$copy.log."
    cat ".lab-runtime/$copy.log"
    exit 1
  fi
  echo "$copy portal is running on port $port."
done
echo "Web Preview: 8080 = site (original); Change port to 8081 = fixed (your repairs)."
echo "Edit fixed/; keep reports/ at the workspace root. Startup preserves both databases and all repairs."
