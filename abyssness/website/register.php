<?php

    include 'inc/database.php';
    include 'header.php';

    $usernameError = null;
    $passwordError = null;
    $fnameError = null;
    $lnameError = null;
    $phoneError = null;
    $emailError = null;
    $strt_adError = null;
    $postcodeError = null;
    $cityError = null;

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
            $passwordError = 'Insert Password';
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
            $strt_adError = 'Insert Street Adress';
            $valid = false;
        }

        if (empty($postcode)) {
            $postcodeError = 'Insert Postcode';
            $valid = false;
        }

        if (empty($city)) {
            $cityError = 'Insert City of Residence';
            $valid = false;
        }

        if ($valid) {
            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "INSERT INTO customer (username, pword, first_name, last_name, phone, email, strt_ad, postcode, city) values(?,?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($username, $password, $fname, $lname, $phone, $email, $strt_ad, $postcode, $city));
            
            Database::disconnect();
            header("Location: sign.php");
        }

    }

?>

<script>

    //Script to hide and reveal password

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
    <title>Registeration</title>
</head>

<style>

    .container {
        text-align: center;
    }

    label {
        margin: 20px;
        font-family: scpTypeWriter1;
    }

    #info {
        margin: 10px;
    }

</style>

<body>
    <div class="container">
        <div id="subIntro">
            <h1>REGISTER</h1>
        </div>

        <form action="register.php" method="post">

            <div class="row <?php echo !empty($usernameError)?'alert alert-info':'';?>">
                <label>Username</label>
                <div id="info">
                    <input name="username" type="text" placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
                    <?php if (!empty($usernameError));?>
                        <small class="text-muted">
                            <?php echo $usernameError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($passwordError)?'alert alert-info':'';?>">
                <label>Password</label>
                <div id="info">
                    <input name="password" id="pswrdReveal" type="password" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>"><br>
                    <input type="checkbox" onclick="revealPswrd()">Reveal Password
                    <?php if (!empty($passwordError));?>
                        <small class="text-muted">
                            <?php echo $passwordError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($fnameError)?'alert alert-info':'';?>">
                <label>First Name</label>
                <div id="info">
                    <input name="fname" type="text" placeholder="First name" value="<?php echo !empty($fname)?$fname:'';?>">
                    <?php if (!empty($fnameError));?>
                        <small class="text-muted">
                            <?php echo $fnameError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($lnameError)?'alert alert-info':'';?>">
                <label>Last Name</label>
                <div id="info">
                    <input name="lname" type="text" placeholder="Last name" value="<?php echo !empty($lname)?$lname:'';?>">
                    <?php if (!empty($lnameError));?>
                        <small class="text-muted">
                            <?php echo $lnameError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($phoneError)?'alert alert-info':'';?>">
                <label>Phone Number</label>
                <div id="info">
                    <input name="phone" type="text" placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                    <?php if (!empty($phoneError));?>
                        <small class="text-muted">
                            <?php echo $phoneError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($emailError)?'alert alert-info':'';?>">
                <label>Email</label>
                <div id="info">
                    <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError));?>
                        <small class="text-muted">
                            <?php echo $emailError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($emailError)?'alert alert-info':'';?>">
                <label>Street Adress</label>
                <div id="info">
                    <input name="strt_ad" type="text" placeholder="Street Adress" value="<?php echo !empty($strt_ad)?$strt_ad:'';?>">
                    <?php if (!empty($strt_adError));?>
                        <small class="text-muted">
                            <?php echo $strt_adError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($emailError)?'alert alert-info':'';?>">
                <label>Postal Code</label>
                <div id="info">
                    <input name="postcode" type="text" placeholder="Postcode" value="<?php echo !empty($postcode)?$postcode:'';?>">
                    <?php if (!empty($postcodeError));?>
                        <small class="text-muted">
                            <?php echo $postcodeError;?>
                        </small>
                </div>
            </div>

            <div class="row <?php echo !empty($emailError)?'alert alert-info':'';?>">
                <label>City of Residence</label>
                <div id="info">
                    <input name="city" type="text" placeholder="City" value="<?php echo !empty($city)?$city:'';?>">
                    <?php if (!empty($cityError));?>
                        <small class="text-muted">
                            <?php echo $cityError;?>
                        </small>
                </div>
            </div>

            <div>
                <button type="submit" style="margin:10px;">Register</button> <br>
                <a href="sign.php" style="font-family:scpTypeWriter2; color:black;">Return</a>
            </div>
        </form>

    </div>
</body>

</html>