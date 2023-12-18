<?php require "../vendor/autoload.php";

use HJSON\HJSONParser;
use HJSON\HJSONStringifier;

$option = ['keepWsc' => false, 'assoc' => true];

$parser = new HJSONParser();
$stringifierHJSON = new HJSONStringifier;

$fileEN = ".".$_POST["file"];
$modifiedElem = $_POST["modifiedElement"];
$keyElem = $_POST["keyElem"];
$valueElem = $_POST["valueElem"];

$monAttribut = $keyElem.".".$modifiedElem;

//recup fichier EN + parse
$data = file_get_contents($fileEN);
$obj = $parser->parse($data, $option);

$tabModif = explode(".",$monAttribut);

$monTabCourant = $obj;

$monAdr = &$monTabCourant;

foreach ($monAdr as $key => $value) {
    if($key == "CalamityConfig"){
        foreach($value as $keyConfig => $valueCfg){
            echo($valueCfg);
        }
    }
    if($key == $keyElem){
        if(gettype($value)=="array"){
            foreach ($value as $key2 => $value2) {
                if($key2 == $tabModif[1]){
                    echo $monAdr[$key][$tabModif[1]];
                    $monAdr[$key][$tabModif[1]] = $valueElem;
                }
            }
        }else{
            $monAdr[$tabModif[1]] = $valueElem;
        }
    }
}

$text = $stringifierHJSON->stringify($monTabCourant);

// $retourtest = "../doc.hjson";
file_put_contents($fileEN,$text);