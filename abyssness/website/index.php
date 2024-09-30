<?php

require 'C:xampp/htdocs/abyssness/website/inc/database.php';

//Include and connect database to get worker information

$db = new Database();
$pdo = $db->connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("set names utf8");
$sql = "SELECT * FROM worker ORDER BY likes DESC limit 1";
$q = $pdo->prepare($sql);

Database::disconnect();

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abyssness</title>

</head>
<body style="background-size:contain cover;">
    <div id="subIntro">
        <h1>WELCOME TO ABYSSNESS!</h1>
    </div>

    <div id="introDesc">
        <p>Welcome to employee heaven! We've worked incredibly hard for the past few months in trying to reach the other side of existance to access the most willing of characters to help you, that's right, you! In whatever you need during your everyday life! Wether you need housework, groceries picked up or help in anything you can think of, we've got a guy for you!</p>
    </div>

    <div id="desc">

        <div id="mainDesc">
            <h3>Joining in on the celebration of our new fantastical website is none other than the SCP Foundation!</h3>
            <p>You heard that right, joining in with our celebration we have the SCP foundation who has promised to co-host this business plan and fuel your abysmal work requests with their quirkiest and spookiest guys. You just give us a number and we'll get started on sending your requested worker to your home adress right this instant! You can either request whoever you may want or you can simply try your luck with our incredibly sophisitcated random nunmber generator and get your money back guarranteed if whoever shows up at your doorstep doesn't fulfill your needs!</p>
        </div>

        <div id="functDesc">
            <h3 style="padding-top:15px; padding-bottom: 37px; font-size:40px;">But who are we really?</h3>
            <p>We are, of course, a private made business that specializes in bringing the extraordinary straight to your doorstep! Because what is more like being human than enslaving the unknown to do our bidding against their will? No worries though, for we have excellent training for our working candidates so there is an almost zero percent chance that theyre malevolent and/or want to posess you and take over your family lineage! Our wonderous workers will make sure to do their job effortlessly and with a good price to boot. If you or a loved one is struggling with the occult, please give us a call! We'd always love to have more workers join our loving family!</p>
        </div>

<!-- Displaying the highest rated workers information and profile picture -->
        <div id="workiestFella">
            <?php
                foreach ($pdo->query($sql) as $row) {
                    echo "<img src=\"worker/pfp/" . $row['pfp'] . "\"id=\"wlf\" class=\"wlf\" style=\"margin-right:10px; margin-top:200px; width:50%; box-shadow:5px 5px 15px 5px;\">";
                }
            ?>
            <div>
                <h3 style="margin:15px; padding-left:15px; padding-bottom:25px; padding-top:10px; border-bottom:2px; border-bottom-style:solid;">Our current workiest little fella!</h3>
            </div>
            <div style="padding-left:20px;">
                <?php
                    foreach ($pdo->query($sql) as $row) {
                        echo "<h4>Name: " . $row['name'] . "</h4>";
                        echo "<h4>Occupation: ". $row['job'] . "</h4>";
                        echo "<h4>Likes: ". $row['likes'] . "</h4>";
                    }
                ?>
            </div>
        </div>
    </div>

</body>
<footer>

</footer>
</html>
