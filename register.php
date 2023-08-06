<?php 
session_start();
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register your account</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body class="bg-blue-100 flex h-auto w-auto flex-col justify-center  ">
    <div>
        <p class=" flex justify-center text-center text-white font-semibold text-2xl bg-blue-950">Smart Municipality </p>
    </div>
    <div class=" mt-16  ">
        <p class="text-center text-blue-600 text-4xl font-serif font-semibold " >Register account in Smart Municipality</p>
    </div>
  
    <div class=" flex justify-center mt-16 ">
        <form action="" method="POST" class=" bg-white shadow-2xl rounded-lg " >
          <label for="name" class="m-3" >Full Name</label> <br>
          <input type="text" id="name" name= "name" placeholder="BLOCK LETTER" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2"required> <br>
          
          <label for="mail" class="m-3">Email Address</label> <br>
          <input type="email" id="email" name = "email" placeholder="@gmail.com" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2"required > <br>
          
          <label for="address" class="m-3" >Address</label> <br>
          <input type="text" id="address" name = "address" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2" required > <br>
          
          <label for="pass" class="m-3">Password</label> <br>
          <input type="password" id="password" name = "password" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2" required> <br>
          
          <label for="citizen" class="m-3">Citizenship Number</label> <br>
          <input type="text" id="cno" name = "cno" class="h-14 w-80 rounded-md m-3 border-gray-400 border-2" required> <br>
          
          <div class=" flex items-center justify-center ">
          <input type="submit" value="Register" name = "register" class="bg-lime-500 text-center text-white font-semibold text-xl h-14 w-52 rounded-md hover:bg-lime-600 items-center mx-auto "   >
          
           </div>
  
        </form>
    </div>
  </body>
</html>


<?php
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $cno = $_POST['cno'];
    $address = $_POST['address'];
    
    $query = "INSERT INTO `user`(`Name`, `email`, `password`, `citizenship_no`, `address`)
        VALUES ('$name','$email','$password','$cno','$address')";
     $run = mysqli_query($conn, $query);
     if($run){
     $_SESSION['email'] = $email;
     echo "<script> alert('You have registered successfully to Smart Municipality')</script>";
     echo "<script> window.open('index.php','_self')</script>";
     
     }
}

?>