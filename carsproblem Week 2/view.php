<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iskander Fakhritdinov</title>
<?php
require_once "pdo.php";



session_start();

if (!isset($_SESSION["name"])){
    die("Not logged in");
    
}



// if (isset ($_POST["logout"])){
//     header("location:index.php");
// }




?>
</head>
<body>
<?php if (isset ($_SESSION["success"])) {
    echo("<p style='color:green'>".$_SESSION["success"]."</p>");
    
    unset($_SESSION["sucess"]);}

if (isset($_SESSION["error"])){
    echo($_SESSION["error"]);
    unset($_SESSION["error"]);
}
?>
<table border="1">
<?php
$stmt = $pdo->query("SELECT make, mileage, year FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td></tr>\n");
}
?>
<div class="container">
<h1>Tracking Autos for csev@umich.edu</h1>
<a href="logout.php"><button>Logout</button></a>

<h2>Automobiles</h2>


<a href="add.php">Add New</a>
</div>


</body>
</html>