<?php

    require_once 'C:xampp/htdocs/abyssness/website/inc/database.php';
    session_start();

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
        $wdata = $q->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_POST['submit']) && isset($_POST['submit']) == 'hire') {
        $customerID = $_POST['CustomerID'];
        $date = $_POST['date'];
        $hours = $_POST['hours'];
        $fullPrice = $_POST['full_price'];

        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "INSERT INTO hiring (CustomerID, date, hours, full_price) VALUES (?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($customerID, $date, $hours, $fullPrice));

        $hiringID = $pdo->lastInsertId();
        foreach ($worker as $key => $n) {
            $sql = "INSERT INTO hiring_final (hiringID, workerID, price) VALUES (?,?,?)";
            $q = $pdo->prepare($sql);
            $pdo->exec("set names utf8");
            $q->execute(array($hiringID, $worker[$key], $rate[$key]));
        }

        $pdo->commit();
        Database::disconnect();
        header('Location: hire_success.php');
    }

    $rateO = $wdata['rate'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hire <?php echo $wdata['name']; ?></title>
</head>

<style>

    .gallery {
        padding-bottom: 40px;
    }

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

    #info h3 {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 430px));

        font-family: scpTypeWriter1;
        font-size: 20px;
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

    #rate {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 400px));
    }

    #customerInfo {
        position: absolute;
        left: calc((100% - 700px) / 2);
        bottom: calc((100% - 600px));
    }

    #customerInfo h2 {
        font-family: scpTypeWriter1;
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

    #hire button {
        font-family: scpTypeWriter2;
        font-size: 40px;
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

    #headingFor {
        position: absolute;
        right: 400px;
        bottom: calc((100% - 550px));
        border-right: 5px double;
        padding: 15px;
    }

    #headingFor h2 {
        font-family: scpTypeWriter2;
        padding-top: 5px;
    }

    #headingFor p {
        padding
    }

    #hiringInfo {
        position: absolute;
        right: 150px;
        top: 350px;
    }

</style>

<body>

<div class="return">
    <a href="employee_info.php?workerID=<?php echo $wdata['workerID'] ?>">Nevermind</a>
</div>

<div class="container">

    <div class="gallery">
        <div class="profile">
            <img style="width:400px;" src="worker/pfp/<?php echo $wdata['pfp'];?>">
            <div id="info">
                <p id="name">Specimen Name: </p>
                <h1><?php echo $wdata['name']; ?></h1>
                <p id="occupation">Specimen Occupation: </p>
                <h2><?php echo $wdata['job']; ?></h2>
                <p id="rate">Specimen Rate: </p>
                <h3><?php echo $wdata['rate']; ?> €/h</h3>
            </div>
        </div>

        <div id="customerInfo">
            <p id="cName">Hiring for: </p>
            <h2><?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name'] ?></h2>
        </div>

        <div id="headingFor">
            <div id="hiringContent">
                <h2>Heading to: </h2>
                <p><?php echo $_SESSION['city'] ?></p>
                <p><?php echo $_SESSION['strt_ad'] ?></p>
                <p><?php echo $_SESSION['postcode'] ?></p>
            </div>
        </div>

        <div id="hiringInfo">
            <input type="date" name="date">
            <input id="hours" type="number" min="1" max="24" name="hours" placeholder="Hours" onchange="priceCalc()" onkeyup="priceCalc()">
            <p>Total Price: </p>
            <span id="fullPrice"></span>
            <button onclick="finalPrice()">Input</button>
            <input class="fullPrice" type="text" readonly name="full_price">
        </div>
    </div>

    <?php 
        if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
            echo '<div id="hire">';
            echo "<h1><button type=\"submit\" style=\"background:none; border:none; text-decoration:none; color:black;\">Finalize</button></h1>";
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

    <div>

    </div>
</div>

</body>

<script>

    function priceCalc() {
        //Getting worker rate data
        var rate = "<?php echo $rateO; ?>";
        var hours = document.getElementById("hours").value;
        //calculate = worker rate * inputted hours
        var calculate = rate * hours;
        //Rounding the result
        var calc = Math.round(calculate);

        //Placing calc into fullPrice id and class
        document.getElementById("fullPrice").innerHTML = calc;
        document.getElementsByClassName("fullPrice").value = calc;

    }

    function finalPrice() {
        document.getElementsByClassName("fullPrice").value = document.getElementById("fullPrice").innerHTML;
    }

</script>
</html>