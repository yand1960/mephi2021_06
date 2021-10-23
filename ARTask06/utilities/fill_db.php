<?php
$folder = __DIR__ . '/../images';
$files = array_diff(scandir($folder), array('.', '..'));
$smallFiles = array_filter($files, function ($v) {
    return !str_contains($v, 'large');
});


include("../api/params.php");
$conn = mysqli_connect(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
foreach ($smallFiles as $file) {

    // dangerous
    // $sql = "insert into photos(name) values('$file')";

    $sql = "insert into photos(url,name,created,urlLarge) values(?,?,?,?)";
    $prepared = $conn->prepare($sql);
    if ($prepared === false) {
        print_r("failed to prepare\n");
        print_r($conn->error);
        $conn->close();
        die;
    }
    $name = str_replace('.jpg', '', $file);
    $urlLarge = "images/$name-large.jpg";
    $name = str_replace('-', ' ', $name);
    $date = date("Y-m-d");
    $file = "images/$file";
    $prepared->bind_param('ssss', $file, $name, $date, $urlLarge);
    mysqli_stmt_execute($prepared);
}

$conn->close();