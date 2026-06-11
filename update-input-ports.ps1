$dir = 'c:\Users\Masem\Downloads\0. old\Claude Work\Contact Form Main\FormFlow\includes\nodes\input'
Get-ChildItem -Path $dir -Filter '*.php' | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    $content = $content -replace "'inputs'\s*=>\s*array\(\),", "'inputs'  => array('priority-in'),"
    $content = $content -replace "'outputs'\s*=>\s*array\(\),", "'outputs' => array('priority-out'),"
    [IO.File]::WriteAllText($_.FullName, $content)
}
Write-Output "Done updating ports for input nodes."
