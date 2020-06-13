<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='2tpife.css'>
    <title>Document</title>
    <style>
    #AllProducts {
        display : flex;
        justify-content : space-around;
        flex-wrap : wrap;
    }
    .Products{
        text-align : center;
    }
    #mainTitle{
        display:flex;
        justify-content:space-between;
    }
    </style>
</head>
<body>
<?php
include_once "credentials.php";
include_once "sessionCheck.php";
?> 
<?php
if (isset($_POST["itemToDelete"])) {
  print "Some item has been deleted !";
  array_push($_SESSION["Basket"], $_POST["itemToOrder"]);
}
if (isset($_POST["ItemToOrder"])) {
  print "Some item has been ordered";
  array_push($_SESSION["Basket"], $_POST["ItemToOrder"]);
}
?>
<div id="mainTitle">
<h1>These are your products</h1>
<h1>Basket contents <?= sizeOf($_SESSION["Basket"]) ?><a href="finishOrder.php"> Order </a> </h1>

</div>

<h1>This is our products:</h1>
<div id="AllProducts">
    <?php
    $sqlProducts = $connection->prepare("SELECT * FROM products");
    $sqlProducts->execute();
    $resultProducts = $sqlProducts->get_result();
    while ($row = $resultProducts->fetch_assoc()) { ?>
        <div class="Product">
            <img src="<?= $row["Picture"] ?>" >
            <div><?= $row["NAME"] ?> </div>
            <div><?= $row["Description"] ?></div>
            <div>Price: &euro;</div>
            <form action="myList.php" method="post">
                <input type="hidden" name="ItemToOrder" value=" <?= $row["ID"] ?>">
                <input type="submit" value="Buy" />
            </form>
        </div>
        <?php }
    ?>
    

    
  
</div>

    
</body>
</html>