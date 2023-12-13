<?php
session_start();
$data = json_decode(file_get_contents("../data/logs.json"),true);
$tabElem = $_POST["tabElem"];
$elem = $_POST["elem"];
$keyElem = $_POST["keyElem"];
$valueElem = $_POST["valueElem"];
$newLog = [
    "user" => $_SESSION["utlisateur"],
    "date" => date("Y-m-d H:i:s"),
    "tabElem" => $tabElem,
    "keyElem" => $keyElem,
    "elem" => $elem,
    "valueElem" => $valueElem
];
$data[] = $newLog;
file_put_contents("../data/logs.json",json_encode($data));
?>