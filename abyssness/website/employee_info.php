<?php

    //Include and connect to database to access and display worker information

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $workerID = null;

    if (!empty($_GET['workerID'])) {
        $workerID = $_REQUEST['workerID'];
    }

    if (null==$workerID) {
        header("Location: employees.php");
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

    $rating = $data['likes'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['name']; ?></title>
</head>

<style>

    p {
        font-family: scpTypeWriter2;
        font-size: 30px;
    }

    .return {
        margin: 50px;
        font-family: scpTypeWriter1;
        font-size: 30px;
    }

    .return a {
        color: black;
    }

    .about_section {
        max-width: 700px;

        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 600px));

        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .about {
        border-top: double 5px;
    }

    .container {
        border: 3px;
        border-style: dashed;
        margin: 70px;
        padding: 20px;
        box-shadow: 1px 1px 3px 1px;
    }

    .gallery {
        display: flex;
    }

    .profile img{
        border: 15px;
        border-style: double;
        padding: 10px;
        box-shadow: 1px 1px 10px 1px;
        display: flex;
    }

    #info h1 {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 300px));

        font-family: scpTypeWriter2;
        text-decoration: underline;
    }

    #info h2 {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 370px));

        font-family: scpTypeWriter1;
        text-decoration: underline;
    }

    #info p {
        font-size: 20px;
    }

    #name {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 260px));
    }
    
    #occupation {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 340px));
    }

    #hire {
        position: absolute;
        right: 140px;
        bottom: calc((100% - 300px));
        padding-left: 5px;
        padding-right: 5px;
        border: dashed;
        box-shadow: 1px 1px 10px 1px;
    }

    #hire:hover {
        box-shadow: inset 1px 1px 10px 1px;
    }

    #hire h1 {
        font-family: scpTypeWriter2;
    }

    #notin {
        position: absolute;
        right: 140px;
        bottom: calc((100% - 300px));
        padding-left: 5px;
        padding-right: 5px;
        border: solid;
    }

    #notin h1 {
        font-family: scpTypeWriter2;
    }

</style>

<header>
<!-- Start session to retain customer login and information -->
    <?php session_start(); ?>
</header>

<body>

<div class="return">
    <a href="employees.php">Return</a>
</div>

<div class="container">

    <div class="gallery">
        <div class="profile">
            <img style="width:400px;" src="worker/pfp/<?php echo $data['pfp'];?>">
            <div id="info">
                <p id="name">Specimen Name: </p>
                <h1><?php echo $data['name']; ?></h1>
                <p id="occupation">Specimen Occupation: </p>
                <h2><?php echo $data['job']; ?></h2>
            </div>
        </div>
    </div>

    <div class="about_section">
        <label style="font-family:scpTypeWriter2; font-size:30px;">ABOUT</label>
        <div class="about">
            <p><?php echo $data['about']; ?></p>
        </div>
    </div>

    <div class="rating">
        <h1 style="font-family:scpTypeWriter2;">Overall rating: <?php echo $rating; ?></h1>
    </div>

<!-- Allow only for logged in customers to access the hiring process -->

    <?php 
        if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
            echo '<div id="hire">';
            echo "<h1><a href=\"hire_process.php?workerID=" . $data['workerID']. "\" style=\"text-decoration:none; color:black;\">Hire This Guy</a></h1>";
            echo '</div>';
        }

        elseif (isset($_SESSION["asignedin"]) && $_SESSION["asignedin"] === true) {
            echo '<div id="notin">';
            echo '<h1><a href="aprofile.php" style="text-decoration:none; color:black;">Please log in normally to hire</a></h1>';
            echo '</div>';
        }

        else {
            echo '<div id="notin">';
            echo '<h1><a href="sign.php" style="text-decoration:none; color:black;">Please log in to hire</a></h1>';
            echo '</div>';
        }
    ?>
</div>

</body>
</html>