

((get-content $file ) | ConvertFrom-Json)| Export-Csv c:\scripts\strava-1\strava-csv1.csv -notype -append -Delimiter ';'