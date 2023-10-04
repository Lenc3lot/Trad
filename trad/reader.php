<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="./style2.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="./script.js"></script>
</head>

<body>

<?php require __DIR__ . "/vendor/autoload.php";
    
use HJSON\HJSONParser;
function processElement($leTab,$path){
    foreach($leTab as $key => $element){
        if(gettype($element) != "array"){
            echo "<tr><td data-id='".$path.".".$key."'>$key</td><td><textarea data-id='".$path.".".$key."' onchange='sendData(this)' style='width:500px; height:125px'>$element</textarea></td>";
        }
        else{
            echo "<tr><td><table>";
            $newPath = empty($path) ? $key : $path.".".$key;
            processElement($element,$newPath);
            echo "</table></td></tr>";
        }
    }
}

$option = ['keepWsc' => false, 'assoc' => true];
$data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson");

$objFR = $parser->parse($dataFR, $option);


    $monTab = json_decode(file_get_contents("./test.json"),true);
    

###############################
# ELEMENT ORIGINAL EN ANGLAIS # 
###############################

echo "<table>";
    processElement($obj,"");
echo "</table>";

###############################
# ELEMENT TRADUIT EN FRANCAIS # 
###############################



    echo "<table>";
    processElement($objFR,"");
    echo "</table>";
    
    
?>

</body>
</html>