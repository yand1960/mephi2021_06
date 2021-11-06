<?php

include("params.php");


$target_dir = "../images/";
$file_name1 = $_REQUEST['key'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file_large = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "-large." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


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


  function load_image($filename, $type) 
  {
   if ($type == IMAGETYPE_JPEG) 
   {
    $image = imagecreatefromjpeg($filename);
   }
   elseif ($type == IMAGETYPE_PNG)
   {
    $image = imagecreatefrompng($filename);
   }
   elseif ($type == IMAGETYPE_GIF)
   {
    $image = imagecreatefromgif($filename);
   }

   return $image;
  }

function resize_image($new_width, $new_height, $image, $width, $height) 
{
 $new_image = imagecreatetruecolor($new_width, $new_height);
 imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
 return $new_image;
}


if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Данное фото уже существует";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Объем фото слишком большое";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Недопустимый формат фото";
  $uploadOk = 0;
}


if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_large)) {
    $filename = $target_file_large;
    list($width, $height, $type) = getimagesize($filename);
    $old_image = load_image($filename, $type);
    $new_image = resize_image(150, 150, $old_image, $width, $height);
    imagejpeg($new_image, $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . "." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION)), 75);
    uploadToDB(str_replace($target_dir, "", $target_file), str_replace($target_dir, "", $target_file_large), $file_name1);
    echo "Фото ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " загружено.";
  } else {
    echo "Произошла ошибка";
  }
}

?>
<form action="../index4.html" method="post" enctype="multipart/form-data">            
                <input type="submit" value=" Вернуться в галерею" name="submit">
            </form>