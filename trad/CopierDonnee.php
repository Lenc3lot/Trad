<?php require __DIR__ . "/vendor/autoload.php";
    
    use HJSON\HJSONParser;
    use HJSON\HJSONStringifier;

    $option = ['keepWsc' => false, 'assoc' => true];

    $fichier = "./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson";

    $data = file_get_contents($fichier);
    $parser = new HJSONParser();
    $stringifierHJSON = new HJSONStringifier;
    $obj = $parser->parse($data, $option);
    // $monAttribut = $_POST["monAttribut"];
    // $contenu = $_POST["contenu"];

    // echo $monAttribut[0];

    $monAttribut = "DefaultAttunement.Name";
    $contenu = "Bonjour Test 2 !";

    $tabModif = explode(".",$monAttribut);

    $monTabCourant = $obj;

    $monAdr = &$monTabCourant;

    for($i = 0;$i<count($tabModif);$i++){
        if($i == count($tabModif)-1){
            $monAdr[$tabModif[$i]] = $contenu;
        }
        else{
            $monAdr = &$monAdr[$tabModif[$i]];
        }
    }

    $text = $stringifierHJSON->stringify($monTabCourant);

    $retourtest = "./doc.hjson";
    file_put_contents($retourtest,$text);
?>