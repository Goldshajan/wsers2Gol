<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php


$connection =mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("connection failed: " .mysqli_connect_error());

}
if (
    isset($_GET)
)













?>
<form action="login.php" method="post">
UserName: <input type="text" name="Username" required><br>
Password: <input type="text" name="Password" required><br>

<input type="submit" name="Register" value="Register">
</form>


?>
    
</body>
</html>