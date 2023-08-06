<?php 
session_start();
include('db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body class="bg-blue-100" >
    <main class="h-screen">
        <div class=" mt-16 ">
            <p class="text-center text-blue-600 text-4xl font-serif font-semibold " >Log In to Smart Municipality</p>
        </div>
        <div class=" flex justify-center  basis-5/12 ">
            <form action="" method="post" class=" bg-white shadow-2xl rounded-lg mt-16 h-96 w-2/6" >
                <div class="flex flex-col justify-center items-center">
                <input type="email" name="email" id="mail" placeholder="Email" class="h-14 w-80 rounded-md mt-14 border-gray-400 border-2" required> <br> <br>
                <input type="password" name="pass" id="pass" placeholder="Password" class="h-14 w-80 rounded-md border-gray-400 border-2" required>  </div> <br> <br>
                <div class=" flex items-center justify-center ">
                    <input type="submit" name="login" value="Log In" class="bg-lime-600 text-white text-center font-semibold text-xl h-14 w-52 rounded-md hover:bg-lime-700 items-center mx-auto  " >
                    
                 </div>
                 <div class="flex justify-center items-center text-xl text-blue-950 m-3">
                    <a href="register.php"> Don't have an account? Register...</a>
                 </div>
                 
            
            </form>
        </div>
    
    </main>
    <footer>
        <div >
            <p class=" flex justify-center text-center font-semibold text-white text-2xl bg-blue-950">Smart Municipality  <span>&#169;</span> 2023</p>
           
        </div>
    </footer>
</body>
</html>

<?php
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $query = "SELECT * from user WHERE email = '$email' and password = '$password'";
    $run = mysqli_query($conn,$query);
    $count = mysqli_num_rows($run);
    if($count == 1){
        $_SESSION['email'] = $email;
        echo"<script>alert('You are logged in')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
    else{
        echo"<script>alert('Email / Password wrong')</script>";
        
    }
}

?>