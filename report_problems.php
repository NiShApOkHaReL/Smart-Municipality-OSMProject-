<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
}
include("db.php");
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Report Problem</title>
</head>
<body class="bg-blue-100">
    <main class="h-screen">
        <div class=" mt-10  ">
            <p class="text-center text-blue-600 text-4xl font-serif font-semibold cursor-pointer" >Report Problem</p>
        </div>
        <div class=" flex justify-center mt-10 ">
            <form action="process.php" method="post" class=" bg-white shadow-2xl rounded-lg ">
                <div>
                    <label for="Problem Category" class=" text-xl m-3">Choose the category</label>
                    <select name="problemcat" id="problemcat" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2">
                        <option value = "education">Education</option>
                        <option value = "infrastructures">Infrastructures</option>
                        <option value = "electricity">Electricity</option>
                        <option value = "agriculture">Agriculture </option>
                        <option value = "land use">Land Use</option>
                        <option value = "health">Health</option>
                        <option value = "water supply">Water Supply</option>
                        <option value = "drainage">Drainage</option>  
                        <option value = "culture and religion">Culture and Religion</option>
                        <option value= "Security">Security</option>
                        <option value = "others">Others</option>      
                    
                    </select>
                </div>
                <div class="flex justify-center items-center">
                    <textarea  id="problem" name="problem" placeholder="Explain your problem here" class="h-20 w-11/12  rounded-md m-3 border-gray-400 border-2"></textarea>
                
                </div>
                <div>
                    <label class="text-xl m-3" for="imageFile">Insert Image</label> <br>
                    <input type="file" name="imageFile" id="image" class="text-xl m-3">
                </div>
                <div>
                    <p class="text-xl m-3">How much emergency is your problem?</p>
                    <label for="emer" class="text-xl m-3">Emergency Status:</label>
                    <select name="emer" id="emer" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2">
                    <option value="notemer">Not emergency</option> 
                    <option value="emergency" >High Emergency</option>             
                    </select>
                </div>
                <div>
                    <p class="text-xl m-3">Which way you want to provide the address?</p>
                    <div class="text-xl m-3">
                        <input type="radio" name="locationOption" id="currentLocationOption" value="currentLocation" >
                        <label for="currentLocationOption">Use Current Location</label> <br>
                        <input type="radio" name="locationOption" id="customLocationOption" value="customLocation"> 
                        <label for="customLocationOption">Enter Custom Address:</label> 
                        <input class="border-gray-400 border-2 rounded-md" type="text" name="address" id="address"><br>
                    
                    </div>
                    <div class="text-xl m-3 ">
                        <input class="border-gray-400 border-2 m-2 rounded-md" name="latitude" id="latitude" placeholder="Latitude"> <br>
                        <input class="border-gray-400 border-2 m-2 rounded-md" name="longitude" id="longitude" placeholder="Longitude">
                    
                    </div>
                    <div class="flex justify-center m-6">
                        <input class="bg-lime-500  text-white font-semibold text-xl h-14 w-52 rounded-md hover:bg-lime-600 items-center mx-auto " type="submit" value="Submit" name="submit">
                    
                    </div>
                    
                </div>
            </form>
        </div>
        <?php 
    include('map.php');
    ?>
    </main>

   
    <footer>
  

    </footer>
</body>
</html>
<script>
        // Get the address input field
        const addressInput = document.getElementById('address');
        // Get the latitude and longitude input fields
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        // Disable the address input field initially
        addressInput.disabled = true;

        // Add event listeners to the radio buttons
        document.getElementById('currentLocationOption').addEventListener('change', function() {
            addressInput.disabled = true;
        });

        document.getElementById('customLocationOption').addEventListener('change', function() {
            addressInput.disabled = false;
        });

        // Get current location and populate latitude and longitude fields
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const { latitude, longitude } = position.coords;
                    latitudeInput.value = latitude;
                    longitudeInput.value = longitude;
                },
                function(error) {
                    console.log(error);
                }
            );
        }
    </script>