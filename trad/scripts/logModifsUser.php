<?php
session_start();
$data = json_decode(file_get_contents("../data/logs.json"),true);
$tabElem = $_POST["tabElem"];
$elem = $_POST["elem"];
$keyElem = $_POST["keyElem"];
$newValueElem = $_POST["valueElem"];
$oldValueElem = $_POST["oldValueElem"];
$newLog = [
    "user" => $_SESSION["utlisateur"],
    "date" => date("Y-m-d H:i:s"),
    "tabElem" => $tabElem,
    "keyElem" => $keyElem,
    "elem" => $elem,
    "oldValueElem" => $oldValueElem,
    "newValueElem" => $newValueElem
];
$data[] = $newLog;
file_put_contents("../data/logs.json",json_encode($data));
?>