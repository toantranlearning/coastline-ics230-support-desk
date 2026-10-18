#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
git add -- fixed
git diff --cached --quiet -- fixed && { echo "No changed source files in fixed/ to save."; exit 0; }
git commit --only -m "${1:-Save portal repairs}" -- fixed
