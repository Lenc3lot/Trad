<?php require __DIR__ . "/vendor/autoload.php";
    
    use HJSON\HJSONParser;

    $option = ['keepWsc' => false, 'assoc' => true];
    $data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
    $parser = new HJSONParser();
    $obj = $parser->parse($data, $option);


    //print_r($_POST);
    // $monAttribut = $_POST["monAttribut"];
    // $contenu = $_POST["contenu"];
    
    

    // echo $monAttribut[0];
    // $ligne = $monAttribut[1]." ".$contenu."\n";
    // $file = "./essai.txt";
    // $data = file_get_contents($file);
    // $data .= $ligne;
    // $data = file_put_contents($file,$data);

    $monAttribut = "DefaultAttunement.Name";
    $contenu = "Bonjour Test 2 !";

    $jsonmodifiable = "./test.json";
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
    file_put_contents($jsonmodifiable,json_encode($monTabCourant));
?>