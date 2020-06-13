<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Flex test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            #fullContainer {
                display: flex;
                align-items: center;
                justify-content: space-around;
                background-color: salmon;
            }
            img {
                height: 100px;
                transition: height 3s;
            }

            .Product {
                position: relative;
                border: 1px solid red;
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 10px;
                text-align: center;
                background-color: springgreen;
                transition: background-color 0.5s;
            }

            .Product:hover {
                background-color: brown;
            }

            .SoldOut {
                position: absolute;
                top: 50%;
                background-color: red;
            }
            a {
                background-color: chartreuse;
                transition: font-size 2s;
            }
            a:hover {
                font-size: larger;
            }
        </style>
    </head>
    <body>
        <div id="fullContainer">
            <h1>
                The following are Our products:
                
            </h1>
            <div id="AllProducts"><?php
            include_once "credentials.php";
            $products = $connection->prepare("SELECT * FROM products");
            $products->execute();
            $resultProducts = $products->get_result();
            while ($rowProducts = $resultProducts->fetch_assoc()) { ?><div class="Product">
              <img src="<?php print $rowProducts["Picture"]; ?>" />
              <h4><?php print $rowProducts["Description"]; ?></h4>
              <h3><?php print $rowProducts["Price"]; ?> &euro;</h3>
          </div><?php }
            ?>
        </div>
    </body>
</html>
