<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel='stylesheet' type='text/css' media='screen' href='2tpifeGol.css'>
    <style>

    </style>
</head>

<body>
    <?php
    include_once "sessionCheck.php";
    include_once "credentials.php";

    if (!$_SESSION["UserLogged"]) {
        print "You are not allowed here!";
    ?>

        <a href='2tpifeProducts.php'>
            <h1>Go to the products page</h1>
        </a>
    <?php exit();
    }

    $userSelect = $connection->prepare("SELECT User_type FROM ppl WHERE PERSON_ID=?");
    $userSelect->bind_param("i", $_SESSION["CurrentUser"]);
    $userSelect->execute();
    $resultUser = $userSelect->get_result();
    $rowUser = $resultUser->fetch_assoc();
    if ($rowUser["User_type"] !== 1) {
    ?>

    <?php exit();
    }
    if (isset($_POST["userToDelete"])) {
        $users = $connection->prepare("DELETE FROM ppl WHERE UserName=?");
        $users->bind_param("s", $_POST["userToDelete"]);
        $users->execute();
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
    <table>
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
            <tr>
                <td><input type="submit" name="userToDelete" value="DeleteItem"></td>
            </tr>
        </form>
    </table>

</body>

</html>