<?php
include_once "sessionCheck.php"; ?>

<html>

<body>
    <?php
    include_once "credentials.php";
    include_once "displayUser.php";
    if (isset($_POST["Logout"])) {

      session_unset();
      session_destroy();
      print "You have been successfully logged-out" . "<br>";
      ?><a href="login_page.php">Login page</a> <?php
    } elseif ($_SESSION["UserLogged"]) {
      print "You are already logged in. You cannot signup twice...";
      displayUserDetails($connection);
    } elseif (
      isset($_POST["FirstName"]) &&
      isset($_POST["LastName"]) &&
      isset($_POST["Username"]) &&
      isset($_POST["Password"])
    ) {
      print "You have been successfully registered<br>";
      $isUserThere = $connection->prepare("SELECT * FROM ppl WHERE UserName=?");
      $isUserThere->bind_param("s", $_POST["Username"]);
      $isUserThere->execute();
      $result = $isUserThere->get_result();
      if ($result->num_rows > 0) {
        print "The username you typed has already been taken ! Please try another one <br>";
      } else {
        $stmt = $connection->prepare(
          "INSERT INTO ppl(First_Name,Second_Name,Age,UserName,Password,Nationality,User_type) VALUES(?,?,?,?,?,?,?)"
        );
        $hashedPassword = password_hash($_POST["Password"], PASSWORD_BCRYPT);
        $userDefault = 2;
        $stmt->bind_param(
          "ssissii",
          $_POST["FirstName"],
          $_POST["LastName"],
          $_POST["Age"],
          $_POST["Username"],
          $hashedPassword,
          $_POST["Country"],
          $userDefault
        );
        $stmt->execute();
        print "You have been registered. Check the database <br>";
        $_SESSION["UserLogged"] = true;
        $newSelectStatement = $connection->prepare(
          "SELECT PERSON_ID FROM ppl WHERE UserName=?"
        );
        $newSelectStatement->bind_param("s", $_POST["Username"]);
        $newSelectStatement->execute();
        $resultingUser = $newSelectStatement->get_result();
        $rowCurrentId = $resultingUser->fetch_assoc();
        $_SESSION["CurrentUser"] = $rowCurrentId["PERSON_ID"];
        displayUserDetails($connection);
        /* ?><a href="login_page.php">Go To the login page</a><?php */
      }
    } else {
       ?>
        <form action="Signup.php" method="post">
            First name: <input type="text" name="FirstName" placeholder="First Name" required><br>
            Last name: <input type="text" name="LastName" placeholder="Last Name" required><br>
            Age: <input type="text" name="Age" placeholder="Age" required><br>
            UserName: <input type="text" name="Username" placeholder="Username" required><br>
            Password: <input type="password" name="Password" placeholder="Password" required><br>

            <select name="Country">
                <?php
                $stmt = $connection->prepare("SELECT * FROM countries");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' .
                      $row["COUNTRY_ID"] .
                      '">' .
                      $row["COUNTRY_NAME"] .
                      '</option>';
                  }
                } else {
                  echo "0 results";
                }

      // $connection->close();
      ?>
            </select>
            <br>
            <input type="submit" name="Register" value="Register">
        </form>
    <?php
    }
    ?>

</body>

</html>