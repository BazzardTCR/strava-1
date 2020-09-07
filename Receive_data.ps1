

$page = 1
$PerPage =100

$act_url = "https://www.strava.com/api/v3/athlete/activities?page=$page&per_page=$PerPage&access_token=$accesstoken"

$result= Invoke-WebRequest $act_url

do {
    $result= Invoke-WebRequest $act_url
    ($result.content |ConvertFrom-Json) | Export-Csv c:\scripts\strava-1\strava-csv1.csv -notype -append -Delimiter ';'
    $page++
} until ($result.Content -eq "[]")

