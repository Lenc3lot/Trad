<?php
session_start();
$data = json_decode(file_get_contents("../data/logs.json"),true);

// $indexElem = $_POST["indexElem"];
// $fileElem = $_POST["fileElem"];

$indexElem = "test";
$fileElem = "test";

$newLog = [
    "user" => $_SESSION["utlisateur"],
    "date" => date("Y-m-d H:i:s"),
    "indexElem" => $indexElem,
    "fileElem" => $fileElem
];
    
$data[] = $newLog;
file_put_contents("../data/logs.json",json_encode($data));
?>