<!DOCTYPE html>
    <html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<style type="text/css">
    	body, html{width: 100%;height: 100%;margin:0;font-family:"????";}
    	#allmap {width: 100%; height:500px; overflow: hidden;}
    	#result {width:100%;font-size:12px;}
    	dl,dt,dd,ul,li{
    		margin:0;
    		padding:0;
    		list-style:none;
    	}
    	p{font-size:12px;}
    	dt{
    		font-size:14px;
    		font-family:"????"; // This is the font family
    		font-weight:bold;
    		border-bottom:1px dotted #000;
    		padding:5px 0 5px 5px;
    		margin:5px 0;
    	}
    	dd{
    		padding:5px 0 0 5px;
    	}
    	li{
    		line-height:28px;
    	}
    	</style>
    	<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=yourAPIKey"></script>
    	<!--Load the drawing tools (Drawing Manager)-->
    	<script type="text/javascript" src="https://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
    	<link rel="stylesheet" href="https://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
    	<!--Load search information window-->
    	<script type="text/javascript" src="https://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
    	<link rel="stylesheet" href="https://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css" />
    	<title>Baidu Maps Map Drawing Tool</title>
    </head>
    <body>
    	<div id="allmap" style="overflow:hidden;zoom:1;position:relative;">	
    		<div id="map" style="height:100%;-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;"></div>
    	</div>
    	<div id="result">
    		<input type="button" value="Clear overlayed objects" onclick="clearAll()"/>
    	</div>
    	<script type="text/javascript">
    	// Baidu Maps API Code
        var map = new BMap.Map('map');
        var poi = new BMap.Point(116.307852,40.057031);
        map.centerAndZoom(poi, 16);
        map.enableScrollWheelZoom();  
        var overlays = [];
          
        var marker;
          
    	var overlaycomplete = function(e){
    	    // If the drawingMode of the object is a "marker"
            if(e.drawingMode == "marker")
            { 
              // Set the position (Point) of the object
              marker = e.overlay.getPosition()
              console.log(marker);
            }
            // Determine whether the marker is inside the drawn polygon
            console.log(e.overlay.getBounds().containsPoint(marker));
            overlays.push(e.overlay);
        };
          
        var styleOptions = {
            strokeColor:"red",    // Stroke color
            fillColor:"red",      // Fill color. If the input is left empty, then there will be no color for fill
            strokeWeight: 3,       // Stroke weight
            strokeOpacity: 0.8,	   // Opacity of the stroke. Double from 0.0 to 1.0
            fillOpacity: 0.6,      // Opacity of the fill. Double from 0.0 to 1.0
            strokeStyle: 'solid' // Stroke type. 'solid' or 'dashed'
        }
        // Instantiate DrawingManager class
        var drawingManager = new BMapLib.DrawingManager(map, {
            isOpen: false, // Start drawing mode
            enableDrawingTool: true, // Show drawing tools
            drawingToolOptions: {
                anchor: BMAP_ANCHOR_TOP_RIGHT, // Position of the tool bar
                offset: new BMap.Size(5, 5), // Determine the offset of the tool bar
                scale: 0.8 // Scale of the tool bar 
            },
            circleOptions: styleOptions, // Style of the circle 
            polylineOptions: styleOptions, // Style of the line
            polygonOptions: styleOptions, // Style of the polygon
            rectangleOptions: styleOptions // Style of the rectangle
        });  
    	 // Add event listener for the drawing manager. Also used to retrieve properties.
        drawingManager.addEventListener('overlaycomplete', overlaycomplete);
        function clearAll() {
    		for(var i = 0; i < overlays.length; i++){
                map.removeOverlay(overlays[i]);
            }
            overlays.length = 0   
        }
    </script>
    </body>
    </html>
P.S. The only code I added is this. Feel free to (and please) change it to your needs. 

    var marker;
      
	var overlaycomplete = function(e){
	    // If the drawingMode of the object is a "marker"
        if(e.drawingMode == "marker")
        { 
          // Set the position (Point) of the object
          marker = e.overlay.getPosition()
          console.log(marker);
        }
        // Determine whether the marker is inside the drawn polygon
        console.log(e.overlay.getBounds().containsPoint(marker));
        overlays.push(e.overlay);
    };

How to use the above code block:
-
1. Copy and paste the code to the Baidu Maps code "editor"
2. Run it by clicking "??“. Looks like this:![enter image description here](https://puu.sh/cUlKQ/c6d7853769.png)
3. Drop a Marker onto any part of the map. Looks like this: ![enter image description here](https://puu.sh/cUlLS/e5e690dc17.png)
4. Draw the polygon onto any part of the map. Looks like this: ![enter image description here](https://puu.sh/cUlNf/7c7d71e8c8.png)
5. Check console for the true or false. It's returned by  `e.overlay.getBounds().containsPoint(marker)` where `marker` is the a `Point` object. Can be determined by the location of the Marker, or can be determined through hardcoding i.e. `69, 69`.

How to get the coordinates of a polygon:
-
`e.overlay.getPath();`

 - Given that the `drawingMode` of the `overlay` is a Polygon, this will return an array of Points corresponding to each vertice's coordinates: 
 - Check Helpful Link [2] for additional methods.
 - Additional `drawingMode`s include Circle, Rectangle, Polyline, Point, etc.


Helpful Links:
-
1. Baidu Maps API [Marker object methods and properties](https://developer.baidu.com/map/reference/index.php?title=Class:%E8%A6%86%E7%9B%96%E7%89%A9%E7%B1%BB/Marker)
2. Baidu Maps API [Polygon object methods and properties](https://developer.baidu.com/map/reference/index.php?title=Class:%E8%A6%86%E7%9B%96%E7%89%A9%E7%B1%BB/Polygon)
