<?php
    include("../api/params.php");

    $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);

    $files = scandir(__DIR__."\..\migrations");
    $class_name="selected";
    foreach ($files as $file)
    {
        echo($file);
        if ($file != "processed" and strlen($file) > 4){
             $sql = file_get_contents(__DIR__."/../migrations/".$file);
            var_dump($sql);
            mysqli_multi_query($conn, $sql);
            rename(__DIR__."/../migrations/".$file, __DIR__."/../migrations/processed/".$file);
        }
           
    }

    // $sql = "SELECT PhotoID, URL FROM photos";
    // $cursor = mysqli_query($conn, $sql);
    