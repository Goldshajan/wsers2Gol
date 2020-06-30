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
      background: linear-gradient(rgb(236, 8, 46), rgb(236, 38, 54), rgb(255, 255, 255));

    }

    .active {
      background-color: rgb(240, 12, 12);
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
      <a href="2tpifeProducts.php">Products</a>
    </li>
    <li>
      <a class="active" href="2tpifeAbout.php">About</a>
    </li>
    <li style="float: right" >
      <a href="Signup.php">Signup</a>
    </li>
   
  </ul>

  <div class="heading">
    <h1>All kind of shoes for women and men</h1>
  </div>
  <br>

  <script>
    window.onscroll = function() {
      myFunction()
    };
    var header = document.getElementById("myHeader");

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

      /*  ?> <a href="2tpifeProducts.php">Login</a><?php */
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
      $userFromMyDatabase = $connection->prepare(
        "SELECT * FROM ppl WHERE UserName=?"
      );
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
          <a href="2tpifeProducts.php">Try again to login</a><?php
                                                            }
                                                          } else {
                                                            print "The username you typed has not been found in our database !!"; ?>
        <a href="Signup.php">Please register first</a> <br>
        <a href="2tpifeProducts.php">Try again to login</a>
      <?php
                                                          }
                                                        } else {
      ?>
      <form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
        
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
                                                        } ?>
  </div>

  

  <div class="homecontainer">
    <img class="myhomephoto" src="homepic.png" alt="human">
  </div>
  <br>
  <div class="secondbox">
        <div class="LeftSide">
            <h2>ABOUT HUB FOOTWEAR</h2>
            <p>Since its foundation in 2004, HUB has remained focused on its main objective, to only design high-quality footwearthat</p>
            <p> is truly timeless. The brand represents an athletic, metropolitan lifestyle, combined with a clean, minimalist
                appearance.
            </p>
            <p>An attitude and style that is expressed clearly throughout each collection. HUB’s founder Huub van Boeckel, a
                former
            </p>
            <p>professional tennis player, never lost his strong mentality or his love for sneakers – which inspired him to
                start
            </p>
            <p>developing his own sneaker. Each season, these characteristics are closely observed and will serve as an inspiration</p>
            <p>to reinvent some of the classic designs, resulting in a must-have for the next season.Materials, patterns, style</p>
            <p>and subtle details are all reworked in order to create a unique range of clean, minimalist styles, thus staying
                true
            </p>
            <p>to the roots and ideals of this Dutch firm.</p>
        </div>


        <img src="aboutfirst.png" alt="shoe">


    </div>
    <br>
    <br>

    <div class="thirdbox">
        <div class="aboutpic">
            <img src="aboutpic.png" alt="human" width="800" height="600">
        </div>
        <div class="thirdbox2">
            <h2>HUB’s founder Huub van Boeckel,</h2>
            <h2>aformer professional tennis player</h2>
            <h2>never lost his strong mentality or</h2>
            <h2>his love fro sneakers. As a result, HUB</h2>
            <h2>Footwear was born in 2004.</h2>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="doc2">
        <div class="doc1">
            <h1 class="head">TENNIS INSPIRED</h1>
            <h4>What strated as dream to create a tennis shoe for daily life, soon became arange of classic and iconic footwear</h4>
            <h4>silhouettes. This season,HUB is celebrating its philosophy by giving our key styles rhe ultinate Tennis Inspired</h4>
            <h4>look the hook and the zone all leather executions. Mainly white uppers and perforated detalis, referring</h4>
            <h4>back the sophisticated classic Tennis style. A fresh and clean look which will be easy-to-wear in any modern</h4>
            <h4>lifestyle.</h4>

        </div>
        <div class="imageabout">
            <img src="about3pic.png" alt="human" width="700" height="600">
        </div>
    </div>

<br>
<br>
<br>

<div class="table3">
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
    
      <div class="subcribe3">
        <h2>SUBCRIBE TO NEWSLETTER</h2>
        <h3>Thank you for visiting my page</h3>
        <strong>Goldshajan Goldwin Ignasius</strong>
    
      </div>
      <br>
      <br>
    

    
    </body>
    
    </html>


</body>

</html>