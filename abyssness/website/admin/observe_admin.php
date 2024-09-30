<?php

    //Connect to database and get information to display information from rows with key number

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $adminID = null;

    if (!empty($_GET['adminID'])) {
        $adminID = $_REQUEST['adminID'];
    }

    if (null==$adminID) {
        header("Location: admin.php");
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM admin where adminID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($adminID));
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
    <title>Admin Info</title>
</head>

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

<body>

<div class="container">
    <div id="subIntro">
        <h1>OBSERVE ADMIN INFORMATION</h1>
    </div>

    <div id="info">
        <label>Username</label>
        <div>
            <input type="text" readonly value="<?php echo $data['user'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Password</label>
        <div>
            <input id="pswrdReveal" type="password" readonly value="<?php echo $data['pswrd'];?>"><br>
            <input type="checkbox" onclick="revealPswrd()">Reveal Password

        </div>
    </div>

    <div id="info">
        <label>Email</label>
        <div>
            <input type="text" readonly value="<?php echo $data['email'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Phone Number</label>
        <div>
            <input type="text" readonly value="<?php echo $data['phone'];?>" >
        </div>
    </div>

    <div id="info">
        <a id="return" href="admin.php">Return</a>
    </div>

</div>
    
</body>
</html>