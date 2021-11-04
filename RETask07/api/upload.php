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
$file_name1 = $_REQUEST['key'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);;

// Брал отсюда: https://www.w3schools.com/php/php_file_upload.asp
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file_large = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    var_dump($target_file);
    var_dump($target_file_large);
    $uploadOk = 0;
  }
  
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      copy($target_file, $target_file_large);
      uploadToDB(str_replace($target_dir, "", $target_file), str_replace($target_dir, "", $target_file_large), $file_name1);
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }

  }
?>