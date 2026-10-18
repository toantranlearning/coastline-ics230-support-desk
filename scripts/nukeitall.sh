#!/usr/bin/env bash
# Compatibility entry point: preserve workspace, reports, and original source.
set -euo pipefail
cd "$(dirname "$0")/.."
echo "A fresh working copy now uses the scoped reset; no checkouts are deleted."
bash scripts/reset.sh --baseline
