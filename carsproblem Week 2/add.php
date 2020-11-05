<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add</title>
<?php
    session_start();
    require_once("pdo.php");
    if (isset ($_POST["logout"])){
        header("location:index.php");
        return;
    }
    if (isset($_POST['make']) && isset($_POST['mileage']) 
     && isset($_POST['year'])) {
         if (empty($_POST['make'])) {
            $_SESSION["error"]="Make is required";
            header("location:add.php");
            return;
         }
         else if ((!is_numeric($_POST['mileage'])) or (!is_numeric($_POST['year']))){
            $_SESSION["error"]="Mileage and year must be numeric";
            header("location:add.php");
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
         header("location:view.php");
         }}
         ?>
</head>
<body>

<?php

if (isset($_SESSION["error"])){
    echo("<p style='color:green'>".$_SESSION["error"]."</p>");
    unset($_SESSION["error"]);
};
?>
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
<a href="view.php" type="button">Cancel</a>
<h2>Automobiles</h2>
<ul>
<p>
</p></ul>
</div>


</body>
</html>