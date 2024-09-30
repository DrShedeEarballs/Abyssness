<?php
    include 'header.php';

    //Redirect script
    function redirect() {
        header('Location: customer_hires.php');
     }
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

<style>



</style>

<body>
    <link rel="stylesheet" href="css/main.css">

    <div id="subIntro">
        <?php 
            //If a customer is logged in they get directed to their hires

            if(isset($_SESSION['signedin']) && $_SESSION["signedin"] === true) {
                redirect();
            }

            elseif (isset($_SESSION['asignedin']) && $_SESSION["asignedin"] === true) {
                echo '<h1>ALRIGHT BIG GUY, LOG IN WITH A NORMAL ACCOUNT LIKE EVERYONE ELSE</h1>';
            }

            else {
                echo '<h1>PLEASE LOG IN TO VIEW UPCOMING HIRES</h1>';
            }
        ?>
    </div>

    <div id="introDesc">
        <p>Here you can view all kinds of information about upcoming and previous hirings you've done with our incredible cast! You are also eligible to like (and dislike) creatures who's service you exceptionally liked (or didn't like) so that we know who to praise! (or fire)</p>
    </div>
</body>
<footer>

</footer>
</html>