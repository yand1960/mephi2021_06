<?php

    $files = scandir(__DIR__."/../images");
    
    $conn = mysqli_connect('localhost', 'root', '', 'album');

    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    foreach($files as $file) {
        if (!strpos($file, "large") and strlen($file) > 3) {

            $sql = "insert into photos (URL, Name, Created) values(?, ?, ?);";
            $prepared = mysqli_prepare($conn, $sql);
            $date = date('Y-m-d');
            $name = str_replace('.jpg', '', $file);
            $name = str_replace('-', ' ', $name);
            mysqli_stmt_bind_param($prepared, 'sss', $file, $name, $date);
            mysqli_stmt_execute($prepared);
        }
            
    }
    mysqli_close($conn);