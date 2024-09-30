<?php

//Include and connect to database to be able to start a session "asignedin" with the admin table information

require_once 'inc/database.php';
include 'header.php';

$user_err = '';
$password_err = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $valid = true;

    if (empty($user)) {
        $valid = false;
        $user_err = "Insert Username";
    }

    if (empty($password)) {
        $valid = false;
        $password_err = "Insert Password";
    }

    if ($valid) {
        $db = new Database();
        $conn = $db->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql = "SELECT adminID, pswrd FROM admin WHERE user = :user";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_OBJ);

        if ($password == $admin->pswrd) {
            $_SESSION['asignedin'] = true;
            $_SESSION['adminID'] = $admin->adminID;
            $_SESSION['user'] = $user;

            header("location: aprofile.php");

            exit;
        }

        else {
            $user_err = "Invalid Username";
            $password_err = "Invalid Password";

            echo "failure";
        }
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

<div class="container">
    <div id="subIntro">
        <h1>SIGN IN AS ADMIN</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div id="info">
            <label>Username</label> <br>
            <input type="text" name="username" value="<?php echo (!empty($user)) ? $user: ''; ?>" class="<?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?>">
            <span><?php echo $user_err; ?></span>
        </div>

        <div id="info">
            <label>Password</label> <br>
            <input type="password" id="pswrdReveal" name="password" value="<?php echo (!empty($password)) ? $password: ''; ?>" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><br>
            <input type="checkbox" onclick="revealPswrd()">Reveal Password
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Sign In" style="margin:10px;">
        </div>
        <div>
            <a href="sign.php" style="font-family:scpTypeWriter2; color:black;">Sign in normally</a>
        </div>
    </form>
</div>
