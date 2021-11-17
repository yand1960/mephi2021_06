<?php
    session_start();
    $i = 0;
    if(isset($_SESSION["clicks"]))
        $i = $_SESSION["clicks"] + 1;
    $_SESSION["clicks"] = $i;
?>

<html>
    <head>
        <title>File API</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Считаем щелчки</h1>
        <form>
            <button>Click me</button>
        </form>
        <p>Число щелчков: <?=$i?></p>
    </body>
</html>