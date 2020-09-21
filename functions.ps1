Clear-Variable -Name auth*
function StravaAuth  {
    [CmdletBinding()]
    param (
 
    [Parameter(Mandatory=$true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $clientid,

        [Parameter(Mandatory=$true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $client_secret,

        [Parameter(Mandatory=$true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $refresh_token
    )
    $authresults = Invoke-WebRequest "https://www.strava.com/oauth/token?client_id=$clientid&client_secret=$client_secret&refresh_token=$refresh_token&grant_type=refresh_token" -Method Post 
    $null = @(
    $authresults.Content
    
    $chararry = $authresults.Content.Split(",")
 #  $chararry[1]
    $authaccesstoken= $chararry[1].Substring(16).Trim('"') #remove the fist char and the quots 
<#     $expiresat = $chararry[2]
    $expiresin = $chararry[3]
    $refreshtoken = $chararry[4] #>
    )


return $authaccesstoken
}

#

function StravaReciveActivities {
    param (
        
    )

    do {
        Write-Host "Loading page $page"
        $act_url = "https://www.strava.com/api/v3/athlete/activities?page=$page&per_page=$PerPage&access_token=$accesstoken"
        $result= Invoke-WebRequest $act_url
        ($result.content |ConvertFrom-Json) | Export-Csv $ExportPath -append -Delimiter ';' -Force -NoClobber
        $page++
        Write-Host "Page up to $page"
    #}until ($page -eq '3')
    } until ($result.Content -eq "[]") 
}

$page = 1
$PerPage =50
$ExportPath = "C:\Users\bas.berkhout\OneDrive - Corendon\Documenten\Scripts\strava-1\strava-csv1.csv"

