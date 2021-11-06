<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_basename = basename($file_name, '.jpg');
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $extensions= array("jpg");
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPG file.";
      }
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../images/".$file_name);
         copy('../images/'.$file_name, '../images/'.$file_basename.'-large.jpg');
         echo("<h2>Фото успешно добавлено! Можете приступать к описанию</h2>"); 
      }else{
         print_r($errors);
      }
   }
   if(isset($_POST['addDesc'])){
      include("params.php");
      $htmlFilename = $_REQUEST['addFilename'] . ".jpg";
      $htmlFilename_large = $_REQUEST['addFilename'] . "-large.jpg";
      $htmlName = $_REQUEST['addName'];
      $htmlDate = $_REQUEST['addDate'];
      $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);
      $sql = "INSERT INTO photos (URL, URL_large, NAME, Created) 
      VALUES ('$htmlFilename', '$htmlFilename_large', '$htmlName', '$htmlDate')";
      if ($conn->query($sql) === TRUE) {
         echo("<h2>Описание фото успешно добавлено! Можете возвращаться к фотоальбому</h2>"); 
       } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }       
      $conn->close();
   }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Добавление фотографии</title>
        <link rel = "stylesheet" href = "../styles/main.css" />
    </head>
   <body>
    <h1>Фотоальбом Web API</h1>
        <h3 class="hdr">1) Выберите файл с фото в формате JPG и после этого нажмите "Отправить"</h3>
        <form class="col" action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" />
            <input class="stylish-btn" type="submit"/>
        </form>
        <h3 class="hdr">2) Введите описание фото и нажмите "Добавить описание"</h3>
        <div>
        <form method="POST" class="col">
        <p>Название файла без расширения (пример: файл picture.jpg => вводим в название picture):</p>
         <input id="addFilename" name="addFilename">
         <p>Имя человека с фотокарточки:</p>
         <input id="addName" name="addName">
         <p>Дата создания фотокарточки в формате YYYY-MM-DD:</p>
         <input id="addDate" name="addDate">
         <button name="addDesc" class="stylish-btn-1">Добавить описание</button>
        </form>
        </div>
        <h3 class="hdr">3) После добавления фото вернитесь назад к фотоальбому</h3>
        <button onclick="f_click()" class="back-btn">Назад</button>
    <script src="script.js"></script>
   </body>
</html>