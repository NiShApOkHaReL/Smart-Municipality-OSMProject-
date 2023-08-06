
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Index</title>
</head>
<body class="bg-blue-100">
 
        
   <main >
    <div class=" flex h-auto w-auto flex-col justify-center bg-blue-950 ">
    <?php if(!isset($_SESSION['email'])){ 
echo "<a class='text-white text-xl underline m-3'>Welcome Guest</a>";
        }
        else{  
           echo "<a  href='' class='text-white text-xl underline m-3'>Welcome: " .$_SESSION['email']." </a>" ;
    }  

?>
        <p class="text-center m-6 text-white text-4xl font-serif font-semibold cursor-pointer">Welcome to the Smart Municipality Homepage </p>
        <nav class="cursor-pointer">
            <div class="flex justify-center items-center">
            <ul class="flex items-center justify-center ">
             
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md"> <a href="report_problems.php">Report your problem</a></li>
                <li class="m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md"> <a href="view_reports.php">View Reports</a></li>
                <?php 
                if(isset($_SESSION['email'])){
                   echo "<li class='m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md'> <a href='report_problem.php'> <a href='logout.php'>Log Out</li></a>" ;
                }
                else{
                    echo " <li class='m-6 bg-blue-500 hover:bg-blue-600 text-white text-xl h-14 w-52 flex justify-center items-center rounded-md'> <a href='report_problem.php'> <a href='login.php'>Log In</li>  </a> ";

                }  ?>
            </ul>
            </div>
        </nav>
    </div>
    </main>
    

</body>
</html>