<html>
    <head></head>
    <body>
    <style>
        body {background-color:rgb(204, 216, 37);}
        #upload_field {background-color: rgb(93, 93, 136)}
    </style>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Выберите фотографию:
        <input type="file" name="fileToUpload" id="fileToUpload">

        <input id="upload_field" type="text" name="key" value="">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    </body>
</html>

