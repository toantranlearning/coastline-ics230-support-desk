#!/usr/bin/env bash
#
# Start completely over: remove every copy of the project and fetch a fresh one.
# Use this when something is so tangled that a reset is not enough. It throws
# away every change you have made.

REPO="https://github.com/toantranlearning/coastline-ics230-support-desk.git"
BASE="$HOME/cloudshell_open/coastline-ics230-support-desk"

# Where the terminal was when this was run, before any cd. This removes every
# copy, so the caller's folder is gone afterward and we must point them back.
LAUNCH_DIR="$PWD"

echo "This removes every copy of the project, including all your changes, and"
printf "fetches a brand-new one. Continue? [y/N] "
read -r a
[ "$a" = y ] || [ "$a" = Y ] || { echo "Cancelled."; exit 0; }

pkill -f 'php -S' >/dev/null 2>&1
cd "$HOME/cloudshell_open" 2>/dev/null || cd "$HOME"
rm -rf "$BASE"*
echo "Fetching a fresh copy..."
git clone --quiet "$REPO" "$BASE" || { echo "Could not fetch the project. Check your connection and try again."; exit 1; }
echo "Fresh copy ready. If the file list looks empty, refresh it."
echo
cd "$BASE" && bash scripts/start.sh

# The caller's folder was removed with the rest, so their terminal is orphaned.
# A script cannot change its parent shell, so say what to run.
if [ ! -d "$LAUNCH_DIR" ] || [ "$LAUNCH_DIR" != "$BASE" ]; then
  echo
  echo "Your terminal is not in the project folder. Move into it:"
  echo "  cd $BASE"
fi
