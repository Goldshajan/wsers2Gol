<?php

include_once "sessionCheck.php"; ?>
<html>

<body>
    <?php
    include_once "credentials.php";

    if (isset($_POST["Logout"])) {
        session_destroy();
        session_unset();
    } elseif ($_SESSION["UserLog"]) {
        print "You are already logged in, you can not signup twice";
       // displayuser($connect);
    } elseif (
        isset($_POST["FirstName"]) &&
        isset($_GET["LastName"]) &&
        isset($_GET["Username"]) &&
        isset($_GET["Password"])
    ) {
        print "You are about to register .... but not yet<BR>";
        $isUserThere = $connection->prepare("SELECT * FROM ppl WHERE UserName=?");
        $isUserThere->bind_param("s", $_GET["Username"]);
        $isUserThere->execute();

        $result = $isUserThere->get_result();
        if ($result->num_rows > 0) {
            print "Your username is already taken ! <BR>";
        } else {

            $stmt = $connection->prepare("INSERT INTO ppl(First_Name,Second_Name,Age,UserName,Password,Nationality) VALUES(?,?,?,?,?,?)");

            $hashedPassword = password_hash($_GET["Password"], PASSWORD_BCRYPT);

            $stmt->bind_param("ssissi", $_GET["FirstName"], $_GET["LastName"], $_GET["Age"], $_GET["Username"], $hashedPassword, $_GET["Country"]);
            $stmt->execute();
            print "Yaaay you have registered. Check the database <BR>";
        }
    } else {


    ?>
        <form action="Signup.php" method="get">
            First name: <input type="text" name="FirstName" required><br>
            Last name: <input type="text" name="LastName" required><br>
            Age: <input type="text" name="Age"><br>
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
            <br>
            <input type="submit" name="Register" value="Register">
        </form>
    <?php } ?>

</body>

</html>