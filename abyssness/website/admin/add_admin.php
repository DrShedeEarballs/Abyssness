<?php

    //Include then connect to database and post information from input fields of the same name

    include 'C:xampp/htdocs/abyssness/website/inc/database.php';

    $userError = null;
    $pswrdError = null;
    $emailError = null;
    $phoneError = null;

    if ( !empty($_POST)) {

        $user = $_POST['user'];
        $pswrd = $_POST['pswrd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $valid = true;
        if (empty($user)) {
            $userError = 'Insert Username';
            $valid = false;
        }

        if (empty($pswrd)) {
            $pswrdError = 'Insert Password';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Insert Email';
            $valid = false;
        }

        if (empty($phone)) {
            $phoneError = 'Insert Phone Number';
            $valid = false;
        }

        if ($valid) {
            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "INSERT INTO admin (user, pswrd, email, phone) values(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user, $pswrd, $email, $phone));
            
            Database::disconnect();
            header("Location: admin.php");
        }

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
    <title>Add Admin</title>
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
            <h1>ADD ADMIN</h1>
        </div>

        <form action="add_admin.php" method="post">

            <div id="info" <?php echo !empty($userError)?'alert alert-info':'';?>">
                <label>Username</label>
                <div>
                    <input name="user" type="text" placeholder="Username" value="<?php echo !empty($user)?$user:'';?>">
                    <?php if (!empty($userError));?>
                        <small class="text-muted">
                            <?php echo $userError;?>
                        </small>
                </div>
            </div>

            <div id="info" <?php echo !empty($pswrdError)?'alert alert-info':'';?>">
                <label>Password</label>
                <div>
                    <input id="pswrdReveal" name="pswrd" type="password" placeholder="Password" value="<?php echo !empty($pswrd)?$pswrd:'';?>"><br>
                    <input type="checkbox" onclick="revealPswrd()">Reveal Password
                    <?php if (!empty($pswrdError));?>
                        <small class="text-muted">
                            <?php echo $pswrdError;?>
                        </small>
                </div>
            </div>

            <div id="info" <?php echo !empty($emailError)?'alert alert-info':'';?>">
                <label>Email</label>
                <div>
                    <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError));?>
                        <small class="text-muted">
                            <?php echo $emailError;?>
                        </small>
                </div>
            </div>

            <div id="info" <?php echo !empty($phoneError)?'alert alert-info':'';?>">
                <label>Phone Number</label>
                <div>
                    <input name="phone" type="text" placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                    <?php if (!empty($phoneError));?>
                        <small class="text-muted">
                            <?php echo $phoneError;?>
                        </small>
                </div>
            </div>

            <div>
                <button type="submit" id="info">Add</button>
                <a id="return" href="admin.php">Return</a>
            </div>
        </form>

    </div>
</body>

</html>