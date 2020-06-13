<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <style>
    .Products {
      display: inline-block;
      background-color: aquamarine;
      padding: 5px;
      border: 2px solid greenyellow;
    }
  </style>
</head>

<body>
  <h1>Our products are the following</h1>
  <div class="Products">
    <img src="melon.jpg">
    <p>This is a melon</p>
    <p>Name of the product</p>
    <p>Price: 5 &euro;</p>
  </div>

  <div class="Products">
    <img src="carrot.jpg">
    <p>This is a carrot</p>
    <p>Name of the product</p>
    <p>Price: 2 &euro;</p>
  </div>
</body>

</html>

<?php include_once "credentials.php"; ?>
<h1>These are our products</h1>
    <div id="AllProducts">
    <?php
    $connection = mysqli_connect("localhost", "root", "", "testExample");
    if (!$connection) {
      die("We did not manage to connect to the database");
    }
    $products = $connection->prepare("SELECT * FROM products");
    if (!$products) {
      die("The select statement was wrong");
    }
    /*$limitPrice = 7;
     $products->bind_param("i", $limitPrice); */
    $products->execute();
    $result = $products->get_result();
    while ($row = $result->fetch_assoc()) { ?>
        <div class="Product">
            <img src="<?php print $row["Picture"]; ?>">
            <?php print $row["Description"]; ?>
            Price <?php print $row["Price"]; ?> &euro;
            <form action="2tpifeProducts.php" method="post">
              <input type="hidden" name="BuyItem" value="<?php print $row["ID"]; ?>" >
              <input type="submit" name="BuyItem" id="BuyItem" value="Buy">
            </form>
            <?php }
    ?>
          </div>