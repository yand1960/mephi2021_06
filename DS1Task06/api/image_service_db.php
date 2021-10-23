<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    include("params.php");

    $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);
    $sql = "SELECT PhotoID, URL, Name, Created FROM photos";
    $cursor = mysqli_query($conn, $sql);
    $photos = mysqli_fetch_all($cursor);


    echo(json_encode($photos, JSON_UNESCAPED_UNICODE));