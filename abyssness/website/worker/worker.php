<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Workers</title>
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
    
</style>

<body>
    <div class="container">

    <div id="subIntro">
        <h1>CURRENT WORKERS</h1>
    </div>

        <div>
            <p>
                <a href="add_worker.php" id="return" style="font-size:20px;">ADD</a>
            </p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Rate</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                        //Connect to database and display every row

                        include 'C:xampp/htdocs/abyssness/website/inc/database.php';
                        $db = new Database();
                        $pdo = $db->connect();
                        $sql = 'SELECT * FROM worker ORDER BY name, job DESC';
                        $pdo->exec("set names utf8");
                        foreach ($pdo->query($sql) as $row) {

                            echo '<tr>';
                            echo '<td><p>'. $row['name']. '</p></td>';
                            echo '<td><p>'. $row['job']. '</p></td>';
                            echo '<td><p>'. $row['rate'].'$/h</p></td>';
                            echo '<td><a href="inspect_worker.php?workerID='.$row['workerID'].'">Check</a> ';
                            echo ' ';
                            echo '<td><a href="update_worker.php?workerID='.$row['workerID'].'">Update</a> ';
                            echo ' ';
                            echo '<td><a href="remove_worker.php?workerID='.$row['workerID'].'">Remove</a> ';
                            echo '</td>';
                            echo '</tr>';
                        }

                        Database::disconnect();


                    ?>

                </tbody>

            </table>

        </div>

        <a href="../aprofile.php" id="return">Return</a>

    </div>

</body>

</html>