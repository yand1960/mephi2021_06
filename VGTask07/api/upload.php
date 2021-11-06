<?php
	include("params.php");

    if(isset($_FILES['file'])) {
        
        $check = can_upload($_FILES['file']);
        if($check === true){
            
            make_upload($_FILES['file'], $_REQUEST['description']);
            echo('Файл успешно загружен!');
        }
        else
        {
            echo($check);
        }
    }

    function can_upload($file) {
        $errorCode = $file['error'];
        $fileTmpName = $file['tmp_name'];
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            return $outputMessage;
        }
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        $mime = (string) finfo_file($fi, $fileTmpName);

        if (strpos($mime, 'image') === false)
        {
            return 'Можно загружать только изображения.';
        }

        return true;
    }

    function make_upload($file, $desc) {

        $path = __DIR__."/../images/";
        $name = $file['name'];
        $name_large = str_replace('.jpg', '', $file['name']).'-large.jpg';

        save_in_db($file['name'], $desc);

        copy($file['tmp_name'], $path.$name_large);

        imageresize($path.$name, $path.$name_large, 130, 124, 75);
    }

    function imageresize($outfile, $infile, $neww, $newh, $quality) {

        $im = imagecreatefromjpeg($infile);
        $im1 = imagecreatetruecolor($neww, $newh);
        imagecopyresampled($im1, $im, 0, 0, 0, 0, $neww, $newh, imagesx($im), imagesy($im));
    
        imagejpeg($im1, $outfile, $quality);
        imagedestroy($im);
        imagedestroy($im1);
    }

    function save_in_db($file, $desc)
    {
        $conn = mysqli_connect(DB_URL, USER, PWD, DB_NAME);

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "insert into photos (URL, Name, Created, URL_large) values(?, ?, ?, ?);";
        $prepared = mysqli_prepare($conn, $sql);
        $date = date('Y-m-d');
        $file_large = str_replace('.jpg', '', $file).'-large.jpg';
        mysqli_stmt_bind_param($prepared, 'ssss', $file, $desc, $date, $file_large);
        mysqli_stmt_execute($prepared);

        mysqli_close($conn);
    }