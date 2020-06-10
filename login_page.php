<?php
include_once "sessionCheck.php";
include_once "credentials.php";
include_once "displayUser.php";

if (isset($_POST["Logout"])) {

  session_unset();
  session_destroy();
  print "You have been successfully logged-out" . "<br>";
  ?>
<a href="login_page.php"> Click here to login again </a>
<?php
} elseif ($_SESSION["UserLogged"]) {
  print "You have already been logged-in" . "<br>";
  displayUserDetails($connection);
} elseif (isset($_POST["Username"]) && isset($_POST["Password"])) {
  $userFromMyDatabase = $connection->prepare("SELECT * FROM ppl WHERE UserName=?");
  $userFromMyDatabase->bind_param("s", $_POST["Username"]);
  $userFromMyDatabase->execute();
  $result = $userFromMyDatabase->get_result();
  if ($result->num_rows === 1) {
    print "You have been successfully logged-in " . "<br>";
    $row = $result->fetch_assoc();
    if (password_verify($_POST["Password"], $row["Password"])) {
      $_SESSION["UserLogged"] = true;
      $_SESSION["CurrentUser"] = $row["PERSON_ID"];

      $_SESSION["Basket"] = [];

      displayUserDetails($connection);
    } else {
      print "Password mismatched ! Please type your password correctly";
    }
  } else {
    print "The username you typed has not been found in our database !!"; ?>
    <a href="Signup.php">Please register first</a> <br>
    <a href="login_page.php">Try again to login</a>
    <?php
  }
} else {
   ?>
    <form action="login_page.php" method="post">
        Username: <input type="text" name="Username" placeholder="Username" required><br>
        Password: <input type="password" name="Password" placeholder="Password" required><br>
        <input type="submit" name="Login" value="Login">
    </form>
<?php
} ?>