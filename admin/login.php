<?php 
session_start();
$conn = mysqli_connect("localhost","root","","hackfest");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>



    <body class="bg-blue-100" >
    <main class="min-h-screen flex items-center justify-center">
        <div class=" w-96 ">
            <p class="text-center text-blue-600 text-4xl font-serif font-semibold cursor-pointer mt-16 " >Log In to Admin Dashboard</p>
            <form action="" method="post" class=" bg-white shadow-2xl rounded-lg mt-16 p-8" >
                <div class="flex flex-col">
                    <input type="email" name="admin_email" id="mail" placeholder="Email" class="h-14 rounded-md mt-6 border-gray-400 border-2"> <br>   
                    <input type="password" name="admin_pass" id="pass" placeholder="Password" class="h-14 rounded-md border-gray-400 mt-6 border-2">  
                </div> 
                <div class=" flex mt-8 justify-center ">
                    <input type="submit" name="admin_login" value="Log In" class="bg-lime-600 text-white text-center font-semibold text-xl h-14 w-52 rounded-md hover:bg-lime-700 " >
                    
                 </div>
                 
                 
            
            </form>
        </div>
    
    </main>
    <footer>
        <div >
            <p class=" flex justify-center text-center font-semibold text-white text-2xl bg-blue-950 py-4">Smart Municipality  <span>&#169;</span> 2023</p>
           
        </div>
    </footer>
    

</body>
</html>


<?php
if(isset($_POST['admin_login'])){
  $admin_email= mysqli_real_escape_string($conn,$_POST['admin_email']);
  $admin_pass= mysqli_real_escape_string($conn,$_POST['admin_pass']);
  $get_admin="select * from admin where admin_email='$admin_email'AND admin_password='$admin_pass'";
  $run_admin=mysqli_query($conn,$get_admin);
  $count= mysqli_num_rows($run_admin);
  if($count == 1){
    $_SESSION['admin_email']= $admin_email;
    echo "<script> alert('You are logged') </script>";
    echo "<script> window.open('index.php','_self') </script>";

  }
  else{
    echo "<script>alert('Email/Password Wrong')</script>";
  }

}
 ?>