<?php
    session_start();
require_once ("pdo.php");

if ( isset($_POST['email']) && isset($_POST['pass'])  ) {
    if (strpos($_POST['email'],'@')!==false){ 
          $sql = "SELECT password FROM users 
        WHERE password = :pw";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        
        ':pw' => $_POST['pass']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
    if ( $row === FALSE ) {
       
       $_SESSION["error"]="Incorrect password";
       error_log("Session ID= ".session_id()."  Error= ".$_SESSION["error"]." ".$_POST["email"]." from login.php");
       header("location:login.php");
       return;
    } else {
        $_SESSION["name"]=$_POST["email"];
       $_SESSION["success"]="Login Sucess";
       error_log("Session ID= ".session_id()."  Success= ".$_SESSION["success"]." ".$_POST["email"]." from login.php");
header("Location:autos.php");
return;

    }}
    else{
    $_SESSION["error"]="Email must have an at-sign (@)";
    error_log("Session ID= ".session_id()."  Error= ".$_SESSION["error"]." ".$_POST["email"]." from login.php");
    header("location:login.php");
    return;
}};

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iskander Fakhritdinov</title>

</head>
<body>
<?php
    if (isset ($_SESSION["error"])){
    echo("<p style='color:red'>".$_SESSION["error"]."</p>");
    unset($_SESSION["error"]);
};
?>
	<h1>Enter your login details</h1>
	<form method="post">
		<input type="text" name="email" placeholder="Email">
		<input type="text" name="pass" placeholder="Password">
		<input type="submit" name="Log In" value="Log In">

	</form>

</body>
</html>