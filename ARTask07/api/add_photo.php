<?php
header("Content-Type: application/json");

include("params.php");

$currentDirectory = getcwd();
$uploadDirectory = "/../images/";

$fileName = $_FILES['the_file']['name'];
$fileTmpName = $_FILES['the_file']['tmp_name'];
$array = explode('.', $fileName);
$fileExtension = strtolower(end($array));

$name = '';
$description = '';

if (isset($_POST["name"])) $name = str_replace(' ', '-', $_POST["name"]);
if ($name == '') $name = $fileName;

if (isset($_POST["description"])) $description = $_POST["description"];
if ($description == '') $description = "не предоставлено";


$uploadPath = $currentDirectory . $uploadDirectory . "$name-large.$fileExtension";


if (isset($_POST['submit'])) {
    while (file_exists($uploadPath)) {
        $name = $name . '1';
        $uploadPath = $currentDirectory . $uploadDirectory . "$name-large.$fileExtension";
    }

    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    $notLargeUploadPath = str_replace('-large.', '.', $uploadPath);
    copy($uploadPath, $notLargeUploadPath);


    $conn = mysqli_connect(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);

    $sql = "insert into photos(url,name,created,urlLarge) values(?,?,?,?)";
    $prepared = $conn->prepare($sql);
    if ($prepared === false) {
        print_r("failed to prepare\n");
        print_r($conn->error);
        $conn->close();
        die;
    }
    $urlLarge = "images/$name-large.$fileExtension";
    $date = date("Y-m-d");
    $url = "images/$name.$fileExtension";
    $prepared->bind_param('ssss', $url, $description, $date, $urlLarge);
    mysqli_stmt_execute($prepared);
    $conn->close();
}
if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: {$_SERVER["HTTP_REFERER"]}");
}