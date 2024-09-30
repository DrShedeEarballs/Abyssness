<?php

    //Include and connect to database and update information if it does not match the original information of a section

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $customerID = null;

    $userError = null;
    $passwordError = null;
    $fnameError = null;
    $lnameError = null;
    $phoneError = null;
    $emailError = null;
    $strt_adError = null;
    $postcodeError = null;
    $cityError = null;

    if (!empty($_GET['CustomerID'])) {
        $customerID = $_REQUEST['CustomerID'];
    }

    if (null==$customerID) {
        header("Location: customer.php");
    }

    if ( !empty($_POST)) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $strt_ad = $_POST['strt_ad'];
        $postcode = $_POST['postcode'];
        $city = $_POST['city'];

        $valid = true;
        if (empty($username)) {
            $usernameError = 'Insert Username';
            $valid = false;
        }

        $valid = true;
        if (empty($password)) {
            $passwordError = 'Insert password';
            $valid = false;
        }

        $valid = true;
        if (empty($fname)) {
            $fnameError = 'Insert First Name';
            $valid = false;
        }

        if (empty($lname)) {
            $lnameError = 'Insert Last Name';
            $valid = false;
        }

        if (empty($phone)) {
            $phoneError = 'Insert Phone Number';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Insert Email';
            $valid = false;
        }

        if (empty($strt_ad)) {
            $strt_adError = 'Insert Street Address';
            $valid = false;
        }

        if (empty($postcode)) {
            $postcodeError = 'Insert Postcode';
            $valid = false;
        }

        if (empty($city)) {
            $cityError = 'Insert City';
            $valid = false;
        }

        if ($valid) {
            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "UPDATE customer SET username = ?, pword = ?, first_name = ?, last_name = ?, phone = ?, email = ?, strt_ad = ?, postcode = ?, city = ? WHERE CustomerID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username, $password, $fname, $lname, $phone, $email, $strt_ad, $postcode, $city, $customerID));

            Database::disconnect();
            header("Location: customer.php");
        }
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM customer WHERE CustomerID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($customerID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $username = $data['username'];
        $password = $data['pword'];
        $fname = $data['first_name'];
        $lname = $data['last_name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $strt_ad = $data['strt_ad'];
        $postcode = $data['postcode'];
        $city = $data['city'];

        Database::disconnect();
    }

?>

<script>
    function revealPswrd() {
        var x = document.getElementById("pswrdReveal");
        if (x.type === "password") {
            x.type = "text";
        }

        else {
            x.type = "password";
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Update Customer</title>
</head>
<body>

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

<div class="container">
    <div id="subIntro">
        <h1>UPDATE CUSTOMER INFORMATION</h1>
    </div>

    <form action="update_customer.php?CustomerID=<?php echo $customerID?>" method="post">

        <div id="info" <?php echo !empty($usernameError)?'':'';?>">
            <label>Username</label>
            <div>
                <input name="username" type="text" placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
                <?php if (!empty($usernameError)): ?>
                    <small class="text-muted">
                        <?php echo $usernameError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($passwordError)?'':'';?>">
            <label>Password</label>
            <div>
                <input id="pswrdReveal" name="password" type="password" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>"><br>
                <input type="checkbox" onclick="revealPswrd()">Reveal Password
                <?php if (!empty($passwordError)): ?>
                    <small class="text-muted">
                        <?php echo $passwordError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($fnameError)?'':'';?>">
            <label>First Name</label>
            <div>
                <input name="fname" type="text" placeholder="First name" value="<?php echo !empty($fname)?$fname:'';?>">
                <?php if (!empty($fnameError)): ?>
                    <small class="text-muted">
                        <?php echo $fnameError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($lnameError)?'':'';?>">
            <label>Last Name</label>
            <div>
                <input name="lname" type="text" placeholder="Last name" value="<?php echo !empty($lname)?$lname:'';?>">
                <?php if (!empty($lnameError)): ?>
                    <small class="text-muted">
                        <?php echo $lnameError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($phoneError)?'':'';?>">
            <label>Phone Number</label>
            <div>
                <input name="phone" type="text" placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                <?php if (!empty($phoneError)): ?>
                    <small class="text-muted">
                        <?php echo $phoneError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($emailError)?'':'';?>">
            <label>Email</label>
            <div>
                <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                <?php if (!empty($emailError)): ?>
                    <small class="text-muted">
                        <?php echo $emailError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($strt_adError)?'':'';?>">
            <label>Street Address</label>
            <div>
                <input name="strt_ad" type="text" placeholder="Street Address" value="<?php echo !empty($strt_ad)?$strt_ad:'';?>">
                <?php if (!empty($strt_adError)): ?>
                    <small class="text-muted">
                        <?php echo $strt_adError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($postcodeError)?'':'';?>">
            <label>Postal Code</label>
            <div>
                <input name="postcode" type="text" placeholder="Postal Code" value="<?php echo !empty($postcode)?$postcode:'';?>">
                <?php if (!empty($postcodeError)): ?>
                    <small class="text-muted">
                        <?php echo $postcodeError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($cityError)?'':'';?>">
            <label>City</label>
            <div>
                <input name="city" type="text" placeholder="City" value="<?php echo !empty($city)?$city:'';?>">
                <?php if (!empty($cityError)): ?>
                    <small class="text-muted">
                        <?php echo $cityError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <button type="submit">Update</button>
            <a id="return" href="customer.php">Return</a>
        </div>

    </form>

</div>
    
</body>
</html>