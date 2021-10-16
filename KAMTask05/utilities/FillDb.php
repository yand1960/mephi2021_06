<?php

$files = scandir(__DIR__."/../images");

$conn = mysqli_connect("localhost:3306", "root", "", "album"); //С точки зрения безопасности так нельзя

foreach($files as $file) {
    if (!strpos($file, "large") and strlen($file) > 3) {

        //Конкатинация строк представляет собой потенциальную угрозу, если параметры для нее передаются пользователем (SQL-injection)
        // $sql = "INSERT INTO photos(Name) VALUES($file)"; 
        $sql = "INSERT INTO photos(URL, Name, Created) VALUES(?,?,?)";
        $prepared = mysqli_prepare($conn, $sql);
        $date = date("Y-m-d");
        $name = str_replace(".jpg", "", $file);
        $name = str_replace("-", " ", $name);
        mysqli_stmt_bind_param($prepared, "sss", $file, $name, $date);
        mysqli_stmt_execute($prepared);

    }

}

mysqli_close($conn);
echo("Ready");	

?>