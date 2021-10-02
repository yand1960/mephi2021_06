<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    $files = scandir(__DIR__."\..\images");  
    $images = [];       
    foreach($files as $file){
        if(strpos($file, "large") === FALSE and strlen($file) > 3){
            array_push($images, 
            array("url" => "images/$file", "caption" => "undefined"));
        }
    }
    //var_dump($images);
    echo(json_encode($images));
            