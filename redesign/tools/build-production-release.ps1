param(
    [string]$ProjectRoot = (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path,
    [string]$OutputRoot = (Join-Path (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path 'local_staging')
)

$ErrorActionPreference = 'Stop'

$redesignRoot = Join-Path $ProjectRoot 'redesign'
$releaseId = 'vista-production-' + (Get-Date -Format 'yyyyMMdd-HHmmss')
$releaseRoot = Join-Path $OutputRoot $releaseId
$appRoot = Join-Path $releaseRoot 'redesign'

New-Item -ItemType Directory -Path $appRoot -Force | Out-Null

foreach ($directory in @('app', 'assets', 'components', 'config', 'data', 'layouts', 'views')) {
    Copy-Item -LiteralPath (Join-Path $redesignRoot $directory) -Destination $appRoot -Recurse
}

Copy-Item -LiteralPath (Join-Path $redesignRoot 'index.php') -Destination $appRoot
Copy-Item -LiteralPath (Join-Path $redesignRoot 'deploy\public-index.php') -Destination (Join-Path $releaseRoot 'index.php')
Copy-Item -LiteralPath (Join-Path $redesignRoot 'deploy\public-htaccess') -Destination (Join-Path $releaseRoot '.htaccess')
Copy-Item -LiteralPath (Join-Path $redesignRoot 'deploy\public-user.ini') -Destination (Join-Path $releaseRoot '.user.ini')

$commit = (git -C $ProjectRoot rev-parse HEAD).Trim()
$files = Get-ChildItem -LiteralPath $releaseRoot -Recurse -File | Sort-Object FullName
$manifestFiles = foreach ($file in $files) {
    [ordered]@{
        path = $file.FullName.Substring($releaseRoot.Length + 1).Replace('\', '/')
        bytes = $file.Length
        sha256 = (Get-FileHash -LiteralPath $file.FullName -Algorithm SHA256).Hash.ToLowerInvariant()
    }
}

$manifest = [ordered]@{
    releaseId = $releaseId
    commit = $commit
    createdAtUtc = (Get-Date).ToUniversalTime().ToString('o')
    minimumPhp = '8.1'
    fileCount = $manifestFiles.Count
    totalBytes = ($files | Measure-Object Length -Sum).Sum
    files = $manifestFiles
}

$manifestPath = $releaseRoot + '.manifest.json'
$manifest | ConvertTo-Json -Depth 5 | Set-Content -LiteralPath $manifestPath -Encoding utf8

$archivePath = $releaseRoot + '.tar.gz'
& tar -czf $archivePath -C $releaseRoot .
if ($LASTEXITCODE -ne 0) {
    throw 'tar failed while creating the production archive.'
}

[pscustomobject]@{
    ReleaseId = $releaseId
    Directory = $releaseRoot
    Archive = $archivePath
    Manifest = $manifestPath
    ArchiveBytes = (Get-Item -LiteralPath $archivePath).Length
    ArchiveSha256 = (Get-FileHash -LiteralPath $archivePath -Algorithm SHA256).Hash
    Files = $manifestFiles.Count
    PayloadBytes = $manifest.totalBytes
}
