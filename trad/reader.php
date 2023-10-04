<?php require __DIR__ . "/vendor/autoload.php";

    
use HJSON\HJSONParser;

$option = ['keepWsc' => false, 'assoc' => true];
$data = file_get_contents("./base1311/Mods.CalamityMod.Configs.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson");

$objFR = $parser->parse($dataFR, $option);


    $monTab = json_decode(file_get_contents("./test.json"),true);
    
    echo "<table>";
    processElement($obj,"");
    echo "</table>";
    function processElement($leTab,$path){
        foreach($leTab as $key => $element){
            if(gettype($element) != "array"){
                echo "<tr><td data-id='".$path.".".$key."'>$key</td><td>$element</td><td><button data-id='".$path.".".$key."' onclick='sendData(this)'>Changer</button></tr>";
            }
            else{
                echo "<tr><td><table>";
                $newPath = empty($path) ? $key : $path.".".$key;
                processElement($element,$newPath);
                echo "</table></td></tr>";
            }
        }
    }
    
    echo "
        <script>
            function sendData(monInput){
                alert(monInput.getAttribute('data-id') + ' ' + monInput.parentNode.parentNode.getElementsByTagName('TD')[1].innerHTML); 
            }
        </script>
    ";
?>