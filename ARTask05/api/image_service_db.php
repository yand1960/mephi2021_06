<?php
//header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

include("params.php");
$conn = mysqli_connect(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);

$folder = __DIR__ . '/../images';
$sql = "select photoId, url from photos";
$result = $conn->query($sql)->fetch_all();
echo(json_encode($result,JSON_UNESCAPED_UNICODE));