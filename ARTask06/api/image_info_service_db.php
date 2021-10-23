<?php
//header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

include("params.php");

$id = (int)$_REQUEST['id'];

$conn = mysqli_connect(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);

$folder = __DIR__ . '/../images';
$sql = "select urlLarge,created, name from photos where photoId = ?";
$prepared = $conn->prepare($sql);

$prepared->bind_param('i', $id);
$prepared->execute();
$prepared->bind_result($url, $date, $name);
$prepared->fetch();

echo(json_encode(array("url" => $url, "date" => $date, "name" => $name), JSON_UNESCAPED_UNICODE));