<?php 
$point=$_REQUEST['points'];
$lat='';
$long='';
if($point)
{
	$cord=explode(",",$point);
	$lat=$cord[0];
	$long=$cord[1];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script type='text/javascript' 
            src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap' 
            async defer></script>
    <script type='text/javascript'>
    function GetMap() {
        var map = new Microsoft.Maps.Map('#myMap', {
            credentials: 'AgJaAKHCNMoCQJnO4cbZh18WRL-TiuOx5TS5QQLFVU9oN5qffxjJS0GUpqS_Sh5f'
        });

        //Request the user's location
			var loc = new Microsoft.Maps.Location(
                <?php echo $lat; ?>,
               <?php echo $long; ?>);

            //Add a pushpin at the user's location.
            var pin = new Microsoft.Maps.Pushpin(loc);
            map.entities.push(pin);

            //Center the map on the user's location.
            map.setView({ center: loc, zoom: 10 });
	}
</script>
</head>
<body>
    <div id="myMap" style="position:relative;width:100%;height:800px;"></div> 
</body>
</html>