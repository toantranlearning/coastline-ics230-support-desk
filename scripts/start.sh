#!/usr/bin/env bash
#
# One-run setup and launcher for the TechCorp portal in Google Cloud Shell.
# It checks what is already done and only does the missing parts, so it is safe
# to run every time.

# Where the working copy lives (its natural clone path).
BASE="$HOME/cloudshell_open/coastline-ics230-support-desk"
# This script sits in scripts/, so the project root is its parent.
SELF="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# Where the terminal was when this was run, before any cd, so we can tell if the
# cleanup below removed the folder it is sitting in.
LAUNCH_DIR="$PWD"

# Keep a single copy. Clicking the launch link more than once makes extra
# folders whose names are the repo name plus a suffix (name-0, name-1, ...).
# Step out of the way first, then remove every copy except the canonical one,
# so you always end up with exactly one. (The editor's file list may still show
# a removed folder until you refresh it, but it is gone on disk.)
cd "$HOME/cloudshell_open" 2>/dev/null || cd "$HOME"

# A canonical folder emptied out (a "start over" that deleted the files but left
# the folder behind) must not win over a fresh clone.
if [ -d "$BASE" ] && [ ! -f "$BASE/scripts/start.sh" ]; then
  rm -rf "$BASE"
fi

# If there is no canonical copy yet but we launched from a suffixed one,
# promote it to the canonical name.
if [ ! -d "$BASE" ] && [ -d "$SELF" ] && [ "$SELF" != "$BASE" ]; then
  mv "$SELF" "$BASE"
fi

# Remove any folder that is the repo name plus a suffix.
for d in "$BASE"*; do
  [ -d "$d" ] && [ "$d" != "$BASE" ] && rm -rf "$d" && echo "Removed a duplicate copy: $(basename "$d")"
done

cd "$BASE" 2>/dev/null || cd "$SELF"

# Dependencies: only add what is missing. Cloud Shell's PHP ships without the
# SQLite driver and forgets anything outside your home between sessions, so
# check for it and add it when it is not there.
if ! php -m 2>/dev/null | grep -qi '^pdo_sqlite$'; then
  echo "Enabling the SQLite database driver..."
  sudo apt-get update -qq >/dev/null 2>&1 || true
  sudo apt-get install -y php-sqlite3 >/dev/null 2>&1 || true
fi

# Turn the editor's Gemini Code Assist off by default so its panel does not open.
# Written to the editor's global and user settings, keeping any existing settings
# and never overriding a choice you later make. Takes effect on the next load.
python3 - <<'PYEOF' 2>/dev/null || true
import json, os
paths = [os.path.expanduser("~/.codeoss/data/Machine/settings.json"),
         os.path.expanduser("~/.codeoss/data/User/settings.json")]
keys = ("geminicodeassist.enable",
        "cloudcode.geminiCodeAssist.enable",
        "cloudcode.enableGeminiCodeAssist",
        "geminicodeassist.inlineSuggestions.enableAuto",
        "cloudcode.geminiCodeAssist.inlineSuggestions.enableAuto")
for p in paths:
    os.makedirs(os.path.dirname(p), exist_ok=True)
    try:
        d = json.load(open(p)); d = d if isinstance(d, dict) else {}
    except Exception:
        d = {}
    for k in keys:
        d.setdefault(k, False)
    json.dump(d, open(p, "w"), indent=2)
PYEOF

# Keep the editor's Source Control panel to just this project. Gemini leaves a
# history folder in your home directory that shows up as its own repo; Gemini is
# off, so this leftover is unused. Clear it.
rm -rf ~/.gemini/history 2>/dev/null || true

# Start the portal in the background so the terminal stays free. Stop anything
# already holding port 8080 first, however it was started, so running this again
# always gives a fresh, working portal.
freed=""
command -v fuser >/dev/null 2>&1 && fuser -k 8080/tcp >/dev/null 2>&1 && freed=1
pkill -f 'php -S .*:8080' >/dev/null 2>&1 && freed=1
[ -n "$freed" ] && { sleep 1; echo "Stopped an earlier portal that was still running."; }
LOG=/tmp/techcorp-portal.log
nohup php -S 0.0.0.0:8080 >"$LOG" 2>&1 &
disown 2>/dev/null
sleep 1
if pgrep -f 'php -S 0.0.0.0:8080' >/dev/null 2>&1; then
  echo
  echo "The portal is running on port 8080 in the background. Your terminal is free."
  echo "Click Web Preview and choose port 8080."
  echo "(Server log: $LOG. To stop the portal: pkill -f 'php -S')"
else
  echo "The portal did not start. The last lines of its log:"
  tail -5 "$LOG" 2>/dev/null
  exit 1
fi

# If this was run from a duplicate folder that just got removed, the terminal is
# now sitting in a folder that no longer exists. We cannot move the terminal for
# you (a script cannot change its parent shell), so say what to run.
if [ ! -d "$LAUNCH_DIR" ] || [ "$LAUNCH_DIR" != "$BASE" ]; then
  echo
  echo "Your terminal is not in the project folder. Move into it so the other"
  echo "commands work:"
  echo "  cd $BASE"
fi
