<?php
include("../api/params.php");

$conn = mysqli_connect("localhost:3306", "root", "", "Mysql");


$files = scandir(__DIR__."\..\migration");

foreach($files as $file) {
    echo($file);
    if($file != "processed" and strlen($file)>4) {
    $sql = file_get_contents(__DIR__."/../migration/".$file);
    var_dump($sql);
    mysqli_multi_query($conn,$sql);
    rename(__DIR__."/../migration/".$file, __DIR__."/../migration/processed/".$file);
}
    }   


// $sql = "SELECT PhotoID,URL FROM photos";
// $cursor = mysqli_query($conn, $sql);

