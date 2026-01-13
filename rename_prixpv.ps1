$old = "prixPv"
$new = "PrixPv"

$dirs = @(
    "app\Http",
    "resources\views"
)

foreach ($dir in $dirs) {
    if (Test-Path $dir) {
        Write-Host "Scanning $dir ..."
        Get-ChildItem -Path $dir -Recurse -File | ForEach-Object {
            (Get-Content $_.FullName) -replace $old, $new | Set-Content $_.FullName
            Write-Host "Updated $($_.FullName)"
        }
    } else {
        Write-Host "Directory not found: $dir"
    }
}

Write-Host "✅ Done!"
