<?php
include_once "sessionCheck.php";
include_once "credentials.php";

?>

<body>
    <?php
if(!$_SESSION["UserLogged"]){
 ?>
 you are not allowed here
 <a href="login_page.php"></a>
 <?php exit();?>
 <?php
}
?>
    <h1>Please updateyour information</h1>
    <form action="Signup.php" method="post">
        First name: <input type="text" name="FirstName" required><br>
        Last name: <input type="text" name="LastName" required><br>
        Age: <input type="text" name="Age" required><br>
        UserName: <input type="text" name="Username" required><br>
        Password: <input type="password" name="Password" required><br>

        <select name="Country">
            <?php
            $stmt = $connection->prepare("SELECT * FROM countries");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["COUNTRY_ID"] . '">' . $row["COUNTRY_NAME"] . '</option>';
                }
            } else {
                echo "0 results";
            }

            ?>
        </select>
        <br>
        <input type="submit" name="Register" id="SignupButton" value="Update info">
    </form>

</body>