<?php

include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<style>
    #container {
        text-align: center;
    }

    #info h2 {
        text-decoration: underline;
        font-family: scpTypeWriter2;
    }

    a {
        font-family: scpTypeWriter1;
        color: black;
    }
</style>

<body>
    <div id="container">
        <div id="subIntro">
            <h1>YOUR INFORMATION IS SAFE WITH US</h1>
        </div>

        <div id="introDesc">
            <p>We promise to keep your information safe and very close to our hearts and make sure nothing bad could ever happen with it. If you wish to delete your account or change a password and such, please contact our wonderful customer support, thank you!</p>
        </div>

        <div id="info">
            <h2>Name: <?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></h2>
            <h2>Username: <?php echo $_SESSION['username']; ?></h2>
            <h2>Email: <?php echo $_SESSION['email']; ?></h2>
            <h2>Phone Number: <?php echo $_SESSION['phone']; ?></h2>
        </div>
        <a href="signout.php">Sign Out</a>
    </div>
</body>
</html>