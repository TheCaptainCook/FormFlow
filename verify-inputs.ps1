$dir = 'c:\Users\Masem\Downloads\0. old\Claude Work\Contact Form Main\FormFlow\includes\nodes\input'
Get-ChildItem -Path $dir -Filter '*.php' | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    $id = [regex]::Match($content, "public function get_id\(\)\s*\{\s*return\s*'([^']+)'").Groups[1].Value
    $cat = [regex]::Match($content, "public function get_category\(\)\s*\{\s*return\s*'([^']+)'").Groups[1].Value
    $tier = [regex]::Match($content, "public function get_tier\(\)\s*\{\s*return\s*'([^']+)'").Groups[1].Value
    Write-Output "$($_.Name) | ID: $id | Cat: $cat | Tier: $tier"
}
