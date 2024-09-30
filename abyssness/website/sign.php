<?php

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

        $sql = "SELECT CustomerID, pword, username, first_name, last_name, phone, email, strt_ad, postcode, city FROM customer WHERE username = :user";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $customer = $stmt->fetch(PDO::FETCH_OBJ);

        if ($password == $customer->pword) {
            $_SESSION['signedin'] = true;
            $_SESSION['CustomerID'] = $customer->CustomerID;
            $_SESSION['username'] = $customer->username;
            $_SESSION['first_name'] = $customer->first_name;
            $_SESSION['last_name'] = $customer->last_name;
            $_SESSION['phone'] = $customer->phone;
            $_SESSION['email'] = $customer->email;
            $_SESSION['strt_ad'] = $customer->strt_ad;
            $_SESSION['postcode'] = $customer->postcode;
            $_SESSION['city'] = $customer->city;
            $_SESSION['user'] = $user;

            header("location: profile.php");

            exit;
        }

        else {
            $user_err = "<br>Invalid Username";
            $password_err = "<br>Invalid Password";

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

    #container {
        text-align: center;
    }

    #register {
        margin: 5px;
    }

    h2 {
        font-family: subArticle;
    }

    .username {
        margin: 20px;
        font-family: scpTypeWriter1;
    }

    .password {
        margin: 20px;
        font-family: scpTypeWriter1;
    }

</style>

<div id="container">
    <div id="subIntro">
        <h1>SIGN IN</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="username">
            <label>Username</label> <br>
            <input type="text" name="username" value="<?php echo (!empty($user)) ? $user: ''; ?>" class="<?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?>">
            <span><?php echo $user_err; ?></span>
        </div>

        <div class="password">
            <label>Password</label> <br>
            <input type="password" id="pswrdReveal" name="password" value="<?php echo (!empty($password)) ? $password: ''; ?>" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><br>
            <input type="checkbox" onclick="revealPswrd()">Reveal Password
            <span><?php echo $password_err; ?></span>
        </div>
        <div id="btn">
            <input type="submit" value="Sign In" style="margin:10px;">
        </div>
        <div id="register">
            <a href="register.php" style="font-family:scpTypeWriter2; color:black;">Register an account</a>
        </div>
        <div id="asign">
            <a href="asign.php" style="font-family:scpTypeWriter2; color:black;">Sign in as admin</a>
        </div>
    </form>
</div>
