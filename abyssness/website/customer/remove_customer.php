<?php

    //Include and connect to database to be able to delete the information of the current table

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $customerID = null;

    if (!empty($_GET['CustomerID'])) {
        $customerID = $_REQUEST['CustomerID'];

        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customer WHERE CustomerID = ?";
        $q = $pdo->prepare($sql);
        $pdo->exec("set names utf8");
        $q->execute(array($customerID));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }

    if (!empty($_POST)) {
        $customerID = $_POST['CustomerID'];

        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customer WHERE CustomerID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($customerID));

        Database::disconnect();
        header("Location: C:xampp/htdocs/abyssness/website/index.html");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Remove Customer</title>
</head>

<style>

    .container {
        text-align: center;
        border-style: double;
        padding-bottom: 60px;
        margin-left: 60px;
        margin-right: 60px;
        margin-top: 60px;
        box-shadow: 1px 1px 10px 1px;
    }

    .table {
        margin-left: 700px;
    }

    #return {
        text-align: center;
        font-family: scpTypeWriter2;
        color: black;
    }

    #info {
        margin-top: 10px;
    }
    
</style>

<body>

<div class="container">
    <div id="subIntro">
        <h1>REMOVE CUSTOMER</h1>
    </div>

    <form action="remove_customer.php" method="post">
        <input type="hidden" name="CustomerID" value="<?php echo $customerID;?>"/>
        <p style="font-family:scpTypeWriter2; font-size:25px;">Are you sure you want to remove customer <?php echo $data['first_name'] . ' ' . $data['last_name'] ; ?> from the system?</p>
        <div>
            <button type="submit" class="btn btn-danger">Yes</button>
            <a id="return" href="customer.php">No</a>
        </div>
    </form>
</div>
    
</body>
</html>