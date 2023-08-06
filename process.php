<?php
session_start();
include("db.php");
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Retrieve input values from the form
$problemCategory = isset($_POST['problemcat']) ? $_POST['problemcat'] : '';
$problemdesc = isset($_POST['problem']) ? $_POST['problem'] : '';
$emergencystat = isset($_POST['emer']) ? $_POST['emer'] : '';
$uemail = $_SESSION['email'];

//$imageFile = $_FILES['imageFile']['name'];
//$temp_name=$_FILES['imageFile']['tmp_name'];
//move_uploaded_file($temp_name, "images/$imageFile");


// Check the selected location option
if (isset($_POST['locationOption']) && $_POST['locationOption'] === 'currentLocation') {
    // Geocoding code for current location

    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        // Reverse geocoding to get the address from latitude and longitude
        $reverseGeocodingUrl = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" . urlencode($latitude) . "&lon=" . urlencode($longitude);

        $reverseGeocodingResponse = file_get_contents($reverseGeocodingUrl);
        $reverseGeocodingData = json_decode($reverseGeocodingResponse, true);
        
        if (!empty($reverseGeocodingData) && isset($reverseGeocodingData['display_name'])) {
            $address = $reverseGeocodingData['display_name'];
        } else {
            $address = "Unknown Address";
        }

        // Additional line to store the address in the database
        $address = mysqli_real_escape_string($conn, $address);
    } else {
        // Handle error when latitude and longitude are not available
        echo "Error: Latitude and longitude values are missing.";
        exit();
    }
} else {
    // Geocoding code for custom address
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    if (!empty($address)) {
        $opts = array(
            'http' => array(
                'header' => 'User-Agent: MyGeocodingApp'
            )
        );
        $geocodingUrl = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($address);

        $context = stream_context_create($opts);
        $response = file_get_contents($geocodingUrl, false, $context);
        $data = json_decode($response, true);

        if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
            $latitude = $data[0]['lat'];
            $longitude = $data[0]['lon'];
        } else {
            // Handle geocoding error
            echo "Geocoding error: No results found.";
            exit();
        }
    } else {
        // Handle error when address is empty
        echo "Error: Address is empty.";
        exit();
    }
}

// Check if the file was uploaded without errors

  

  
// Insert the data into the database
$query = "INSERT INTO issues (emergency_status,problem_category, problem_description, address, latitude, longitude, user_email,status,image)
          VALUES ('$emergencystat','$problemCategory', '$problemdesc', '$address', '$latitude', '$longitude','$uemail','not solved','road.jpg')";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: confirmation.php?lat=$latitude&lon=$longitude");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>