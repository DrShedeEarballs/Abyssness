<?php

try {
    $conn = new PDO("mysql:host=localhost; dbname=abyssness", "root", "");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $err) {
    die("Fatal ERROR: Could not connect. ".$err->getMessage());
}

?>