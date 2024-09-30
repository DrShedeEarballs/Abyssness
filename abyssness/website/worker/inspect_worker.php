<?php

    //Connect to database and get information to display information from rows with key number

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $workerID = null;

    if (!empty($_GET['workerID'])) {
        $workerID = $_REQUEST['workerID'];
    }

    if (null==$workerID) {
        header("Location: worker.php");
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM worker where workerID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($workerID));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Worker Inspection</title>
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
        <h1>INSPECT WORKER INFORMATION</h1>
    </div>

    <div class="gallery"  id="info">
        <label>Profile Image</label>
        <div>
            <img style="width:200px;" src="pfp/<?php echo $data['pfp'];?>">
            <br>
            <input type="text" readonly value="<?php echo $data['pfp'];?>" >
        </div>
    </div>

    <div id="info">
        <label>Name</label>
        <div>
            <input type="text" readonly value="<?php echo $data['name'];?>" >
        </div>
    </div>

    <div  id="info">
        <label>Job</label>
        <div>
            <input type="text" readonly value="<?php echo $data['job'];?>" >
        </div>
    </div>

    <div  id="info">
        <label>About</label>
        <div>
            <input type="text" readonly value="<?php echo $data['about'];?>" >
        </div>
    </div>

    <div  id="info">
        <label>Hourly Rate</label>
        <div>
            <input type="text" readonly value="<?php echo $data['rate'];?>" >$/h
        </div>
    </div>

    <div  id="info">
        <label>Likes</label>
        <div>
            <input type="text" readonly value="<?php echo $data['likes'];?>" >
        </div>
    </div>

    <div  id="info">
        <a id="return" href="worker.php">Return</a>
    </div>

</div>
    
</body>
</html>