<?php
  function can_upload($file){
	$size = 1024000;

	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	
	/* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
	if($file['size'] > $size)
		return 'Файл слишком большой.';
	

	$getMime = explode('.', $file['name']);
	$mime = strtolower(end($getMime));
	$types = array('jpg', 'png', 'bmp', 'jpeg');
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';
	
	return true;
  }

  function imageResize($image, $imageLarge, $newWidth, $newHeight, $quality) {

	$im = imagecreatefromjpeg($imageLarge);
	$im1 = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresampled($im1, $im, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($im), imagesy($im));

	imagejpeg($im1, $image, $quality);
	imagedestroy($im);
	imagedestroy($im1);
}
  
  function make_upload($file, $comment){	
	// формируем уникальное имя картинки: случайное число и name
	$Image = mt_rand(0, 10000) . $file['name'];
	$ImageLarge=str_replace(".jpg","-large.jpg",$Image);
	copy($file['tmp_name'], 'images/' . $ImageLarge);
    

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    include("params.php");
    $conn = mysqli_connect(DB_URL,USER,PWD,DB_NAME);
   
    $path = __DIR__."/../images/";

	$sql = "INSERT INTO photos(URL,URL_large, Name, Created) VALUES(?,?,?,?)";
		   $prepared = mysqli_prepare($conn,$sql);
		   $date = date("Y-m-d");
		   mysqli_stmt_bind_param($prepared,"ssss",$Image,$ImageLarge,$comment, $date);
		   mysqli_stmt_execute($prepared);
	
	mysqli_close($conn);
	
	imageResize($path.$Image, $path.$ImageLarge,130,125,25 );

	header('Location: ./add_photo.php?result=Загрузка удачна');

  }
  