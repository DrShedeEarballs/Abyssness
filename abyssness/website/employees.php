<?php
 include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<style>

    h1 {
        font-size: 30px;
    }

    .filters {
        z-index: 2;
        position: sticky;
        top: 0;
        text-align: center;
        box-shadow: inset 5px 5px 20px 5px;
        background-image: url(css/cssimg/wrinky_paper.jpg);
        background-position: fill;
    }

    .btn {
        font-family: scpTypeWriter1;
        padding-top: 5px;
        font-size: 25px;
        border: 4px;
        border-style: double;
        cursor: pointer;
        background: rgb(500, 500, 500, 0.2);
        box-shadow: 1px 1px 0px 0px;
    }

    .btn.active {
        box-shadow: inset 1px 2px 5px 2px;
    }

    .searchbar {
        float: right;
    }

    #pfp {
        margin: 25px;
        border-radius: 50%;
        border: 3px;
        border-style: solid;
        border-color: black;
        box-shadow: none;
        box-shadow: 1px 0px 10px 2px black;

        transition: transform .1s;
    }

    #pfp:hover {
        transform: scale(0.9);
        box-shadow: none;
    }

    .container {
        margin: 15px;
        display: inline-block;
        border: 5px;
        border-style: dashed;
        text-align: center;
        box-shadow: inset 1px 0px 15px 5px;
        background-color: rgb(10, 10, 10, 0.2);
        display: none;
    }

    .show {
        display: inline-block;
    }

    .container h3 {
        font-family: subArticle;
        text-decoration: underline;
        font-variant: small-caps;
    }

    .container_inside {
        border: 2px;
        border-style: solid;
    }

    #filters {
        text-align: center;
        position: sticky;
        top: 0;
        overflow: hidden;
    }

    #searchbar {
        float: right;
        position: sticky;
        top: 0;
    }

</style>

<head>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abyssness</title>

</head>
<body>
    <link rel="stylesheet" href="css/main.css">

    <div id="gallery">
        <div id="subIntro">
            <h1>OUR LOVELY EMPLOYEE SELECTION</h1>
        </div>

        <div id="introDesc">
            <p>Look at how many little fellas there are! And all of them are fight ready to take on whatever monstrous challenge you may propose for them. Whether you need some cleaning, cooking or yardwork to be done, we've got a guy for you. We also have workers for even the most exotic of scenarios, like our lovely Miguel who insisted to get hired as a leftover beers enjoyer only to realize literally no one would ever hire him to do that so now hes forced to pick up dish washing too, what a dumb guy. If you need help in any bigger projects like renovations or rocket science, we got you covered on those too, of course!</p>
        </div>

<!-- Worker filter section -->
        
        <div class="filters" id="btnCont" style="padding-top:25px; padding-bottom:25px; border-top:5px solid; border-bottom:5px solid;">
            <button class="btn active" onclick="filterSearch('all')">All</button>
            <button class="btn" onclick="filterSearch('Housekeeping')">Housekeeping</button>
            <button class="btn" onclick="filterSearch('Yardwork')">Yardwork</button>
            <button class="btn" onclick="filterSearch('QoL Assistant')">Assistant</button>
            <button class="btn" onclick="filterSearch('Childcare')">Childcare</button>
            <button class="btn" onclick="filterSearch('Construction')">Construction</button>
            <button class="btn" onclick="filterSearch('Misc')">Miscellanious</button>
        </div>

        <div class="employee_table">
            <table>
                <?php

                    include 'C:xampp/htdocs/abyssness/website/inc/database.php';
                    $db = new Database();
                    $pdo = $db->connect();
                    $sql = 'SELECT * FROM worker ORDER BY workerID DESC';
                    $pdo->exec("set names utf8");
                    $q = $pdo->prepare($sql);

                    $maxCol = 4;
                    $col = 1;

                    foreach ($pdo->query($sql) as $row) {
                        echo "<div class=\"container " . $row['genre'] . "\">";
                            echo '<div class="container_inside">';
                                //Display profile picture that sends you to view said workers information
                                echo "<a href=\"employee_info.php?workerID=". $row['workerID']. "\"><img src=\"worker/pfp/" . $row['pfp'] . "\" width=\"260px\" height=\"260px\" id=\"pfp\"></a>";
                            echo '</div>';
                            echo '<h3>'. $row['name'] .'</h3>';
                            echo '<h4>'. $row['job'] .'</h4>';
                        echo '</div>';
                    }

                    Database::disconnect();
                ?>
            </table>
        </div>
    </div>

</body>

<script>

//Script for filters

    filterSearch("all")
    function filterSearch(c) {
        var x, i;
        x = document.getElementsByClassName("container");
        if (c == "all") c = "";

        for (i = 0; i < x.length; i++) {
            removeClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) addClass(x[i], "show");
        }
    }

    function addClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");

        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " +arr2[i];
            }
        }
    }

    function removeClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");

        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }

        element.className =arr1.join(" ");
    }

    var btnCont = document.getElementById("btnCont");
    var btns = btnCont.getElementsByClassName("btn");

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>

<footer>

</footer>
</html>