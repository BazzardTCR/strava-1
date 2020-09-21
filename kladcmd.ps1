$NWAdapters = Get-NetAdapter 
foreach ($adapter in $NWAdapters){
  
   Get-NetIPAddress -InterfaceIndex $adapter.ifIndex |select InterfaceAlias, IPAddress
}


Get-NetIPAddress -InterfaceIndex 38