<?php

$conn = mysqli_connect('localhost', 'root', '', 'hackfest');
$query = "SELECT latitude, longitude, problem_category AS category FROM issues WHERE status='not solved'"; 
$result = mysqli_query($conn, $query);

$issueData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $issueData[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reported Issues Map</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 450px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2></h2>
    <h2 class=" text-blue-950 text-xl underline m-3 text-center cursor-pointer" >Reported Issues Map</h2>
   
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Create the map
        var map = L.map('map').setView([28.3949, 84.1240], 7); // Set center coordinates for Nepal

        // Define tile layers
        var streetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 22,
        });

        var satelliteMapLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri',
            maxZoom: 22,
        });

        // Create a base layers object
        var baseLayers = {
            "Street Map": streetMapLayer,
            "Satellite Map": satelliteMapLayer
        };

        // Add the default street map layer to the map
        streetMapLayer.addTo(map);

        // Create an overlay layers object (for future use if needed)
        var overlayLayers = {};

        // Retrieve issue data from PHP and MySQLi
        var issues = <?php echo json_encode($issueData); ?>;

        // Add markers for each issue and calculate distance from main place
var mainPlace = [27.6329033, 84.5028269]; // Coordinates of the main place

issues.forEach(function(issue) {
    var marker = L.marker([issue.latitude, issue.longitude]).addTo(map);
    var distance = calculateDistance(issue.latitude, issue.longitude, mainPlace[0], mainPlace[1]).toFixed(2);
    marker.bindPopup('<strong>' + issue.category + '</strong><br>Distance From SmartMunicipality Office is: ' + distance + ' km');
});

        // Function to calculate the distance between two coordinates using the Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    var earthRadius = 6371; // Radius of the Earth in kilometers
    var dLat = deg2rad(lat2 - lat1);
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var distance = earthRadius * c;
    return distance;
}

// Function to convert degrees to radians
function deg2rad(deg) {
    return deg * (Math.PI / 180);

        }

        // Add layer control to switch between street and satellite maps
        L.control.layers(baseLayers, overlayLayers).addTo(map);
    </script>
</body>
</html>
