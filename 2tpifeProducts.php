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

  </ul>
  <div class="heading">
    <h1>ALL KIND OF SHOES FOR MEN AND WOMEN</h1>
  </div>

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
    <?php 
    
    if(isset($_POST["BuyItem"])){
      array_push($_SESSION["Basket"], $_POST["BuyItem"]);
    }
    if (isset($_POST["Logout"])) {

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
          $_SESSION["Basket"] = [];

          displayUserDetails($connection);
        } else {
          print "Password mismatched ! Please type your password correctly"; ?>
          <a href="2tpifeProducts.php">Try again to login</a>
        <?php
        }
      } else {
        print "The username you typed has not been found in our database !!"; ?>
        <a href="Signup.php">
          <h2>PLEASE REGISTER YOUR ACCOOUNT FIRST</h2>
        </a> <br>
        <a href="2tpifeProducts.php">
          <h4>Please try again to login</h4>
        </a>
      <?php
      }
    } else {
      ?>

    <?php
    }
    ?>
  </div>

<div><a href="finishOrder.php"><h3>BASKET</h3></a><?php print sizeof($_SESSION["Basket"]);?> </div>
  
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
          <input type="submit" name="BuyItem" id="BuyItem" value="AddToBasket"><br>

          

        </form>
      </div>
    <?php }
    ?>

  </div>

  <div class="table2">
    <table>
      <tr>
        <th>COLLECTIONS</th>
        <th>CUSTOMER SERVICE</th>
        <th>ABOUT US</th>
        <th>SOCIAL</th>
      </tr>
      <tr>
        <td>Men leather sneakers</td>
        <td>frequently asked qustions</td>
        <td>Our Story</td>
        <td>instagram</td>
      </tr>
      <tr>
        <td>Men canvas sneakers</td>
        <td>Size chart</td>
        <td>Video</td>
        <td>facebook</td>
      </tr>
      <tr>
        <td>Women leather sneakers</td>
        <td>Delivery & return</td>
        <td>Sustainability</td>
        <td>Vimeo</td>
      </tr>
      <tr>
        <td>Women canvas sneakers</td>
        <td>Payment</td>
        <td>Blog</td>
        <td>Twitter</td>
      </tr>

    </table>
  </div>
  <br>
  <br>

  <div class="subcribe2">
    <h2>SUBCRIBE TO NEWSLETTER</h2>
    <h3>Thank you for visiting my page</h3>
    <strong>Goldshajan Goldwin Ignasius</strong>
  </div>
  <br>
  <br>
</body>

</html>