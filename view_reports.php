<?php 
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
$email = $_SESSION['email'];
include('db.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Reports</title>
</head>
<body class="bg-blue-100">
  <?php 
  include('nav.php');  
  ?>
            <table class="table-fixed text-center border-separate border border-slate-500">
                <thead>
                <tr>
                    <th class="border h-10 w-96 border-slate-600" >Category</th>
                    <th class="border h-10 w-96 border-slate-600">Address</th>
                    <th class="border h-10 w-96 border-slate-600">Emergency_status</th>
                    <th class="border h-10 w-96 border-slate-600">Description</th>
                    <th class="border h-10 w-96 border-slate-600">Status</th>
                    
        
                </tr>
                </thead>
                <tbody>
                   <tr> <?php
            $email = $_SESSION['email'];
            $query = "SELECT * from issues WHERE user_email = '$email'";
            $run = mysqli_query($conn, $query);
            
            
            
            while ($row = mysqli_fetch_assoc($run)) { ?>
            <tr>
                
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['problem_category']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['address']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['emergency_status'];?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['problem_description']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php if ($row['status'] == 'not solved') { ?>
                        Not Solved
                    <?php } else if ($row['status'] == 'solved') { ?>
                        Solved✅ 
                    <?php } ?> </td>
               
            </tr>
            
            <?php } ?>
                                
                   </tr>
                   
                </tbody>
            </table>
        </div>
</main>
<footer>
   <?php 
   include('footer.php');
   ?>
    
</footer>

             
</body>
</html>