<html>
 <head>
 <title>Загрузка фотографии</title>
 <link rel="stylesheet" href="styles/add_photo.css" />
 </head>
 <body>
 <h1>Загрузка фотографии</h1>
<div class="result">
 
    <?php
    include_once("api/params.php"); 
    $path = 'images/';
    $types = array('image/gif', 'image/png', 'image/jpeg');
    $size = 2048000;
    $min_width=130;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (!in_array($_FILES['picture']['type'], $types))
        {
            echo 'Произошла ошибка, неверный тип файла';
        }
        elseif ($_FILES['picture']['size'] > $size)
        {
            echo 'Произошла ошибка, размер файла больше допустимого';
            var_dump($_FILES['picture']['size']);
        }
        elseif($_FILES['picture']['size'] == 0)
        {
            echo 'Произошла ошибка, файл не задан';
        }
        else
        {
            $picture_name = explode(".",$_FILES['picture']['name']);

            if(strlen($_POST['picturename']) > 0)
            {
                $photo_name = $_POST['picturename'];
                $photo_name_url = $_POST['picturename']."-large.".$picture_name[count($picture_name)-1];
                $min_photo_name = $_POST['picturename'].".".$picture_name[count($picture_name)-1];
            }
            else
            {
                $photo_name_url = $picture_name[0];
                $photo_name = $picture_name[0];
                for( $i=1; $i<count($picture_name)-1; $i++)
                {
                    $photo_name_url = $photo_name_url.".".$picture_name[$i];
                    $photo_name = $photo_name.".".$picture_name[$i];
                }
                $photo_name_url = $photo_name_url."-large".".".$picture_name[count($picture_name)-1];
                $min_photo_name = $_FILES['picture']['name'];
            }

            $files = scandir(__DIR__."\images");
            
            if(in_array($photo_name_url, $files))
                echo 'Файл с таким названием уже существует';

            elseif (!@copy($_FILES['picture']['tmp_name'], $path.$photo_name_url))
            echo 'Произошла ошибка, попробуйте еще раз';
            else
            {
                echo 'Фото успешно загужено';
                if ($_FILES['picture']['type'] == 'image/jpeg')
                {
                    $source = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                }
                elseif ($_FILES['picture']['type'] == 'image/png')
                {
                    $source = imagecreatefrompng($_FILES['picture']['tmp_name']);
                }
                else
                {
                    $source = imagecreatefromgif($_FILES['picture']['tmp_name']);
                }
                $width = imagesx($source); 
                $height = imagesy($source);

                if ($width > $min_width)
                {
                    // Вычисление пропорций
                    $ratio = $width/$min_width;
                    $w_dest = round($width/$ratio);
                    $h_dest = round($height/$ratio);
                    
                    // Создаём пустую картинку
                    $dest = imagecreatetruecolor($w_dest, $h_dest);
                    
                    // Копируем старое изображение в новое с изменением параметров
                    imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $width, $height);
                    
                    // Вывод картинки и очистка памяти
                    imagejpeg($dest, $path.$min_photo_name);
                    imagedestroy($dest);
                    imagedestroy($source);
                }
                else
                {
                    // Вывод картинки и очистка памяти
                    imagejpeg($source, $path.$min_photo_name);
                    imagedestroy($source);
                }

                //Сохранение данных в БД
                $conn=mysqli_connect(DB_URL,USER,PWD,DB_NAME);

                $sql="INSERT INTO photos(URL, URL_large, Name, Created) VALUES (?,?,?,?)";
                $prepared=mysqli_prepare($conn,$sql);
                $date = $_POST["createddate"];
                $name = $photo_name;
               
                mysqli_stmt_bind_param($prepared,"ssss", $min_photo_name,$photo_name_url, $name, $date);
                
                mysqli_stmt_execute($prepared);

                mysqli_close($conn);
            }
        }
    }
    ?>

</div>
<div class="addmore"> 
    <input type="button" onclick="window.location.href='add_photo.html'" value="Добавить фото"/>
</div>
<div class="addmore">
    
    <input type="button" onclick="window.location.href='index4.html'" value="Альбом"/>
</div>
 
 </body>
</html>

