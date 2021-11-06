<?php

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

function resize_to_width($new_width, $image, $width, $height) 
{
 $resize_ratio = $new_width / $width;
 $new_height = $height * $resize_ratio;
 return resize_image($new_width, $new_height, $image, $width, $height);
}

function resize_image($new_width, $new_height, $image, $width, $height) 
{
 $new_image = imagecreatetruecolor($new_width, $new_height);
 imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
 return $new_image;
}

function save_image($new_image, $new_filename, $new_type='jpeg', $quality=80) 
{
 if ($new_type == 'jpeg')
 {
  imagejpeg($new_image, $new_filename, $quality);
 }
 elseif ($new_type == 'png')
 {
  imagepng($new_image, $new_filename);
 }
 elseif ($new_type == 'gif')
 {
  imagegif($new_image, $new_filename);
 }
}
$error = '';
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$namephoto = $_POST['nameperson'];
$namepicture = htmlspecialchars($_POST['nameperson']."-large");
$namepicture1 = htmlspecialchars($_POST['nameperson']."-large").".".$imageFileType;
$url = $namephoto.".".$imageFileType;
$totalnamefile = $target_dir.$namepicture.".".$imageFileType;
$shortnamefile = $target_dir.$_POST['nameperson'].".".$imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  if($check !== false) {
    $error = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $error = "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $error = "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $error = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo ("".$error);
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $totalnamefile)) {
    $filename = '../images/'.$totalnamefile;
list($width, $height, $type) = getimagesize($filename);
$old_image = load_image($filename, $type);

// $new_image = resize_to_width(130, $old_image, $width, $height);
$new_image = resize_image(130, 124, $old_image, $width, $height);
save_image($new_image, '../images/'.$shortnamefile, 'jpeg', 320);


include("params.php");
$conn = mysqli_connect(DB_URL,USER,PWD,DB_NAME);
$sql = "INSERT INTO photos(URL,URL_large,Name, Created) VALUES(?,?,?,?)";
$prepared = mysqli_prepare($conn,$sql);
$date = date("Y-m-d");
mysqli_stmt_bind_param($prepared,"ssss",$url,$namepicture1,$namephoto,$date);
mysqli_stmt_execute($prepared);
mysqli_close($conn);

    echo "The file ". htmlspecialchars( basename($totalnamefile)). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}





?>