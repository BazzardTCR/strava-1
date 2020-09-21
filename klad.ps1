

1) Get authorization code from authorization page. This is a one time, manual step. 
Paste the below code in a browser, hit enter then grab the "code" part from the resulting url. 

https://www.strava.com/oauth/authorize?client_id=your_client_id&redirect_uri=http://localhost&response_type=code&scope=activity:read_all

2) Exchange authorization code for access token & refresh token

https://www.strava.com/oauth/token?client_id=your_client_id&client_secret=your_client_secret&code=your_code_from_previous_step&grant_type=authorization_code

3) View your activities using the access token just received

https://www.strava.com/api/v3/athlete/activities?access_token=access_token_from_previous_step

3) Use refresh token to get new access tokens

https://www.strava.com/oauth/token?client_id=your_client_id&client_secret=your_client_secret&refresh_token=your_refresh_token_from_previous_step&grant_type=refresh_token


write-host "bla"


https://www.strava.com/oauth/token?client_id=52753&client_secret=63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289&code=b275248e74e105bafeb87086a36be578297e5309&grant_type=authorization_code


https://www.strava.com/api/v3/athlete/activities?access_token=b8d4430e0598cd6f11ea9984bea943bd3ddb5da2


https://www.strava.com/oauth/token?client_id=your_client_id&client_secret=your_client_secret&refresh_token=your_refresh_token_from_previous_step&grant_type=refresh_token


https://www.strava.com/oauth/token?client_id=52753&client_secret=63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289&refresh_token=b8d4430e0598cd6f11ea9984bea943bd3ddb5da2&grant_type=refresh_token


https://www.strava.com/oauth/token?client_id=your_client_id&client_secret=your_client_secret&refresh_token=your_refresh_token_from_previous_step&grant_type=refresh_token
$health ='Good'
$everyone = 'Happy'

if (($health -eq 'Good') -and ($everyone -eq 'Happy')) {
    write-host "Im happy"}
    else {
        Write-Host "Come here and get your free hug"
    }