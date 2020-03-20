<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    include_once("credentials.php");


    // LOAD THE credentials.php using include_once !

    // GOOD ! FILL THIS IN AND MAKE THIS WORK !!
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("connection failed: " . mysqli_connect_error());
    }
    if (
        isset($_GET["Username"]) &&
        isset($_GET["Password"])
    ) {
        print "You are about to register<BR>";
    } else {

//When i load it give me anything. could you give me any ideas please!
    ?>

        <form action="login.php" method="post">
            UserName: <input type="text" name="Username" required><br>
            Password: <input type="text" name="Password" required><br>

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
                $connection->close();
                ?>
            </select>
            <input type="submit" name="Register" value="Register">
        </form>


    <?php } ?>

</body>

</html>