<?php
//header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$folder = __DIR__ . '/../images';
$files = array_diff(scandir($folder), array('.', '..'));
$images =[];
foreach ($files as $file) {
    if (!str_contains($file,"large")){
        array_push($images,array("url"=>"images/$file","caption"=>"undefined"));
    }
}
echo(json_encode($images));