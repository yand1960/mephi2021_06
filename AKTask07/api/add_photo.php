<html>
    <head>
        <title>Добавьте новое фото</title>
        <meta charset="utf-8"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body style="font-family: 'Montserrat'; text-align: center; ">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <h1 style="padding-top: 15vh; padding-bottom: 5vh">Добавьте новое фото и описание</h1>
                <input type="file" name="fileToUpload" id="fileToUpload">
            
                <input type="text" name="key" value="" placeholder="Описание" autocomplete="off">
                <input type="submit" value="Загрузить" name="submit">
        </form>
        <a href="./../index4.html" class="btn btn-outline-secondary" style="margin-top: 50px;">Перейти в галерею</a>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</html>