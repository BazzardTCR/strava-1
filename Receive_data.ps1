

$page = 1
$PerPage =50
$ExportPath = "C:\Users\bas.berkhout\OneDrive - Corendon\Documenten\Scripts\strava-1\strava-csv1.csv"

do {
    Write-Host "Loading page $page"
    $act_url = "https://www.strava.com/api/v3/athlete/activities?page=$page&per_page=$PerPage&access_token=$accesstoken"
    $result= Invoke-WebRequest $act_url
    ($result.content |ConvertFrom-Json) | Export-Csv $ExportPath -append -Delimiter ';' -Force -NoClobber
    $page++
    Write-Host "Page up to $page"
#}until ($page -eq '3')
} until ($result.Content -eq "[]")

