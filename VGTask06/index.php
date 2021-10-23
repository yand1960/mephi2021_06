<html>
    <head>
        <title>Мой альбом</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <style type="text/css">
            div.thumbnails {
                border: solid black thin;
                width: 150px;
                float: left;
            }
            div.thumbnails img {
                margin: 5px;
                border-radius: 50%;
                display: block;
                width: 130px;
                border: solid white thick;
            }
            div.thumbnails img:hover {
                border: solid red thick;
                cursor:  pointer;
            }
            div.large-photo {
                float: left;
            }
            div.large-photo img {
                width: 400px;
                margin-left: 10px;
            }
            div.thumbnails img.selected {
                border: solid blue thick;
            }
        </style>
        <script type="text/javascript" src="scripts/jquery-3.6.0.js"></script>
        <script type="text/javascript">
            function showLarge(thumb) {
                // alert("!!!!");
                console.log(thumb);
                var pic_name = thumb.src;
                console.log(pic_name);
                // var splitted = pic_name.split(".");
                // var large_name = splitted[0] + "-large." + splitted[1];
                var large_name = pic_name.slice(0, -4) + "-large." + pic_name.slice(-3)
                console.log(large_name);

                // document.getElementById('large-photo').src = large_name;
                // for(element of document.getElementsByClassName("thumbnails")[0].children) {
                //     element.classList.remove('selected')
                // }
                // thumb.classList.add('selected');

                $('#large-photo').attr('src', large_name)
                $('div.thumbnails img').removeClass('selected');
                $(thumb).addClass('selected')
            }
        </script>
    </head>
    <body>
        <h1>Фотоальбом</h1>
        <div class="thumbnails">
            <?php
                $files = scandir(__DIR__."/images");
                $class_name = "selected";
                foreach($files as $file) {
                    if (!strpos($file, "large") and strlen($file) > 3) {
                        echo("
                            <img src='images/$file' onclick='showLarge(this);' class='$class_name'>
                        ");
                        $class_name = "";
                    }
                }
            ?>
        </div>
        <div class="large-photo">
            <img src="images/april-meyer.jpg" id="large-photo">
        </div>
    </body>
</html>