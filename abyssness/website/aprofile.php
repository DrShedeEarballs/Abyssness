<?php

include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>

<style>
    .container {
        text-align: center;
    }

    #forms {
        font-family: scpTypeWriter2;
        font-size: 20px;
        color: black;
    }

    #formCont {
        margin: 15px;
    }

</style>

<body>

    <div id="subIntro">
        <h1>THEIR INFORMATION IS SAFE WITH YOU</h1>
    </div>

    <div id="introDesc">
        <p>You promise to keep their information safe and very close to your hearts and make sure to give it to Mark Zuckerberg at the best rate possible. If you wish to delete any account or change a password and such, please do it from your forms, thank you!</p>
    </div>

<!-- Giving the logged in admin access to customer, worker and admin forms -->

    <div class="container">
        <div id="formCont">
            <a id="forms" href="worker/worker.php">Inspect Employees</a> <br>
        </div>
        <div id="formCont">
            <a id="forms" href="customer/customer.php">Inspect Customers</a> <br>
        </div>
        <div id="formCont">
            <a id="forms" href="admin/admin.php">Inspect Admins</a> <br>
        </div>
        <div id="formCont" style="margin:50px;">
            <a id="forms" style="font-family:scpTypeWriter1;" href="signout.php">Sign Out</a>
        </div>
    </div>

</body>
</html>