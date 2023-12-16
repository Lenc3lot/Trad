<?php require "../vendor/autoload.php";

use HJSON\HJSONParser;
use HJSON\HJSONStringifier;

$option = ['keepWsc' => false, 'assoc' => true];

// function processElement($leTab, $path, $arg = "")
// {
//     foreach ($leTab as $key => $element) {
//         if (gettype($element) != "array") {
//         } else {
//             $newPath = empty($path) ? $key : $path . "." . $key;
//             processElement($element, $newPath, $arg);
//         }
//     }
// }

// $fileEN = "."+$_POST["tabElem"];
// $modifiedElem = $_POST["elem"];
// $keyElem = $_POST["keyElem"];
// $valueElem = $_POST["valueElem"];

$parser = new HJSONParser();
$stringifierHJSON = new HJSONStringifier;


$fileEN = "../testfiles/Mods.CalamityMod.Attunement.hjson";
$modifiedElem = "Function";
$keyElem = "DefaultAttunement";
$valueElem = "CA MARCHE";

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