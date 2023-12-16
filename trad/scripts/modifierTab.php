<?php require __DIR__."/vendor/autoload.php";
use HJSON\HJSONParser;
use HJSON\HJSONStringifier;

    $option = ['keepWsc' => false, 'assoc' => true];
    $fileEN = $_POST["tabElem"];
    $modifiedElem = $_POST["elem"];
    $keyElem = $_POST["keyElem"];
    $valueElem = $_POST["valueElem"];

    $parser = new HJSONParser();

    //recup fichier EN + parse
    $data = file_get_contents($fileEN);
    $obj = $parser->parse($data, $option);
    echo json_encode($obj);
