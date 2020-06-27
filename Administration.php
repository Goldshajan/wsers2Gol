<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>
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

        body {
            background-color: rgb(248, 143, 143);
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
        <li style="float: right">
            <a href="Signup.php">Signup</a>
        </li>
        <li style="float: right">
            <a href="login_page.php">login</a>
        </li>
    </ul>

    <?php
    include_once "sessionCheck.php";
    include_once "credentials.php";

    if (!$_SESSION["UserLogged"]) {
        print "<h3>WARNING!! Access denied!<br> You have to be a Admin to access this page!</h3><BR>";
        print "<h3>Remember If you are admin please login with your Username and Password </h3>";
    ?>
        <a href='2tpifeProducts.php'>
            <h2>Login access</h2>
        </a>
        <?php exit();

        $userSelect = $connection->prepare("SELECT User_type FROM ppl WHERE PERSON_ID=?");
        $userSelect->bind_param("i", $_SESSION["CurrentUser"]);
        $userSelect->execute();
        $resultUser = $userSelect->get_result();
        $rowUser = $resultUser->fetch_assoc(); {
        ?>
            }

        <?php exit();
        }
        $users = $connection->prepare("SELECT UserName FROM ppl WHERE PERSON_ID <>?");
        $users->bind_param("i", $_SESSION["CurrentUser"]);
        $users->execute();
        $resultUsers = $users->get_result();
        while ($rowUsers = $resultUsers->fetch_assoc()) { ?>

            <form action="Administration.php" method="post">
                <input type="hidden" name="userToDelete" value="<?php print $rowUsers["UserName"]; ?>">

                <?php print $rowUsers["UserName"]; ?>
                <input type="submit" name="Delete" id="deleteButton" value="Delete">

            </form>
            <br>
            <br>
        <?php }

        if (isset($_POST["Add"])) {
            $addProduct = $connection->prepare("INSERT INTO products(NAME,Description,Price,Picture) VALUES(?,?,?,?)");
            $addProduct->bind_param("ssis", $_POST["ProductName"], $_POST["Description"], $_POST["Price"], $_POST["Picture"]);
            $addProduct->execute();
            $resultProduct = $addProduct->get_result();
        }

        ?>
        <table id="AdminTable">
            <form action="Administration.php" method="post">
                <tr>
                    <td>Name: <input type="text" name="ProductName" placeholder="Product Name" required></td>
                </tr>
                <tr>
                    <td>Description: <input type="text" name="Description" placeholder="Description"></td>
                </tr>
                <tr>
                    <td>Price: <input type="text" name="Price" placeholder="Price" required></td>
                </tr>
                <tr>
                    <td>Picture: <input type="text" name="Picture" placeholder="Picture" required></td>
                </tr>
                <tr>
                    <td><input type="submit" name="Add" id="addButton" value="AddProducts"></td>
                </tr>

            </form>
        </table>
        <?php

        if (isset($_POST["itemToDelete"])) {
            $mysqlDeleteItem = $connection->prepare("DELETE FROM Products WHERE ID=?");
            $mysqlDeleteItem->bind_param("i", $_POST["itemToDelete"]);
            $mysqlDeleteItem->execute();
        }

        $mysqlDeleteItem = $connection->prepare("SELECT ID, NAME, Price FROM Products WHERE ID <>?");
        $mysqlDeleteItem->bind_param("i", $_SESSION["DeleteItem"]);
        $mysqlDeleteItem->execute();
        $resultItem = $mysqlDeleteItem->get_result();
        while ($rowItem = $resultItem->fetch_assoc()) { ?>
            <table>
                <form action="deleteItem.php" method="post">
                    <input type="hidden" name="itemToDelete" value="<?php print $rowItem["ID"]; ?>">
                    <tr>
                        <td>
                            <?php print $rowItem["ID"] . "<br>" . $rowItem["NAME"] . "<br>" . $rowItem["Price"]; ?>
                        </td>
                        <td><input type="submit" name="Delete" id="itemToDelete" value="Delete"></td>
                    </tr>
                </form>
            </table> <br><br>

        <?php
        }
        ?>
        <table>
            <form action="Administration.php" method="post">
                <tr>
                    <td>ID of the Product: <input type="text" name="itemToDelete" placeholder="Product's ID" required></td>
                </tr>
                <tr>
                    <td id="deleteProduct"><input type="submit" name="DeleteItem" id="deleteButton" value="Delete"></td>
                </tr>
            </form>
        </table>
    <?php
    }
    ?>

</body>

</html>