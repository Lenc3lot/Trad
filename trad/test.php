<?php require __DIR__."/vendor/autoload.php";
use HJSON\HJSONParser;
header('content-type:application/json');
// $_POST["monFichier"] = "./base1311/Mods.CalamityMod.Configs.hjson";
if(isset($_POST["monFichier"])) {
    $fileEN = $_POST["monFichier"];
}
?>

<?php
if(isset($fileEN) && isset($_POST["monFichier"])) {
    //Préparation des options + parser pour HJSON
    $option = ['keepWsc' => false, 'assoc' => "true"];
    $parser = new HJSONParser();

    //recup fichier EN + parse
    $data = file_get_contents($fileEN);
    $obj = $parser->parse($data, $option);
    echo json_encode($obj);
}


?>