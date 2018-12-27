<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script type='text/javascript' 
            src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap' 
            async defer></script>
    <script type='text/javascript'>
    //var map, watchId, userPin;

    /*function GetMap()
    {
        map = new Microsoft.Maps.Map('#myMap', {
            credentials: 'AgJaAKHCNMoCQJnO4cbZh18WRL-TiuOx5TS5QQLFVU9oN5qffxjJS0GUpqS_Sh5f'
        });
    }
*/

	 var map;

   /* function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {
            credentials: 'AgJaAKHCNMoCQJnO4cbZh18WRL-TiuOx5TS5QQLFVU9oN5qffxjJS0GUpqS_Sh5f'
        });

        //Load the spatial math module
        Microsoft.Maps.loadModule("Microsoft.Maps.SpatialMath", function () {
            //Request the user's location
            navigator.geolocation.getCurrentPosition(function (position) {
                var loc = new Microsoft.Maps.Location(position.coords.latitude, position.coords.longitude);

                //Create an accuracy circle
                var path = Microsoft.Maps.SpatialMath.getRegularPolygon(loc, position.coords.accuracy, 36,  Microsoft.Maps.SpatialMath.Meters);
                var poly = new Microsoft.Maps.Polygon(path);
                map.entities.push(poly);

                //Add a pushpin at the user's location.
                var pin = new Microsoft.Maps.Pushpin(loc);
                map.entities.push(pin);

                //Center the map on the user's location.
                map.setView({ center: loc, zoom: 10 });
            });
        });
    }*/

    function GetMap() {
        var map = new Microsoft.Maps.Map('#myMap', {
            credentials: 'AgJaAKHCNMoCQJnO4cbZh18WRL-TiuOx5TS5QQLFVU9oN5qffxjJS0GUpqS_Sh5f'
        });

        //Request the user's location
        navigator.geolocation.getCurrentPosition(function (position) {
            var loc = new Microsoft.Maps.Location(
                position.coords.latitude,
                position.coords.longitude);

            //Add a pushpin at the user's location.
            var pin = new Microsoft.Maps.Pushpin(loc);
            map.entities.push(pin);

            //Center the map on the user's location.
            map.setView({ center: loc, zoom: 10 });
        },function (e){    
}, {maximumAge:600000, timeout:5000, enableHighAccuracy: true});
    } 
	

    </script>
</head>
<body>
    <div id="myMap" style="position:relative;width:600px;height:400px;"></div>
    <input type="button" value="Start Continuous Tracking" onclick="StartTracking()" />
    <input type="button" value="Stop Continuous Tracking" onclick="StopTracking()"/>
</body>
</html>