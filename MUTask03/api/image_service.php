<?php
    // header("Content-Type: text/html; charset=UTF-8")
    // header("Access-Control-Allow-Origin: *")


    $files = scandir(__DIR__."/../images");
    $images = [];

    $class_name = "selected";
    foreach($files as $file) {
        if (!strpos($file, "large") and strlen($file) > 3) {
            array_push($images, array("url" => "images/$file", "caption" => "undefined"));
        }
    }

    // var_dump($images);
    // sleep(0);
    echo(json_encode($images));	
			