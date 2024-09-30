<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Customers</title>
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
        margin-left: 600px;
    }

    td {
        border-top: 1px solid;
    }

    td a {
        color: black;
    }

    #return {
        padding-top: 30px;
        text-align: center;
        font-family: scpTypeWriter2;
        color: black;
    }
    
</style>

<body>
    <div class="container">

        <div id="subIntro">
            <h1>CURRENT CUSTOMERS</h1>
        </div>

        <div>
            <p>
                <a href="add_customer.php" id="return" style="font-size:20px;">ADD</a>
            </p>

            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                        //Connect to database and display every row

                        include 'C:xampp/htdocs/abyssness/website/inc/database.php';
                        $db = new Database();
                        $pdo = $db->connect();
                        $sql = 'SELECT * FROM customer ORDER BY first_name, last_name DESC';
                        $pdo->exec("set names utf8");
                        foreach ($pdo->query($sql) as $row) {

                            echo '<tr>';
                            echo '<td><p>'. $row['first_name']. '</p></td>';
                            echo '<td><p>'. $row['last_name']. '</p></td>';
                            echo '<td><p>'. $row['email']. '</p></td>';
                            echo '<td><a href="check_customer.php?CustomerID='.$row['CustomerID'].'">Check</a> ';
                            echo ' ';
                            echo '<td><a href="update_customer.php?CustomerID='.$row['CustomerID'].'">Update</a> ';
                            echo ' ';
                            echo '<td><a href="remove_customer.php?CustomerID='.$row['CustomerID'].'">Remove</a> ';
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