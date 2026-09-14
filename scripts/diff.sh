#!/usr/bin/env bash
# Show everything you have changed since the original. Run this before you reset.
cd "$(dirname "$0")/.."
if ! git rev-parse baseline >/dev/null 2>&1; then
  git fetch --tags --quiet 2>/dev/null || true
fi
git --no-pager diff baseline
