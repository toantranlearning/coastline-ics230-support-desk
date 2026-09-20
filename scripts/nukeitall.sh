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
echo "fetches a brand-new one. Your reports folder is kept."
printf "Continue? [y/N] "
read -r a
[ "$a" = y ] || [ "$a" = Y ] || { echo "Cancelled."; exit 0; }

pkill -f 'php -S' >/dev/null 2>&1
cd "$HOME/cloudshell_open" 2>/dev/null || cd "$HOME"

# Your write-ups are yours, so set them aside before anything is removed. The
# canonical copy goes first; a file that is already set aside is never replaced.
KEEP="$HOME/.techcorp-reports-keep"
# A set-aside folder left by an earlier run that could not finish goes back
# into the project first, without replacing anything newer.
if [ -d "$KEEP" ] && [ -d "$BASE" ]; then
  mkdir -p "$BASE/reports"
  cp -Rn "$KEEP/." "$BASE/reports/" 2>/dev/null
  rm -rf "$KEEP"
fi
for d in "$BASE" "$BASE"-*; do
  if [ -d "$d/reports" ]; then
    mkdir -p "$KEEP"
    cp -Rn "$d/reports/." "$KEEP/" 2>/dev/null
  fi
done

rm -rf "$BASE"*
echo "Fetching a fresh copy..."
if ! git clone --quiet "$REPO" "$BASE"; then
  echo "Could not fetch the project. Check your connection and try again."
  [ -d "$KEEP" ] && echo "Your reports are safe in $KEEP."
  exit 1
fi

# Put the write-ups back, without replacing anything the fresh copy ships.
if [ -d "$KEEP" ]; then
  mkdir -p "$BASE/reports"
  cp -Rn "$KEEP/." "$BASE/reports/" 2>/dev/null
  # Remove the set-aside copy only when every file in it made it back.
  left=""
  while IFS= read -r f; do
    [ -e "$BASE/reports/$f" ] || left=1
  done < <(cd "$KEEP" && find . -type f)
  if [ -z "$left" ]; then
    rm -rf "$KEEP"
    echo "Your reports folder is back in place."
  else
    echo "Some reports could not be put back. They are safe in $KEEP."
  fi
fi
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
