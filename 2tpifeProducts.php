<?php
include_once "sessionCheck.php";
include_once "credentials.php";
include_once "displayUser.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Products</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='2tpifeGol.css'>
  <style>
    .shajan {
      padding: 200;
      text-align: center;

      height: 100px;
      background: linear-gradient(rgb(245, 3, 253), rgb(253, 4, 232), rgb(255, 255, 255));

    }

    .active {
      background-color: rgb(214, 63, 194);
    }
  </style>
</head>

<body>
  <h1 class="shajan">HUB
    <br>International free shipping All Europe </h1>
  <h1></h1>
  <ul>
    <li>
      <a href="2tpifeHome.php">Home</a>
    </li>
    <li>
      <a class="active" href="2tpifeProducts.php">Products</a>
    </li>
    <li>
      <a href="2tpifeAbout.php">About</a>
    </li>
    <li style="float: right">
      <a href="Signup.php">Signup</a>
    </li>
  </ul>
  <script>
    window.onscroll = function() {
      myFunction()
    };
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  </script>
  <div id="login">
    <?php if (isset($_POST["Logout"])) {

      session_unset();
      session_destroy();
      print "You have been logged out successfully";

    ?>
      <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
        <div>
          <div>
            <label for="Username">Username: </label>
            <input type="text" name="Username" placeholder="Username" required>
          </div>
          <div>
            <label for="Password">Password: </label>
            <input type="password" name="Password" placeholder="Password" required>
          </div>
        </div>
        <input type="submit" name="Login" id="loginButton" value="Login">
      </form>
      <?php
      $bDisplaySignup = false;
      if (!isset($_SESSION["UserLogged"])) {
        $bDisplaySignup = true;
      } elseif (!$_SESSION["UserLogged"]) {
        $bDisplaySignup = true;
      }

      if ($bDisplaySignup) { ?>
        <div id="Signup"><a href="Signup.php">Signup</a></div>
        <?php }
    } elseif ($_SESSION["UserLogged"]) {
      //print "You have already been logged-in" . "<br>";
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
          displayUserDetails($connection);
        } else {
          print "Password mismatched ! Please type your password correctly"; ?>
          <a href="2tpifeProducts.php">Try again to login</a>
        <?php
        }
      } else {
        print "The username you typed has not been found in our database !!"; ?>
        <a href="Signup.php">PLEASE REGISTER YOUR ACCOOUNT FIRST</a> <br>
        <a href="2tpifeProducts.php">Try again to login</a>
      <?php
      }
    } else {
      ?>
      <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
        <div>
          <div>
            <label for="Username">Username: </label>
            <input type="text" name="Username" placeholder="Username" required>
          </div>
          <div>
            <label for="Password">Password: </label>
            <input type="password" name="Password" placeholder="Password" required>
          </div>
        </div>
        <input type="submit" name="Login" id="loginButton" value="Login">
      </form>
    <?php
    }
    ?>
  </div>

  <?php if (isset($_SESSION["UserLogged"])) {
    if (!$_SESSION["UserLogged"]) { ?>
      <div id="Signup"><a href="Signup.php">Signup</a></div>
  <?php }
  } ?>
  </nav>
  <h1>These are our products</h1>
  <div id="AllProducts">
    <?php
    $products = $connection->prepare("SELECT * FROM products");
    $products->execute();
    $result = $products->get_result();
    while ($row = $result->fetch_assoc()) { ?>
      <div class="Product">
        <img src="<?php print $row["Picture"]; ?>"><br>
        <?php print $row["Description"]; ?> <br>
        Price <?php print $row["Price"]; ?> &euro;<br>
        <form action="2tpifeProducts.php" method="post">
          <input type="hidden" name="BuyItem" value="<?php print $row["ID"]; ?>">
          <input type="submit" name="BuyItem" id="BuyItem" value="Buy">
        </form>
      <?php }
      ?>
      </div>
</body>

</html>