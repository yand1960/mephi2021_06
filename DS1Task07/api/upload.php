<?php

  include("params.php");
  $target_dir = "../images/";


  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);;
  $target_file_large = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $description = $_REQUEST['description'];

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
  }
  
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
    copy($target_file, $target_file_large);
    saveFileMeta(
      str_replace($target_dir, "", $target_file), 
      str_replace($target_dir, "", $target_file_large), 
      $description
    );
  }

  function saveFileMeta($file, $file_large, $description) {
      $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);

      $sql = "INSERT INTO photos(URL, URL_large, Name, Created) VALUES(?, ?, ?, ?)";
      $prepared = mysqli_prepare($conn, $sql);
      $date = date("Y-m-d");
      $name = str_replace("-", " ", $description);
      mysqli_stmt_bind_param($prepared,"ssss", $file, $file_large, $name, $date);
      $cursor = mysqli_stmt_execute($prepared); 

      mysqli_close($conn);
  }

?>