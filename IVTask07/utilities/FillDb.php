<?php

$files = scandir(__DIR__."\..\images");

// С точки зрения безопасности так нельзя:
$conn = mysqli_connect("localhost:33062","root","","album");


foreach($files as $file) {
    if(strpos($file,"large") === FALSE and strlen($file) > 3) {
       //Конкатенация строк представляет собой потенциальную угрозу, 
       //если параметры для нее передаются пользователем. Хакер может
       //"завернуть" в параметр свое SQL выражениe и заставить его выполниться. 
       //Такая атака называется SQL Injection
       //$sql = "INSERT INTO photos(Name) VALUES('$file')";

       $sql = "INSERT INTO photos(URL,Name, Created) VALUES(?,?,?)";
       $prepared = mysqli_prepare($conn,$sql);
       $date = date("Y-m-d");
       $name = str_replace(".jpg","",$file);
       $name = str_replace("-"," ",$name);
       mysqli_stmt_bind_param($prepared,"sss",$file,$name,$date);
       mysqli_stmt_execute($prepared);
    }
}

mysqli_close($conn);

