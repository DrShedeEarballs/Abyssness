<!DOCTYPE html>
<html lang="en">

<style>
    #navstuff {
        padding-bottom: 10px;
    }
    #img {
        width: 50px;
        left: calc((100% - 40px) / 2);
        top: 5px;
    }
    #navstuff:hover {
        text-decoration: underline;
    }
</style>

<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abyssness</title>

    <header>
        <?php session_start(); ?>
        <div id="header2">
            <div id="intro">
                <h1>Welcome To The Abyss</h1>
                <h3>Where your abyss is our business :D</h3>
            </div>
        </div>
        <div id="nav" style="position:sticky; top:0;">
            <ul>
                <li><a href="index.php" id="navstuff">Home</a></li>
                <li><a href="employees.php" id="navstuff" style="margin-right:80px; border-right:20px;">Employees</a></li>
                <li><a href="scp.php"><img src="img/scp.png" id="img" style="position:absolute;"></a></li>
                <li><a href="hires.php" id="navstuff">Hire</a></li>

                <?php

                    //If a customer is logged in the Sign In will turn into Profile and if an admin is signed in it will turn into Admin

                    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
                        echo '<li><a href="profile.php" id="navstuff">Profile</a></li>';
                    }

                    elseif (isset($_SESSION["asignedin"]) && $_SESSION["asignedin"] === true) {
                        echo '<li><a href="aprofile.php" id="navstuff">Admin</a></li>';
                    }

                    else {
                        echo '<li><a href="sign.php" id="navstuff">Sign In</a></li>';
                    }

                ?>

            </ul>
        </div>
    </header>

</head>
</html>