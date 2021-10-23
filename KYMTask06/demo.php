<?php

$data = [1,2,3,4,5,-1,77,-23];
//var_dump($data);
for($i = 0; $i < count($data); $i++){
    $x = $data[$i];
    if ($x > 3){
        echo("$x");
    }
}

$folder = __DIR__."\images";
$files = scandir($folder);
var_dump($files);
foreach($files as $file){
    echo("$file <br />");
}
?>

<body>
    <form method="get">
        Введите своё имя:
        <input type="text" name="user" value="<?=@$_REQUEST["user"]?>"/>
        <input type="submit" value="go!" />
    </form>

    <?php
        if (isset($_REQUEST["user"])){
            $user = $_REQUEST["user"];
            echo("<p>Hello, $user!</p>");
        }
    ?>

</body>