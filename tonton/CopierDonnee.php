<?php

    print_r($_POST);
    $rceup = $_POST;
    $file = "./essai.txt";
    $data = file_get_contents($file);
    $data = "";
    $data = file_put_contents($file,$rceup);
?>