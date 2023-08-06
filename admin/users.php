<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit();
}



$conn = mysqli_connect("localhost", "root","", "hackfest");

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}


$query ="SELECT * FROM user";

$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html>
<head>
    <title>User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-blue-100">
    
    <div class=" flex h-auto w-auto flex-col justify-center bg-blue-950 ">
        <p class="text-center m-6 text-white text-4xl font-serif font-semibold cursor-pointer">Welcome to the Admin Dashboard</p>
        <nav >
            <div class="flex justify-center items-center">
            <ul class="flex items-center justify-center ">
             
               
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md cursor-pointer"> <a href="users.php">Users</a></li>
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md cursor-pointer"> <a href="index.php">Home</a></li>
             </ul>
            </div>
        </nav>
    </div>
        <h2 class=" text-blue-950 text-xl underline m-3 text-center" >All Users</h2>
         <table class="table-auto text-center border-separate border border-slate-500">
            <thead>
            <tr>
                <th class="border h-10 w-96 h-10 w-96 border-slate-600" >S.N</th>
                <th class="border h-10 w-96 border-slate-600">User Name</th>
                <th class="border h-10 w-96 border-slate-600">Email</th>
                <th class="border h-10 w-96 border-slate-600">Citizenship_no</th>
                

            </tr>
            </thead>
           
            <?php  $issueCount = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tbody>
                <tr>  
                <td class="border h-10 w-96 border-slate-600"><?php echo $issueCount; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['name']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['email']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['citizenship_no']?></td>
       
            </tr>
                    </tbody>
            
            <?php $issueCount++; } ?>
        </table>
    </main>
    <footer>
        <div >
            <p class=" flex justify-center text-center font-semibold text-white text-2xl bg-blue-950">Smart Municipality  <span>&#169;</span> 2023</p>
           
        </div>
    </footer>
</body>
</html>
