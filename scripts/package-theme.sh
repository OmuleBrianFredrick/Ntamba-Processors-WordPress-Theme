#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME="$ROOT/ntamba-processors"
ZIP="$ROOT/ntamba-processors.zip"

test -f "$THEME/style.css" || { echo "Missing style.css" >&2; exit 1; }
test -f "$THEME/index.php" || { echo "Missing index.php" >&2; exit 1; }
rm -f "$ZIP"
(cd "$ROOT" && zip -qr "$ZIP" "ntamba-processors")
echo "Created: $ZIP"
echo "Upload through WordPress > Appearance > Themes > Add New > Upload Theme."