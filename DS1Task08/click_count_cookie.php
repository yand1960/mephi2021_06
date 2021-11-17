<?php
    $i = 0;
    if(isset($_COOKIE["clicks"]))
        $i = $_COOKIE["clicks"] + 1;
    setcookie("clicks", $i, time() + 60);
?>

<html>
    <head>
        <title>Cookie</title>
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