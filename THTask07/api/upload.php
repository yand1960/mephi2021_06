<?php

include("params.php");

function upload($file, $file_large, $name_photo) {
  $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);

  $sql = "INSERT INTO photos(URL, URL_large, Name, Created) VALUES(?, ?, ?, ?)";
  $prepared = mysqli_prepare($conn, $sql);
  $date = date("Y-m-d");
  $name = $name_photo;
  $name = str_replace("-", " ", $name);
  mysqli_stmt_bind_param($prepared,"ssss", $file, $file_large, $name, $date);
  mysqli_stmt_execute($prepared); 
  mysqli_close($conn);
}

$files = "../images/";
$name_photo = $_REQUEST['namePhoto'];
$file = $files . basename($_FILES["uploadImg"]["name"]);;

if (file_exists($file)) {
    print "<div align='center'>Фотография уже загружена</div></br>";
  }
else {
  if (move_uploaded_file($_FILES["uploadImg"]["tmp_name"], $file)) {
    $file_large = $files . pathinfo($file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($file,PATHINFO_EXTENSION));
    upload(str_replace($files, "", $file), str_replace($files, "", $file_large), $name_photo);
    print "<div align='center'>Фотография ". htmlspecialchars( basename( $_FILES["uploadImg"]["name"])). " добавлена</div></br>";
  } else {
    print "<div align='center'>Ошибка: Фотография не добавлена</div></br>";
  }
  copy($file, $file_large);
}
?>

<html>
  <head>
        <title>Добавление нового фото</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="./../styles/add_photo.css" />
  </head>
  <body>
    <div>
      <a href="./../index4.html">Вернуться на главную</a></br>
      <a href="./../add_photo.html">Выбрать другое фото</a>
    </div>
  </body>
</html>