<?php

include("params.php");

function uploadToDB($file, $file_large, $file_name) {
  $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);

  $sql = "INSERT INTO photos(URL, URL_large, Name, Created) VALUES(?, ?, ?, ?)";
  $prepared = mysqli_prepare($conn, $sql);
  $date = date("Y-m-d");
  $name = $file_name;
  $name = str_replace("-", " ", $name);
  mysqli_stmt_bind_param($prepared,"ssss", $file, $file_large, $name, $date);
  $cursor = mysqli_stmt_execute($prepared); 

  mysqli_close($conn);
}

$target_dir = "../images/";
$file_name = $_REQUEST['key'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file_large = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "\nФото уже было добавлено\n";
    $uploadOk = 0;
  }

if ($uploadOk !== 0) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "\nФото ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " было добавлено.\n";
      uploadToDB(str_replace($target_dir, "", $target_file), str_replace($target_dir, "", $target_file_large), $file_name);
    } else {
      echo "\nПроизошла ошибка\n";
    }
    copy($target_file, $target_file_large);
  }
?>

<html>
  <head>
        <title>Добавьте новое фото</title>
        <meta charset="utf-8"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  </head>
  <body style="font-family: 'Montserrat'; text-align: center; ">
    <div>
      <a href="./../index4.html" class="btn btn-outline-secondary" style="margin-top: 50px;">Перейти в галерею</a>
      <a href="./add_photo.php" class="btn btn-outline-secondary" style="margin-top: 50px;">Выбрать другое фото</a>
    </div>
  </body>
</html>