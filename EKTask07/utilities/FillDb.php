<?php

$files = scandir(__DIR__."\..\images");
$target_dir = "../images/";
// С точки зрения безопасности так нельзя:
$conn = mysqli_connect("localhost:3306","root","","albumek");



foreach($files as $file) {
    if(strpos($file,"large") === FALSE and strlen($file) > 3) {
       //Конкатенация строк представляет собой потенциальную угрозу, 
       //если параметры для нее передаются пользователем. Хакер может
       //"завернуть" в параметр свое SQL выражениe и заставить его выполниться. 
       //Такая атака называется SQL Injection
       //$sql = "INSERT INTO photos(Name) VALUES('$file')";

       $sql = "INSERT INTO photos(URL, URL_large, Name, Created) VALUES(?, ?, ?, ?)";

       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);;
       $target_file_large = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       $file_large = str_replace($target_dir, "", $target_file_large);
       $prepared = mysqli_prepare($conn,$sql);
       $date = date("Y-m-d");
       $name = str_replace(".jpg","",$file);
       $name = str_replace("-"," ",$name);
       mysqli_stmt_bind_param($prepared,"ssss", $file, $file_large, $name, $date);
       mysqli_stmt_execute($prepared);
    }
}

mysqli_close($conn);

