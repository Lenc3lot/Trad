<?php require "../vendor/autoload.php";

use HJSON\HJSONParser;
use HJSON\HJSONStringifier;

$option = ['keepWsc' => false, 'assoc' => true];

$parser = new HJSONParser();
$stringifierHJSON = new HJSONStringifier;

// $fileEN = ".".$_POST["file"];
$fileEN = "../doc.hjson";
$modifiedElem = $_POST["modifiedElement"];
$keyElem = $_POST["keyElem"];
$valueElem = $_POST["valueElem"];

$monAttribut = $keyElem.".".$modifiedElem;
// echo $monAttribut;

//recup fichier EN + parse
$data = file_get_contents($fileEN);
$obj = $parser->parse($data, $option);

$tabModif = explode(".",$monAttribut);

$monTabCourant = $obj;

$monAdr = &$monTabCourant;



for($i = 0;$i<count($tabModif);$i++){
    if($i == count($tabModif)-1){
        $monAdr[$tabModif[$i]] = $valueElem;
    }
    else{
        $monAdr = &$monAdr[$tabModif[$i]];
    }
}

$text = $stringifierHJSON->stringify($monTabCourant);

$retourtest = "../doc.hjson";
file_put_contents($retourtest,$text);