#!/usr/bin/env bash
# Restore only fixed/. Never reset the repository or touch reports/ and site/.
set -euo pipefail
cd "$(dirname "$0")/.."
case "${1:-}" in
  ""|--baseline) ;;
  *) echo "Usage: bash scripts/reset.sh [--baseline]"; exit 1 ;;
esac
echo "This replaces fixed/ with site/, including the starting database state. All repairs in fixed/ will be lost."
echo "Download submitted work first. site/ and reports/ are preserved."
printf 'Continue? [y/N] '
read -r answer
[[ "$answer" = y || "$answer" = Y ]] || { echo "Cancelled."; exit 0; }
# Move aside rather than delete so accidental resets can be recovered.
mkdir -p .lab-runtime
backup="$(mktemp -d "$PWD/.lab-runtime/fixed-reset-XXXXXXXX")"
mv fixed "$backup/fixed"
cp -a site fixed
rm -f fixed/data/portal.sqlite fixed/data/portal.sqlite-wal fixed/data/portal.sqlite-shm
printf 'Previous fixed copy kept in %s/fixed
' "$backup"
echo "Run bash scripts/start.sh to reopen both portals."
