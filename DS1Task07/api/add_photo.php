<html>
    <head>
        <title>Окно загрузки фотографий</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="styles/main.css"/>
        <style>
            div.thumbnails {
                width: 150px;
                float: left;
            }

            div.thumbnails img {
                margin: 5px;
                border-radius: 50%;
                display: block;
                width: 130px;
                border: solid white thin;
            }

            div.large-photo {
                float: left;
            }

            div.large-photo img {
                width: 400px;
                margin-left: 10px;
            }

            div.thumbnails img:hover {
                border: solid red thick;
                cursor: pointer;
            }

            div.thumbnails img.selected {
                border: solid blue thick;
            }

            
        </style>
    </head>
    <body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Выберите изображение для загрузки:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <p>Пожалуйста, введите описание (Не короче 4 символов)</p>
        <input type="text" name="description" value="" required minlength="4">
        <input type="submit" value="Загрузить изображение" name="submit">
    </form>
    </body>
</html>