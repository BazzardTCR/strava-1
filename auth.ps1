
$clientid = 52753
$client_secret = '63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289' #generated from my own account, a seperate account is needed when releasing it.
$refresh_token = '780372a3a3bb4a6fe56b143df30923db40c085af' #this code is static and you receive this with the first round oauth


    $authresults = Invoke-WebRequest "https://www.strava.com/oauth/token?client_id=$clientid&client_secret=$client_secret&refresh_token=$refresh_token&grant_type=refresh_token" -Method Post 
    
    $authresults.Content
    
    $chararry = $authresults.Content.Split(",")
    $chararry[1]
    $accesstoken= $chararry[1].Substring(16).Trim('"') #remove the fist char and the quots 
    $expiresat = $chararry[2]
    $expiresin = $chararry[3]
    $refreshtoken = $chararry[4]


StravaAuth
$accesstoken
$accesstoken
$expiresat 
$expiresin 
$refreshtoken 


https://www.strava.com/api/v3/athlete/activities?page=2&per_page=100&access_token=3b31dcb8ffc64c3f4983a3f7be6db43e561d0972


$act_url = "https://www.strava.com/api/v3/athlete/activities?access_token=$accesstoken"

$result= Invoke-WebRequest $act_url

$result.Content  | Out-File C:\scripts\strava.json

$id.id.Count = $result.Content |ConvertFrom-Json | ConvertTo-Csv C:\scripts\strava.csv

((Get-Content -Path C:\scripts\strava.json) | ConvertFrom-Json) |
    ConvertTo-Csv -NoTypeInformation |
    Set-Content C:\scripts\strava.csv

    $JSON = Get-Content -Raw -Path C:\scripts\strava.json | ConvertFrom-Json

    $export = $JSON | Select-Object -Property name,distance,type,start_date,moving_time | ForEach-Object {
        New-Object -TypeName PSObject -Property @{
            name = $_.Name
            distance = $_.distance
        
    } Select-Object Name, distance
}



    Write-Host $_.Name $_.distance $_.moving_time $_.type $_.start_date 
$export | Export-Csv C:\scripts\straveclean.csv

