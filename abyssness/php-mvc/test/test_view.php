<?php

    require 'uhh.php';

    $workerID = $_GET['workerID'];

    $sql = "SELECT * FROM worker WHERE workerID = :workerID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':workerID', $workerID, PDO::PARAM_INT);
    $stmt->execute();

    $worker = $stmt->fetch(PDO::FETCH_OBJ);

    $pfp = $worker->pfp;
    $name = $worker->name;
    $job = $worker->job;
    $about = $worker->about;
    $rate = $worker->rate;
    $likes = $worker->likes;
    $dislikes = $worker->dislikes;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Inspection</title>
</head>
<body>

<div class="container">
    <div class="row">
        <h3>Inspect Worker Information</h3>
    </div>

    <div class="gallery">
        <label>Profile Image</label>
        <div>
        <img src="C:\xampp\htdocs\abyssness\website\worker_pfp<?php echo $pfp;?>">
        </div>
    </div>

    <div class="form-group row">
        <label>Name</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $name;?>" >
        </div>
    </div>

    <div class="form-group row">
        <label>Job</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $job;?>" >
        </div>
    </div>

    <div class="form-group row">
        <label>About</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $about;?>" >
        </div>
    </div>

    <div class="form-group row">
        <label>Hourly Rate</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $rate;?>" >$/h
        </div>
    </div>

    <div class="form-group row">
        <label>Likes</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $likes;?>" >
        </div>
    </div>

    <div class="form-group row">
        <label>Dislikes</label>
        <div>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $dislikes;?>" >
        </div>
    </div>

    <div>
        <a class="btn" href="worker.php">Return</a>
    </div>

</div>
    
</body>
</html>