<?php

    require 'C:xampp/htdocs/abyssness/website/inc/database.php';
    $workerID = null;

    if (!empty($_GET['workerID'])) {
        $workerID = $_REQUEST['workerID'];
    }

    if (null==$workerID) {
        header("Location: worker.php");
    }

    if ( !empty($_POST)) {

        $pfpError = null;

        $pfp = $_POST['pfp'];
        $imgfile = $_FILES["pfp"];

        $valid = true;
        if (empty($pfp)) {
            $pfpError = 'Insert pfp';
            $valid = false;
        }

        if ($valid) {


            if (filesize($imgfile["tmp_name"]) <= 0) {
                die('Uploaded file has no contents');
            }

            $imgtype = exif_imagetype($imgfile["tmp_name"]);
            if ($imgtype) {
                die('Uploaded file is not an image');
            }

            move_uploaded_file($imgfile["temp_name"], __DIR__ . "C:\xampp\htdocs\abyssness\website\img\worker_pfp" . $imgfile["name"]);

            $db = new Database();
            $pdo = $db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $sql = "UPDATE worker SET pfp = ? WHERE workerID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($pfp, $workerID));

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

        Database::disconnect();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Profile Picture</title>
</head>
<body>

<div class="container">
    <div class="row">
        <h3>Add Profile Picture</h3>
    </div>

    <form action="add_pfp.php?workerID=<?php echo $workerID?>" method="post" enctype="multipart/form-data">

        <div class="form-group row <?php echo !empty($pfpError)?'':'';?>">
            <label>Profile Picture</label>
            <div>
                <input name="pfp" type="file" placeholder="Pfp">
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="worker.php">Return</a>
        </div>

    </form>

</div>
    
</body>
</html>