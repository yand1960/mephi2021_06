<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    include("params.php");

    $conn = mysqli_connect(DB_URL,USER,PWD,DB_NAME);
    $sql = "SELECT PhotoID,URL,URL_large,Name,Created FROM photos";
    $cursor = mysqli_query($conn,$sql);
    $photos = mysqli_fetch_all($cursor);

    echo(json_encode($photos));
