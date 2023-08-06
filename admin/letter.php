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

if(isset($_GET['id'])) {
    $id = $_GET['id'];

}

$query = "SELECT latitude,longitude, problem_category, problem_description, timestamp, user_email, address from issues WHERE  id='$id'" ;
$result = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php  while ($row = mysqli_fetch_assoc($result)) { ?>
    <div>To,<br></div>
    The Mayor,<br>
    Smart Municipality<br>
    Chitwan, Nepal<br><br>
    Subject:Complaint regarding<?php echo $row['problem_category']; ?><br>
<br>
Respected Sir,<br>
I am Ram Shrestha living in bharatpur chitwan.I am writing this letter complaining about the <?php echo $row['problem_category']; ?> in our society.<br>
<br>
<?php echo $row['problem_description']; ?><br><br>
This has caused great deal of trouble for our society's members.So, on behalf of my society , I kindly request that you please consider our concern and take the necessary steps to solve the problem.<br><br>


Please do the needful.<br>
Thank You!
   <?php }?>
</body>
</html>