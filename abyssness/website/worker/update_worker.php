<?php

    //Include and connect to database and update information if it does not match the original information of a section

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $workerID = null;

    $pfpError = null;
    $nameError = null;
    $genreError = null;
    $jobError = null;
    $aboutError = null;
    $rateError = null;

    if (!empty($_GET['workerID'])) {
        $workerID = $_REQUEST['workerID'];
    }

    if (null==$workerID) {
        header("Location: worker.php");
    }

    if ( !empty($_POST)) {

        $pfp = $_POST['pfp'];
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $job = $_POST['job'];
        $about = $_POST['about'];
        $rate = $_POST['rate'];

        $valid = true;

        if (empty($pfp)) {
            $pfpError = 'Give a filename';
            $valid = false;
        }

        if (empty($name)) {
            $nameError = 'Insert Name';
            $valid = false;
        }

        if (empty($genre)) {
            $genreError = 'Insert Genre';
            $valid = false;
        }

        if (empty($job)) {
            $jobError = 'Insert Occupation';
            $valid = false;
        }

        if (empty($about)) {
            $aboutError = 'Describe worker';
            $valid = false;
        }

        if (empty($rate)) {
            $rateError = 'Give Hourly Rate';
            $valid = false;
        }

        if ($valid) {
            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "UPDATE worker SET pfp = ?, name = ?, genre = ?, job = ?, about = ?, rate = ? WHERE workerID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($pfp, $name, $genre, $job, $about, $rate, $workerID));

            Database::disconnect();
            header("Location: worker.php");
        }
    }

    else {
        $db = new Database();
        $pdo = $db->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM worker WHERE workerID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($workerID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $pfp = $data['pfp'];
        $name = $data['name'];
        $genre = $data['genre'];
        $job = $data['job'];
        $about = $data['about'];
        $rate = $data['rate'];

        Database::disconnect();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Update Worker</title>
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
        <h1>UPDATE WORKER INFORMATION</h1>
    </div>

    <form action="update_worker.php?workerID=<?php echo $workerID?>" method="post">

        <div id="info" <?php echo !empty($pfpError)?'':'';?>">
            <label>Profile Picture</label>
            <div>
                <input name="pfp" type="file" placeholder="Profile Picture" value="<?php echo !empty($pfp)?$pfp:'';?>">
                <?php if (!empty($pfpError)): ?>
                    <small>
                        <?php echo $pfpError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($nameError)?'':'';?>">
            <label>Name</label>
            <div>
                <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                <?php if (!empty($nameError)): ?>
                    <small>
                        <?php echo $nameError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($genreError)?'alert alert-info':'';?>">
            <label>Work Genre</label>
            <div>
                <select name="genre">
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Yardwork">Yardwork</option>
                    <option value="QoL Assistant">QoL Assistant</option>
                    <option value="Childcare">Childcare</option>
                    <option value="Construction">Construction</option>
                    <option value="Misc">Miscellaneous</option>
                </select>
                <?php if (!empty($genreError));?>
                    <small>
                        <?php echo $genreError;?>
                    </small>
            </div>
        </div>

        <div id="info" <?php echo !empty($jobError)?'':'';?>">
            <label>Job Description</label>
            <div>
                <input name="job" type="text" placeholder="Job Description" value="<?php echo !empty($job)?$job:'';?>">
                <?php if (!empty($jobError)): ?>
                    <small>
                        <?php echo $jobError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($aboutError)?'':'';?>">
            <label>About Worker</label>
            <div>
                <input name="about" type="text" placeholder="About Worker" value="<?php echo !empty($about)?$about:'';?>">
                <?php if (!empty($aboutError)): ?>
                    <small>
                        <?php echo $aboutError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info" <?php echo !empty($rateError)?'':'';?>">
            <label>Hourly Rate</label>
            <div>
                <input name="rate" type="text" placeholder="Hourly Rate" value="<?php echo !empty($rate)?$rate:'';?>">
                <?php if (!empty($rateError)): ?>
                    <small>
                        <?php echo $rateError;?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div id="info">
            <button type="submit">Update</button>
            <a id="return" href="worker.php">Return</a>
        </div>

    </form>

</div>
    
</body>
</html>