#!/usr/bin/env bash
# Save your work so far, as one save point you can come back to.
# Usage: ./scripts/save.sh "what you changed"
set -e
cd "$(dirname "$0")/.."
msg="${1:-work in progress}"
git add -A
git commit -m "$msg" >/dev/null 2>&1 && echo "Saved: $msg" || echo "Nothing new to save."
