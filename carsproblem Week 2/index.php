<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iskander Fakhritdinov</title>
    <?session_start();?>
</head>
<body>
    <?php 
    
    if (isset($_SESSION["error"])) {
        echo($_SESSION["error"]);
        unset($_SESSION["error"]);
    };
    ?>
    <a href="login.php">Please Log In</a>
</body>
</html>