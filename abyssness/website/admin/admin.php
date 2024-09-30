<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Admin</title>
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
        margin-left: 640px;
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
            <h1>CURRENT ADMINS</h1>
        </div>

        <div class="row">
            <p>
                <a href="add_admin.php" id="return" style="font-size:20px;">ADD</a>
            </p>


            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                        //Connect to database and display every row

                        include 'C:xampp/htdocs/abyssness/website/inc/database.php';
                        $db = new Database();
                        $pdo = $db->connect();
                        $sql = 'SELECT * FROM admin ORDER BY user, email DESC';
                        $pdo->exec("set names utf8");
                        foreach ($pdo->query($sql) as $row) {

                            echo '<tr>';
                            echo '<td><p>'. $row['user']. '</p></td>';
                            echo '<td><p>'. $row['email']. '</p></td>';
                            echo '<td><p>'. $row['phone']. '</p></td>';
                            echo '<td><a class="btn" href="observe_admin.php?adminID='.$row['adminID'].'">Check</a> ';
                            echo ' ';
                            echo '<td><a class="btn" href="update_admin.php?adminID='.$row['adminID'].'">Update</a> ';
                            echo ' ';
                            echo '<td><a class="btn" href="remove_admin.php?adminID='.$row['adminID'].'">Remove</a> ';
                            echo '</td>';
                            echo '</tr>';
                        }

                        Database::disconnect();


                    ?>

                </tbody>

            </table>

        </div>

        <a id="return" href="../aprofile.php">Return</a>

    </div>

</body>

</html>