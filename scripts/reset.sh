#!/usr/bin/env bash
# Put the portal back to a known-good state and rebuild its database.
#
#   ./scripts/reset.sh                     discard changes you have not saved
#   ./scripts/reset.sh --undo              step back one saved change
#   ./scripts/reset.sh --checkpoint <name> restore a saved checkpoint
#   ./scripts/reset.sh --baseline          go all the way back to the original
#
# This rewrites files. Anything you have not saved with save.sh is lost.
set -e
cd "$(dirname "$0")/.."

confirm() {
  printf "%s Continue? [y/N] " "$1"
  read -r a
  [ "$a" = y ] || [ "$a" = Y ] || { echo "Cancelled."; exit 0; }
}

case "${1:-}" in
  "")
    confirm "This discards changes you have not saved, back to your last save."
    git checkout -- .
    ;;
  --undo)
    saves=$(git rev-list baseline..HEAD --count 2>/dev/null || echo 0)
    if [ "$saves" -eq 0 ]; then
      echo "You are already at the original; there is nothing to undo."
      exit 0
    fi
    confirm "This steps back one saved change."
    git reset --hard HEAD~1 >/dev/null
    ;;
  --baseline)
    confirm "This goes all the way back to the original."
    git fetch --tags --quiet 2>/dev/null || true
    git reset --hard baseline >/dev/null
    ;;
  --checkpoint)
    [ -z "${2:-}" ] && { echo "Which checkpoint? e.g. ./scripts/reset.sh --checkpoint v1"; exit 1; }
    ref="checkpoint-${2}"
    confirm "This restores the saved checkpoint ${ref}."
    git fetch --tags --quiet 2>/dev/null || true
    git checkout "$ref" -- . 2>/dev/null || { echo "No checkpoint named '$ref' exists yet."; exit 1; }
    ;;
  *)
    echo "Unknown option: $1"
    echo "Try: ./scripts/reset.sh | --undo | --checkpoint <name> | --baseline"
    exit 1
    ;;
esac

rm -f data/portal.sqlite
echo "Done. The database rebuilds the next time you open a page."
