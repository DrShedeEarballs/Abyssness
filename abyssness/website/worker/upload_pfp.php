<?php

$imgfile = $_FILES["pfp"];

if (filesize($imgfile["tmp_name"]) <= 0) {
    die('Uploaded file has no contents');
}

$imgtype = exif_imagetype($imgfile["tmp_name"]);
if ($imgtype) {
    die('Uploaded file is not an image');
}

move_uploaded_file($imgfile["temp_name"], __DIR__ . "C:\xampp\htdocs\abyssness\website\img\worker_pfp" . $imgfile["name"]);