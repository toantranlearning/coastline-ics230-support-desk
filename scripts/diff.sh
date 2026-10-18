#!/usr/bin/env bash
cd "$(dirname "$0")/.." || exit 1
diff -ru --exclude=portal.sqlite --exclude='portal.sqlite-*' --exclude=.env site fixed
