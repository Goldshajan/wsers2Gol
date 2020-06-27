<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Finish order</title>
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

    body {
      background-color: rgb(245, 156, 218);

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
      <a href="2tpifeAbout.php">About</a>
    </li>
  </ul>

  <h1>Finish your order here:</h1>
  <?php
  include_once "sessionCheck.php";
  include_once "credentials.php";


  if (!$_SESSION["UserLogged"]) {
    die("You cannot be here- you must log in first in order to finish your order");
  }
  if (isset($_POST["ItemToDelete"])) {
    array_splice($_SESSION["Basket"], $_POST["ItemToDelete"], 1);
  }

  if (sizeof($_SESSION["Basket"]) === 0) {
    print "You have nothing in your basket ! " . "<br>";
  } else {
    $total = 0;
    for ($i = 0; $i < sizeof($_SESSION["Basket"]); $i++) {

      $sqlSelect = $connection->prepare("SELECT NAME, Price FROM products WHERE ID=?");
      $sqlSelect->bind_param("i", $_SESSION["Basket"][$i]);
      $sqlSelect->execute();
      $myResult = $sqlSelect->get_result();
      if ($row = $myResult->fetch_assoc()) {
        print $row["NAME"] . "\n" . $row["Price"] . "Euros" . "<br>";
        $total = $total + $row["Price"];
      }
  ?>
      <form action="finishOrder.php" method="post">
        <input type="hidden" name="ItemToDelete" value="<?= $i ?>" />
        <input type="submit" name="Delete" value="Delete" />


      </form> <br>
      <?php

      /* $sqlFinalOrder = $connection->prepare("INSERT INTO ppl());
      $sqlFinalOrder->bind_param("i", $_SESSION["Basket"][$i]);
      $sqlFinalOrder->execute();
      $MyResultOrder = $sqlFinalOrder->get_result();
      if($row = $MyResultOrder->fetch_assoc()){
        //print "Your order has been confirmed please check database";

      }*/

      ?>

  <?php
    }
    print "<h2>Total amount to pay is &euro; $total</h2>";
  }

  ?>
  <form action="finishOrder.php" method="post">

    <input type="submit" name="Payment" value="Buy" />


  </form> <br>


</body>

</html>