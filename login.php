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
        isset($_POST["Username"]) &&
        isset($_POST["Password"])
    ) {
        print "You are about to login<BR>";

        $stmt = $connection->prepare("SELECT * FROM ppl WHERE UserName ?");
        $stmt->bind_param("s", $_POST["Username"]);
        $stmt->execute();
        $stmt = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($result->num_row > 0) {
            print "You EXIST in our database ";
            if (password_verify($_POST["Password"], $row["Password"])) {
                print "You have the right password -> LOGIN successfull";
            } else {
                print "Wrong Password";
            }
        } else {
            print "Your username is not in our database !! Please consider registering !";
    ?> <a href="Signup.php">Go to the signup page</a>
            <a href="login.php">Try again</a>
        <?php
        }
    } else {
        ?>

        <form action="login.php" method="post">
            UserName: <input type="text" name="Username" required><br>
            Password: <input type="text" name="Password" required><br>

            <input type="submit" name="Login" value="Login">

        </form>


    <?php } ?>

</body>

</html>