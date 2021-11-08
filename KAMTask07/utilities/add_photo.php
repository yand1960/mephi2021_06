<?php
// include("params.php");

$file = $_FILES["file"]["tmp_name"];
$filename = $_FILES["file"]["name"];
$desc = $_POST["desc"];
// list($width, $height, $type) = getimagesize($file);
list($fileClearName, $type) = explode(".", $filename);
$fileLargeName = $fileClearName."-large.".$type;

move_uploaded_file($file, __DIR__."/../images/".$filename);
copy(__DIR__."/../images/".$filename, __DIR__."/../images/".$fileLargeName);

echo($fileLargeName);

$conn = mysqli_connect("localhost:3306", "root", "", "albumkam2");

$sql = "INSERT INTO photos(URL, URL_large, Name, Created) VALUES(?,?,?,?)";
$prepared = mysqli_prepare($conn, $sql);
$date = date("Y-m-d");
mysqli_stmt_bind_param($prepared, "ssss", $filename, $fileLargeName, $desc, $date);
mysqli_stmt_execute($prepared);
mysqli_close($conn);
?>