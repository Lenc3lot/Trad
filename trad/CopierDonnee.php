<?php require __DIR__ . "/vendor/autoload.php";
    
    use HJSON\HJSONParser;
    use HJSON\HJSONStringifier;

    $option = ['keepWsc' => false, 'assoc' => true];

    $fichier = "./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson";
    $data = file_get_contents($fichier);
    $parser = new HJSONParser();
    $stringifierHJSON = new HJSONStringifier;
    $obj = $parser->parse($data, $option);

    //print_r($_POST);
    $monAttribut = $_POST["monAttribut"];
    $contenu = $_POST["contenu"];

    // echo $monAttribut[0];
    // $ligne = $monAttribut[1]." ".$contenu."\n";
    // $file = "./essai.txt";
    // $data = file_get_contents($file);
    // $data .= $ligne;
    // $data = file_put_contents($file,$data);

    // $monAttribut = "DefaultAttunement.Name";
    // $contenu = "Bonjour Test 2 !";

    // $jsonmodifiable = "./Copytest.json";

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

    $text = $stringifier->stringify($monTabCourant);

    file_put_contents($fichier,$text);
?>