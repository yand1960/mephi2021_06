<?php
include_once('./api/function_add_photo.php')
?>
<html>
    <head>
        <title>Мой альбом</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <style type="text/css">
        .form-row {
          margin-bottom: 15px;
        }
        
        .form-row label {
          display: block;
          color: #777;
          margin-bottom: 5px;
        }

        a {
          text-decoration: none;
          font-family: 'Lora', serif;
          transition: .5s linear;
          font-size: 14px
        }
        
        
        nav {
          display: block;
          width: 100%;
          margin-bottom:5px;
        }
         .one ul {
            padding: 1em 0;
            background: #BBBBBB;
            border: solid black thin;
            border-radius: 10px;
            list-style: none; 
          }
          
          .one a {
              padding: 1em;
              border-right: 1px solid #BBBBBB;
              color: black;
            }
    
            .one a:hover {
                background: #8a8988;
                border-radius: 10px;
            }

            .one li {
                display: inline;
            } 
        </style>
        <script type="text/javascript" src="scripts/jquery-3.6.0.js"></script>
        <!-- <script type="text/javascript">
        </script> -->
    </head>
    <body onload="">
    <h1 style="margin-top: 5px; margin-bottom: 5px;">Фотоальбом Web API</h1>
      <nav class="one">
        <ul>
          <li><a href="index4.html">Главная</a></li>
          <li><a href="add_photo.php">Добавление фото</a></li>
        </ul>
      </nav>
        <h2>Загрузка изображений в фотоальбом</h2>
        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
          <label>Выберете желаемое изображение:</label>
            <input type="file" name="picture" required>
          </div>
          <div class="form-row">
          <label>Добавьте описание изображения:</label>
          <textarea name="comment" cols="40" rows="3" required></textarea>
          </div>
          <div class="form-row">
            <input type="submit" value="Загрузить файл">
          </div>
         
        </form>
          
          <?php
 

if (isset($_GET['result'])) {
  echo $_GET['result'];
}
          // если была произведена отправка формы
          if(isset($_FILES['picture'])) {
            // проверяем, можно ли загружать изображение
          $check = can_upload($_FILES['picture']);
          $comment = $_REQUEST['comment'];
          if ($check === true){
          //     // загружаем изображение на сервер
              make_upload($_FILES['picture'], $comment);
          //     echo "<strong>Файл успешно загружен!</strong>";
                      
            }
            else{
          //     // выводим сообщение об ошибке
              echo "<script type='text/javascript'>alert('$check');</script>";  
            }
          }
          ?>

    </body>
</html>