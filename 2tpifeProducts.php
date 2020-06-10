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
  <title>Products Page</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='2tpifGol.css'>

</head>

<body>
  <nav id="NavigationBar">
    <div id="NavigationTitle">
      Products
    </div>
    <div id="NavigationLinks">

    <a href="2tpif_Home.html">Home</a>
      <a href="2tpif_products.html">Products</a>
      <a href="2tpif_about.html">About</a>
    </div>

    <?php
    if (isset($_POST["Logout"])) {
      session_unset();
      session_destroy();
      print "You have been successfully logged-out" . "<br>";

    ?>

      <a href="2tpifeProducts.php"> Click here to login again </a>

      <?php

    } elseif ($_SESSION["UserLogged"]) {

      print "You have already been logged-in" . "<br>";
      displayUserDetails($connection);
    } elseif (isset($_POST["Username"]) && isset($_POST["Password"])) {
      $userFromMyDatabase = $connection->prepare(
        "SELECT * FROM ppl WHERE UserName=?"
      );
      $userFromMyDatabase->bind_param("s", $_POST["Username"]);
      $userFromMyDatabase->execute();
      $result = $userFromMyDatabase->get_result();
      if ($result->num_rows === 1) {

        print "Your password is being verified " . "<br>";
        $row = $result->fetch_assoc();
        if (password_verify($_POST["Password"], $row["Password"])) {

          $_SESSION["UserLogged"] = true;
          $_SESSION["CurrentUser"] = $row["PERSON_ID"];
          displayUserDetails($connection);
        } else {
          print "Password mismatched ! Please type your password correctly"; ?>
          <form>
            <div>
              <label for="password">Password</label>
              <input type="password" name="Password">
            </div>
            <input type="submit" value="Login">
          </form> <?php
                }
              } else {

                print "The username you typed has not been found in our database !!"; ?>

        <a href="signup.php">Please register first</a> <br>
        <a href="2tpifeProducts.php">Try to login</a>
      <?php
              }
            } else {

      ?>
      <div id="Login">
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
          <div>
            <label for="Username">Username</label>
            <input type="text" name="Username">
          </div>

          <div>
            <label for="password">Password</label>
            <input type="password" name="Password">
          </div>
          <input type="submit" value="Login">
        </form>

      </div>

    <?php

            } ?>
    <div id="Signup"> <a href="signup.php">Signup</a></div>
    <div id="NavigationLanguage">
      <a href="L">Change Language</a>
    </div>
  </nav>


  <h1>This is a list of our products</h1>
  <div id="AllProducts">

    <?php
    $product = $connection->prepare("SELECT * FROM products");
    $product->execute();
    $result = $product->get_result();
    while ($row = $result->fetch_assoc()) {
    ?>

      <div class="Product">
        <img src="<?php print $row["Picture"]; ?>" width="30%" length="40%" />
        <h3>Name: <?php print $row["Name"]; ?></h3>
        <h2>Description: this is the description</h2>
        <h4>Price: 3 &euro;</h4>
      </div>

      <form action="2tpifeproducts.php" method="post">
        <input type="hidden" name="BuyItem" value="<?php print $row["ID"]; ?>">
        <input type="submit" name="Buy" value="Buy">
      </form>
    <?php

    }
    ?>

  </div>

  <?php
  if (isset($_POST["Buy"])) {
    print "done";
  }
  ?>
</body>

</html>