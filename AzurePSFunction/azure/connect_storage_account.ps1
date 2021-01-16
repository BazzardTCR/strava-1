Connect-AzAccount 
Install-Module AzTable
$ResourceGroup = "Strava"
$StorageName  = "stravabazzard"
$StorageKey=(Get-AzStorageAccountKey -ResourceGroupName $ResourceGroup -Name $StorageName).Value[0]
$ctx = New-AzStorageContext -StorageAccountName $StorageName -StorageAccountKey $StorageKey
Get-AzStorageTable -Context $ctx

$tableName = Get-AzStorageTable –Context $context | select -ExpandProperty Name
$storageTable = Get-AzStorageTable –Name $tableName –Context $ctx

$cloudTable = (Get-AzStorageTable –Name $tableName –Context $ctx).CloudTable

Import-Csv "C:\scripts\strava-1-1\AzurePSFunction\Strava\output\stravafew.csv"  -Delimiter ";" |foreach {
    Clear-Variable var*
    $VAR_resource_state = $_.resource_state
    $VAR_athlete = $_.athlete
    $VAR_name = $_.name
    $VAR_distance = $_.distance
    $VAR_moving_time = $_.moving_time
    $VAR_elapsed_time = $_.elapsed_time
    $VAR_total_elevation_gain = $_.total_elevation_gain
    $VAR_type = $_.type
    $VAR_id = $_.id
    $VAR_external_id = $_.external_id
    $VAR_upload_id = $_.upload_id
    $VAR_start_date = $_.start_date
    $VAR_start_date_local = $_.start_date_local
    $VAR_timezone = $_.timezone
    $VAR_utc_offset = $_.utc_offset
    $VAR_start_latlng = $_.start_latlng
    $VAR_end_latlng = $_.end_latlng
    $VAR_location_city = $_.location_city
    $VAR_location_state = $_.location_state
    $VAR_location_country = $_.location_country
    $VAR_start_latitude = $_.start_latitude
    $VAR_start_longitude = $_.start_longitude
    $VAR_achievement_count = $_.achievement_count
    $VAR_kudos_count = $_.kudos_count
    $VAR_comment_count = $_.comment_count
    $VAR_athlete_count = $_.athlete_count
    $VAR_photo_count = $_.photo_count
    #$VAR_map = $_.map
    $VAR_trainer = $_.trainer
    $VAR_commute = $_.commute
    $VAR_manual = $_.manual
    $VAR_private = $_.private
    $VAR_visibility = $_.visibility
    $VAR_flagged = $_.flagged
    $VAR_gear_id = $_.gear_id
    $VAR_from_accepted_tag = $_.from_accepted_tag
    $VAR_upload_id_str = $_.upload_id_str
    $VAR_average_speed = $_.average_speed
    $VAR_max_speed = $_.max_speed
    $VAR_average_cadence = $_.average_cadence
    $VAR_average_watts = $_.average_watts
    $VAR_weighted_average_watts = $_.weighted_average_watts
    $VAR_kilojoules = $_.kilojoules
    $VAR_device_watts = $_.device_watts
    $VAR_has_heartrate = $_.has_heartrate
    $VAR_average_heartrate = $_.average_heartrate
    $VAR_max_heartrate = $_.max_heartrate
    $VAR_heartrate_opt_out = $_.heartrate_opt_out
    $VAR_display_hide_heartrate_option = $_.display_hide_heartrate_option
    $VAR_max_watts = $_.max_watts
    $VAR_elev_high = $_.elev_high
    $VAR_elev_low = $_.elev_low
    $VAR_pr_count = $_.pr_count
    $VAR_total_photo_count = $_.total_photo_count
    $VAR_has_kudoed = $_.has_kudoed
    $VAR_suffer_score = $_.suffer_score
    
[decimal]$speed = 3.6
[decimal]$result = $VAR_average_speed*$speed
Write-Host $result
# add four rows 
<# Add-AzTableRow `
    -table $cloudTable `
    -partitionKey $VAR_type `
    -rowKey ("$VAR_id") -property @{"resource_state"=$VAR_resource_state;"athlete"=$VAR_athlete;"name"=$VAR_name;"distance"=$VAR_distance;"moving_time"=$VAR_moving_time;"elapsed_time"=$VAR_elapsed_time;"total_elevation_gain"=$VAR_total_elevation_gain;"external_id"=$VAR_external_id;"upload_id"=$VAR_upload_id;"start_date"=$VAR_start_date;"start_date_local"=$VAR_start_date_local;"timezone"=$VAR_timezone;"utc_offset"=$VAR_utc_offset;"start_latlng"=$VAR_start_latlng;"end_latlng"=$VAR_end_latlng;"location_city"=$VAR_location_city;"location_state"=$VAR_location_state;"location_country"=$VAR_location_country;"start_latitude"=$VAR_start_latitude;"start_longitude"=$VAR_start_longitude;"achievement_count"=$VAR_achievement_count;"kudos_count"=$VAR_kudos_count;"comment_count"=$VAR_comment_count;"athlete_count"=$VAR_athlete_count;"photo_count"=$VAR_photo_count;"trainer"=$VAR_trainer;"commute"=$VAR_commute;"manual"=$VAR_manual;"private"=$VAR_private;"visibility"=$VAR_visibility;"flagged"=$VAR_flagged;"gear_id"=$VAR_gear_id;"from_accepted_tag"=$VAR_from_accepted_tag;"upload_id_str"=$VAR_upload_id_str;"average_speed"=$VAR_average_speed;"max_speed"=$VAR_max_speed;"average_cadence"=$VAR_average_cadence;"average_watts"=$VAR_average_watts;"weighted_average_watts"=$VAR_weighted_average_watts;"kilojoules"=$VAR_kilojoules;"device_watts"=$VAR_device_watts;"has_heartrate"=$VAR_has_heartrate;"average_heartrate"=$VAR_average_heartrate;"max_heartrate"=$VAR_max_heartrate;"heartrate_opt_out"=$VAR_heartrate_opt_out;"display_hide_heartrate_option"=$VAR_display_hide_heartrate_option;"max_watts"=$VAR_max_watts;"elev_high"=$VAR_elev_high;"elev_low"=$VAR_elev_low;"pr_count"=$VAR_pr_count;"total_photo_count"=$VAR_total_photo_count;"has_kudoed"=$VAR_has_kudoed;"suffer_score"=$VAR_suffer_score;}
 #>
}