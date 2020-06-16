<?php
include_once "sessionCheck.php";
include_once "credentials.php";
include_once "displayUser.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link rel='stylesheet' type='text/css' media='screen' href='2tpifeGol.css'>
  <style>
    .shajan {
      padding: 200;
      text-align: center;
      height: 100px;
      background: linear-gradient(rgb(253, 1, 77), rgb(212, 25, 72), rgb(255, 255, 255));
    }

    .active {
      background-color: rgb(248, 2, 64);
    }
  </style>
</head>

<body>
  <h1 class="shajan">HUB
    <br>International free shipping All Europe </h1>
  <h1></h1>
  <ul>
    <li>
      <a class="active" href="2tpifeHome.php">Home</a>
    </li>
    <li>
      <a href="2tpifeProducts.php">Products</a>
    </li>
    <li>
      <a href="2tpifeAbout.php">About</a>
    </li>
    <li style="float: right">
      <a href="Signup.php">Signup</a>
    </li>
    <li style="float: right">
      <a href="login_page.php">login</a>
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
    <h1>All kind of shoes for women and men</h1>
  </div>
  <br>

  <script>
    window.onscroll = function() {
      myfunction()
    };
    var header = document.getElementById("myHeader");

    function myfunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      }
    }
  </script>

  <div id="login">
    <?php if (isset($_POST["Logout"])) {

      session_unset();
      session_destroy();
      print "You have been logged out successfully";

    ?>
      <?php
      $bDisplaySignup = false;
      if (!isset($_SESSION["UserLogged"])) {
        $bDisplaySignup = true;
      } elseif (!$_SESSION["UserLogged"]) {
        $bDisplaySignup = true;
      }

      if ($bDisplaySignup) {
      ?>
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
        <a href="Signup.php">
          <h1>Please register first</h1>
        </a> <br>
        <a href="2tpifeProducts.php">
          <h2>Try again to login</h2>
        </a>
    <?php
      }
    }
    ?>
  </div>


  <div class="homecontainer">
    <img class="myhomephoto" src="homepic.png" alt="human">
  </div>

  <div class="myFlexContainer2">
    <div class="homedown1">
      <img src="homepagedown.png" alt="shoe" width="400" height="300">

      <img src="homepagedown2.png" alt="shoe" width="400" height="300">
    </div>

    <div class="boxdown">
      <h2>In Spring 2018 we provide</h2>
      <h2>freedom of movement for the</h2>
      <h2> Urbon Player. Pushing comfort</h2>
      <h2>to a professional level.</h2>
      <h2>Designes to fit the dynamic and</h2>
      <h2>versatile lifestyle. Inspired by</h2>
      <h2>Tennis,styled for Urban life</h2>

    </div>

    <div class="downphotos">
      <img src="homepagedown3.png" alt="shoe" width="800" height="700">
    </div>
  </div>
  <br>

  <div class="intro">
    <h2>INTRODUCTION</h2>
    <h4> Since its foundation in 2004, HUB has remained focused on its main objective,</h4>
    <h4> to only design hign quality footwear that is truly timeless. The brand represents</h4>
    <h4> an athletic, metropolitan lifestyle, combined with a clean, minimalist appearance.</h4>
    <h4> An attitude and style that is expressed clearly throughout each collection.HUB`s</h4>
    <h4> founder Huub van Boeckel, a former professional tennis player,never lost his strong </h4>
    <h4> mentality or his love for sneakers-which inspired him to start developing his own</h4>
    <h4> sneakers. each season, these characteristics are closely observed and will serve as</h4>
    <h4> inspiration to reinvent some of the classic designs, resulting in a must-have for</h4>
    <h4> the next season.</h4>

  </div>
  <br>
  <br>


  <div class="downintrophoto">
    <img src="downintro.png" alt="shoehuman" width="700" heisght="600">



    <div class="downbox">
      <h1>OUR VISION</h1>
      <p>HUB Footwear and sports have always been</p>
      <p>inextricably connected. Its founder, a former</p>
      <p>professional tennis player, shares a rich pas</p>
      <p>in sports-much like the larger part of HUB`s </p>
      <p>employees.HUB`s passion for sports is nortice able</p>
      <p>in each season`s new collection.</p>
    </div>




    <div class="down3">
      <h1>Inspired by </h1>
      <h1>Tennis,styled</h1>
      <h1>for Urban life</h1>

      <img src="downp.png" alt="shoehuman" width="400" height="300">

    </div>
  </div>
  <br>
  <br>


  <div class="table1">
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

  <div class="subcribe1">
    <h2>SUBCRIBE TO NEWSLETTER</h2>
    <h3>Thank you for visiting my page</h3>
    <strong>Goldshajan Goldwin Ignasius</strong>
  </div>
  <br>
  <br>


</body>

</html>