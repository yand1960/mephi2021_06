<?php
include("../api/params.php");

$conn = mysqli_connect("localhost:3306", "root", "");

$folder = __DIR__ . '/../migrations';
$files = array_diff(scandir($folder), array('.', '..'));

foreach ($files as $file) {
    if (!str_contains($file, ".sql"))
        continue;
    $sql = file_get_contents("$folder/$file");
//    var_dump($sql);
    $conn->multi_query($sql);
    rename("$folder/$file", "$folder/processed/$file");
}
