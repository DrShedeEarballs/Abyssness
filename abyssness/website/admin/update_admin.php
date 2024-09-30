<?php

    //Include and connect to database and update information if it does not match the original information of a section

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $adminID = null;

    if (!empty($_GET['adminID'])) {
        $adminID = $_REQUEST['adminID'];
    }

    if (null==$adminID) {
        header("Location: admin.php");
    }

    if ( !empty($_POST)) {

        $userError = null;
        $pswrdError = null;
        $emailError = null;
        $phoneError = null;

        $user = $_POST['user'];
        $pswrd = $_POST['pswrd'];
        $email = $_POST['phone'];
        $phone = $_POST['email'];

        $valid = true;
        if (empty($user)) {
            $userError = 'Insert Username';
            $valid = false;
        }

        if (empty($pswrd)) {
            $pswrdError = 'Insert Last Name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Insert email Number';
            $valid = false;
        }

        if (empty($phone)) {
            $phoneError = 'Insert phone';
            $valid = false;
        }

        if ($valid) {
            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "UPDATE admin SET user = ?, pswrd = ?, email = ?, phone = ? WHERE adminID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($user, $pswrd, $email, $phone, $adminID));

            Database::disconnect();
            header("Location: admin.php");
        }
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM admin WHERE adminID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($adminID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user = $data['user'];
        $pswrd = $data['pswrd'];
        $email = $data['email'];
        $phone = $data['phone'];

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
    <title>Update Admin</title>
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

<body>

<div class="container">
    <div id="subIntro">
        <h1>UPDATE ADMIN INFORMATION</h1>
    </div>

    <form action="update_admin.php?adminID=<?php echo $adminID?>" method="post">

        <div id="info" <?php echo !empty($userError)?'':'';?>">
            <label>Username</label>
            <div>
                <input name="user" type="text" placeholder="Username" value="<?php echo !empty($user)?$user:'';?>">
                <?php if (!empty($userError)): ?>
                    <small>
                        <?php echo $userError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($pswrdError)?'':'';?>">
            <label>Password</label>
            <div>
                <input id="pswrdReveal" name="pswrd" type="password" placeholder="Password" value="<?php echo !empty($pswrd)?$pswrd:'';?>"><br>
                <input type="checkbox" onclick="revealPswrd()">Reveal Password
                <?php if (!empty($pswrdError)): ?>
                    <small>
                        <?php echo $pswrdError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($emailError)?'':'';?>">
            <label>Email</label>
            <div>
                <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                <?php if (!empty($emailError)): ?>
                    <small>
                        <?php echo $emailError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($phoneError)?'':'';?>">
            <label>Phone Number</label>
            <div>
                <input name="phone" type="text" placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                <?php if (!empty($phoneError)): ?>
                    <small>
                        <?php echo $phoneError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info">
            <button type="submit">Update</button>
            <a id="return" href="admin.php">Return</a>
        </div>

    </form>

</div>
    
</body>
</html>