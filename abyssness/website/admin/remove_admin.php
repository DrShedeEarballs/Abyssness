<?php

    //Include and connect to database to be able to delete the information of the current table

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $adminID = null;

    if (!empty($_GET['adminID'])) {
        $adminID = $_REQUEST['adminID'];

        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM admin WHERE adminID = ?";
        $q = $pdo->prepare($sql);
        $pdo->exec("set names utf8");
        $q->execute(array($adminID));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }

    if (!empty($_POST)) {
        $adminID = $_POST['adminID'];

        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM admin WHERE adminID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($adminID));

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
    <title>Remove Admin</title>
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
        <h1>REMOVE WORKER</h1>
    </div>

    <form action="remove_admin.php" method="post">
        <input type="hidden" name="adminID" value="<?php echo $adminID;?>"/>
        <p style="font-family:scpTypeWriter2; font-size:25px;">Are you sure you want to remove admin <?php echo $data['user']?> from the system?</p>
        <div>
            <button type="submit">Yes</button>
            <a id="return" href="admin.php">No</a>
        </div>
    </form>
</div>
    
</body>
</html>