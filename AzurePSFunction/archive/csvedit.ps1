$csv = Import-Csv -Path $ExportPath -Delimiter ';'
$csv.distance | Measure-Object -sum