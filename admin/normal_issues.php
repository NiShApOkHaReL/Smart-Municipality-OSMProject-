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
//Button clicked function
if (isset($_POST['solve'])) {
    $issueId = $_POST['issue_id'];
    $updateQuery = "UPDATE issues SET status = 'solved' WHERE id = '$issueId'";
    mysqli_query($conn, $updateQuery);
    header("Location: issues.php"); 
    exit();
}

$query ="SELECT * FROM issues WHERE emergency_status = 'notemer' ORDER BY id DESC";

$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Issues Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-blue-100">
    <main class="h-screen">
    <div class=" flex h-auto w-auto flex-col justify-center bg-blue-950 ">
        <p class="text-center m-6 text-white text-4xl font-serif font-semibold cursor-pointer">Welcome to the Admin Dashboard</p>
        <nav >
            <div class="flex justify-center items-center">
            <ul class="flex items-center justify-center ">
             
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md"> <a href="normal_issues.php">Normal Issues</a></li>
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md"> <a href="index.php">Home</a></li>
             </ul>
            </div>
        </nav>
    </div>
        <h2 class="cursor-pointer text-blue-950 text-xl underline m-3 text-center" >Normal Issues</h2>
         <table class="table-auto text-center border-separate border border-slate-500">
            <thead>
            <tr>
                <th class="border h-10 w-96 h-10 w-96 border-slate-600" >S.N</th>
                <th class="border h-10 w-96 border-slate-600">UserEmail</th>
                <th class="border h-10 w-96 border-slate-600">Problem_category</th>
                <th class="border h-10 w-96 border-slate-600">Problem_description</th>
                <th class="border h-10 w-96 border-slate-600">Address</th>
                <th class="border h-10 w-96 border-slate-600">Emergency_status</th>
                <th class="border h-10 w-96 border-slate-600">latitude</th>
                <th class="border h-10 w-96 border-slate-600">longitude</th>
                <th class="border h-10 w-96 border-slate-600">Timestamp</th>
                <th class="border h-10 w-96 border-slate-600">ProblemImage</th>
                <th class="border h-10 w-96 border-slate-600">Solved/Not?</th>
                <th class="border h-10 w-96 border-slate-600">View in Map</th>

            </tr>
            </thead>
           
            <?php  $issueCount = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tbody>
                <tr>  
                <td class="border h-10 w-96 border-slate-600"><?php echo $issueCount; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['user_email']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['problem_category']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['problem_description']?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['address']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['emergency_status']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['latitude']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['longitude']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['timestamp']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php echo $row['image']; ?></td>
                <td class="border h-10 w-96 border-slate-600"><?php if ($row['status'] == 'not solved') { ?>
                        Not Solved
                        <form method="POST" action="">
                            <input type="hidden" name="issue_id" value="<?php echo $row['id']; ?>">
                            
                            <input class="bg-lime-700 rounded-md text-white h-6 w-16" type="submit" name="solve" value="Solve">
                        </form>
                    <?php } else if ($row['status'] == 'solved') { ?>
                        Solved✅ 
                    <?php } ?> </td>
                 <td class="border h-10 w-96 border-slate-600"><a href="issue_map.php?id=<?php echo $row['id'];?>">Map</a></td>
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
