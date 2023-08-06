
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = 'hackfest';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

}

$query = "SELECT latitude,longitude, problem_category from issues WHERE  id='$id'" ;
$result = mysqli_query($conn,$query);
$issueData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $issueData[] = $row;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
     <style>
     #map { height: 800px; }
     </style>
</head>
<body>
<div id="map"></div>
<script>
var map = L.map('map').setView([27.620425, 84.513967], 8);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var mainPlace = [27.6329033, 84.5028269];

var greenIcon = L.icon({
    iconUrl: 'officeicon.png',
    iconSize:     [38, 95], // size of the icon
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
var munimarker = L.marker((mainPlace), {icon: greenIcon}).addTo(map);

  

function calculatedistance(lat1,lat2,lon1,lon2){
    dlat = lat2-lat1;
    dlon = lon2-lon1;
    radius=6371;
    var a = Math.sin(dlat/2)*Math.sin(dlat/2) + 
           Math.cos(deg2rad(lat1))*Math.cos(deg2rad(lat2))*
           Math.sin(dlon/2)*Math.sin(dlon/2);
    var c = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a));
    var distance = radius * c;
    return distance;
}
function deg2rad(deg){
    return deg*(Math.PI / 180);
}

    var issues = <?php echo json_encode($issueData); ?>;
issues.forEach(function(issue) {
    var circle = L.circle([issue.latitude,issue.longitude],{color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 400}).addTo(map);
    var distance = calculatedistance(issue.latitude, issue.longitude, mainPlace[0], mainPlace[1]).toFixed(2);

    circle.bindPopup("<strong>"+issue.problem_category+"</strong><br>The distance from Smart Municipality is"+distance);
    L.Routing.control({
  waypoints: [
    L.latLng(27.6329033, 84.5028269),
    L.latLng(issue.latitude, issue.longitude)
  ]
}).addTo(map);
});

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);
   

</script>
</body>
</html>