
function StravaAuth {
    [CmdletBinding()]
    param (
 
        [Parameter(Mandatory = $true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $clientid,

        [Parameter(Mandatory = $true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $client_secret,

        [Parameter(Mandatory = $true)]
        [ValidateNotNullOrEmpty()]
        [String[]] $refresh_token
    )
    $authresults = Invoke-WebRequest "https://www.strava.com/oauth/token?client_id=$clientid&client_secret=$client_secret&refresh_token=$refresh_token&grant_type=refresh_token" -Method Post 
    $null = @(
        $authresults.Content
    
        $chararry = $authresults.Content.Split(",")
        #  $chararry[1]
        $authaccesstoken = $chararry[1].Substring(16).Trim('"') #remove the fist char and the quots 

    )


    return $authaccesstoken
}


function StravaReciveActivities {
    [cmdletbinding()]
    param (
        # items per page
        [Parameter(Mandatory = $true)]
         [ValidateNotNullOrEmpty()] 
        [String[]] $accesstoken,

        # export path 
        [Parameter(Mandatory = $true)]
        [ValidateNotNullOrEmpty()]
         $ExportPath
        
    )
        $page =1 
        $PerPage = 50 
    do {

        Write-Host "Loading page $page"
        $act_url = "https://www.strava.com/api/v3/athlete/activities?page=$page&per_page=$PerPage&access_token=$accesstoken"
        $result = Invoke-WebRequest $act_url
        ($result.content | ConvertFrom-Json) | Export-Csv $ExportPath -append -Delimiter ';' -Force -NoClobber -NoTypeInformation
        $page++
        Write-Host "Page up to $page"
        
    } until ($result.Content -eq "[]") 
}

function clearvars {
       Clear-Variable -Name accesstoken, ExportPath
}