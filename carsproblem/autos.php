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
    if (isset ($_POST["logout"])){
        header("location:index.php");
        return;
    }
    if (isset($_POST['make']) && isset($_POST['mileage']) 
     && isset($_POST['year'])) {
         if (empty($_POST['make'])) {
            $_SESSION["error"]="Make is required";
            header("location:autos.php");
            return;
         }
         else if ((!is_numeric($_POST['mileage'])) or (!is_numeric($_POST['year']))){
            $_SESSION["error"]="Mileage and year must be numeric";
            header("location:autos.php");
            return;
         }
         else  {
             
            $sql="INSERT INTO autos (make,mileage,year) VALUES (:make,:mileage,:year)";
         $stmt=$pdo->prepare($sql);
         $stmt->execute(array(
            ':make' => $_POST['make'],
            ':year' => $_POST['year'],
            ':mileage' => $_POST['mileage'])
         );
         $_SESSION["success"] = 'Record inserted';
         }}

         



if (isset ($_POST["logout"])){
    header("location:index.php");
}

$stmt = $pdo->query("SELECT make, mileage, year FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>

<table border="1">
<?php
if (isset($_SESSION["success"])){
    echo("<p style='color:green'>".$_SESSION["success"]."</p>");
    unset($_SESSION["success"]);
};

    if (isset($_SESSION["error"])){
        echo("<p style='color:red'>".$_SESSION["error"]."</p>");
        unset($_SESSION["error"]);
    };
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
<form method="post">
<p>Make:
<input type="text" name="make" size="60"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Mileage:
<input type="text" name="mileage"></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
<ul>
<p>
</p></ul>
</div>


</body>
</html>