<?php

    //Connect to database and get information to display information from rows with key number

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $customerID = null;

    if (!empty($_GET['CustomerID'])) {
        $customerID = $_REQUEST['CustomerID'];
    }

    if (null==$customerID) {
        header("Location: customer.php");
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM customer where CustomerID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($customerID));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }
?>

<script>

    //Script to hide and reveal password

    function revealPswrd() {
        var x = document.getElementById("pswrdReveal");
        if (x.type === "password") {
            x.type = "text";
        }

        else {
            x.type = "password";
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Customer Info</title>
</head>
<body>

<style>

    img {
        border: solid 2px;
        margin: 10px;
    }

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

    td {
        border-top: 1px solid;
    }

    td a {
        color: black;
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

<div class="container">
<div id="subIntro">
        <h1>INSPECT CUSTOMER INFORMATION</h1>
    </div>

    <div id="info">
        <label>Username</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['username'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Password</label>
        <div>
            <input id="pswrdReveal" type="password" readonly class="form-control-plaintext" value="<?php echo $data['pword'];?>" > <br>
            <input type="checkbox" onclick="revealPswrd()">Reveal Password

        </div>
    </div>

    <div id="info">
        <label>First Name</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['first_name'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Last Name</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['last_name'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Phone Number</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['phone'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Email</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['email'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Street Address</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['strt_ad'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Postal Code</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['postcode'];?>" >
        </div>
    </div>
    
    <div id="info">
        <label>City</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['city'];?>" >
        </div>
    </div>

    <div id="info">
        <a id="return" href="customer.php">Return</a>
    </div>

</div>
    
</body>
</html>