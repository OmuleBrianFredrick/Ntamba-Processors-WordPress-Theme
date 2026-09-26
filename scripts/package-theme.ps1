$ErrorActionPreference = "Stop"
$repoRoot = Split-Path -Parent $PSScriptRoot
$themeDir = Join-Path $repoRoot "ntamba-processors"
$zipPath = Join-Path $repoRoot "ntamba-processors.zip"

if (-not (Test-Path (Join-Path $themeDir "style.css"))) {
  throw "Theme folder is missing style.css: $themeDir"
}
if (-not (Test-Path (Join-Path $themeDir "index.php"))) {
  throw "Theme folder is missing index.php: $themeDir"
}

if (Test-Path $zipPath) { Remove-Item $zipPath -Force }
Compress-Archive -Path $themeDir -DestinationPath $zipPath -CompressionLevel Optimal
Write-Host "Created: $zipPath"
Write-Host "Upload this ZIP through WordPress > Appearance > Themes > Add New > Upload Theme."