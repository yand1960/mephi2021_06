<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    include("params.php");

    $id = $_REQUEST["id"];
    $id = str_replace("thmb", "", $id);

    $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);
    $sql = "SELECT URL_large, Name, Created FROM photos WHERE PhotoID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $cursor = mysqli_stmt_get_result($stmt);
    $photos = mysqli_fetch_all($cursor)[0];
    $result = [
        "url" => $photos[0],
        "name" => $photos[1],
        "created" => $photos[2]
    ];

    echo(json_encode($result, JSON_UNESCAPED_UNICODE));
            