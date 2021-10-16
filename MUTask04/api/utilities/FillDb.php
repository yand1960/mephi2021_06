<?php

$files = scandir(__DIR__."\..\images");

mysqli_connect("localhost:33062")


foreach($files as $file) {
    if(strpos($file,"large") === FALSE and strlen($file) > 3) {
 
    }
}