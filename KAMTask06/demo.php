<?php

$data = [1,2,3,4,5,-1,77,-23];
//var_dump($data);

// for ($i=0; $i <= count($data); $i++) {
//     $x = $data[$i];
//     if ($x > 3)
//         echo("$x ");
// }

$folder = "images";
$files = scandir($folder);
// var_dump($files);

echo(__DIR__);

foreach($files as $file) {
    echo("$file <br />");
}
?>

<body>
    <form method="get">
        Введите свое имя
    <input type="text" name="user" value="<?=@$_REQUEST['user']?>"/>
    <input type="submit" value="Go"/>
    </form>

    <?php
    if (isset($_REQUEST["user"])) {
        $user = $_REQUEST["user"];
        echo("<h1>Привет, $user</h1>");
    }
    ?>


</body>