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
  # These two ports are reserved for the course portals. A previous launch
  # can belong to an older checkout, so its PID file is not reliable here.
  if command -v lsof >/dev/null 2>&1; then
    listeners="$(lsof -tiTCP:"$port" -sTCP:LISTEN || true)"
    if [ -n "$listeners" ]; then
      kill $listeners 2>/dev/null || true
      for attempt in {1..10}; do
        listeners="$(lsof -tiTCP:"$port" -sTCP:LISTEN || true)"
        [ -z "$listeners" ] && break
        sleep 0.2
      done
      [ -z "$listeners" ] || kill -KILL $listeners 2>/dev/null || true
    fi
  elif command -v fuser >/dev/null 2>&1; then
    fuser -k -TERM "${port}/tcp" >/dev/null 2>&1 || true
    for attempt in {1..10}; do
      fuser "${port}/tcp" >/dev/null 2>&1 || break
      sleep 0.2
    done
    fuser -k -KILL "${port}/tcp" >/dev/null 2>&1 || true
  else
    echo "Cannot free port $port: fuser or lsof is required."
    exit 1
  fi
  pidfile="$ROOT/.lab-runtime/$copy.pid"
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
