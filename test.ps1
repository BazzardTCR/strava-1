. .\functions.ps1

$authclientid = 52753
$authclient_secret = '63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289' #generated from my own account, a seperate account is needed when releasing it.
$authrefresh_token = '780372a3a3bb4a6fe56b143df30923db40c085af' #this code is static and you receive this with the first round oauth

StravaAuth -clientid $authclientid -client_secret $authclient_secret -refresh_token $authrefresh_token