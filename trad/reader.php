<?php require __DIR__ . "/vendor/autoload.php";

//FONCTION AFFICHAGE ELEMENT

use HJSON\HJSONParser;

function processElement($leTab, $path, $arg = "")
{
    foreach ($leTab as $key => $element) {
        if (gettype($element) != "array") {
            echo "<tr><td data-id='" . $path . "." . $key . "'>$key</td><td><textarea data-id='" . $path . "." . $key . "' onchange='sendData(this)' style='width:500px; height:125px' $arg>$element</textarea></td>";
        } else {
            echo "<tr><td><table>";
            $newPath = empty($path) ? $key : $path . "." . $key;
            processElement($element, $newPath, $arg);
            echo "</table></td></tr>";
        }
    }
}


function parcourElement($unTab, $path){
    $tableauRacine = array();

    foreach ($unTab as $key => $value) {
        if (gettype($value) != "array") {
            echo $key." --- oui ?<BR>";
            $tableauRacine[] = $key;
        } else {
            $tableauRacine[] = $key;
            echo $key." --- oui ?<BR>";
            foreach ($value as $key1 => $value1) {
                echo $key1." key1<BR> ";
                if (gettype($value1) != "array") {
                } else {
                    foreach ($value1 as $key2 => $value2) {
                        if (gettype($value2) != "array") {
                        } else {
                            foreach ($value2 as $key3 => $value3) {
                                if (gettype($value3) != "array") {
                                } else {
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $tableauRacine;
}

function parcoursElementSpe($unTab, $path){
    $tableauRacine = array();

    foreach($unTab as $key => $value){
        echo "key : ".$key."<br>";
        if(gettype($value) != "array"){
            $tableauRacine[] = $key;
        } else {
            $tableauRacine[] = $key;
            foreach($value as $key => $element){
                echo "key : ".$key. "<br>";
                $tableauRacine[]= $key;
            }
        }
    }
    return $tableauRacine;
}
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./style2.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./script.js"></script>
</head>

<body>

    <h1> Calamity traducteur </h1>

    <p> File selector : </p>

    <form action="./reader.php" method="post">
        <select name='nomFichier'>
            <?php
            $dir = new DirectoryIterator(dirname("./outputFR/folder"));

            if (isset($_POST["nomFichier"])) {
                echo "<option data-path='" . $_POST["nomFichier"] . "'  value='" . $_POST["nomFichier"] . "' selected>" . $_POST["nomFichier"] . " </option>";
            }
            foreach ($dir as $fileinfo) {

                $fichier = $fileinfo->getFilename();
                $nomfichier = explode("_", $fichier);
                echo "<option data-path='" . $nomfichier[1] . "'  value='" . $nomfichier[1] . "'>" . $nomfichier[1] . " </option>";

            }
            ?>
        </select>
        <input type="submit" value="Choisir le fichier">
    </form>
    <?php
    if (isset($_POST["nomFichier"])) {
        $fileEN = "./base1311/" . $_POST["nomFichier"];
        $fileFR = "./outputFR/fr-FR_" . $_POST["nomFichier"];
    }
    ?>
    <button><a href="<?php echo $fileFR; ?>" download>Télécharger</a></button>

    <?php


    if (isset($fileEN) && isset($fileFR) && isset($_POST["nomFichier"])) {

        //Préparation des options + parser pour HJSON
        $option = ['keepWsc' => false, 'assoc' => true];
        $parser = new HJSONParser();

        //recup fichier EN + parse
        $data = file_get_contents($fileEN);
        $obj = $parser->parse($data, $option);

        //recup fichier FR + parse
        $dataFR = file_get_contents($fileFR);
        $objFR = $parser->parse($dataFR, $option);
        ?>
        
        <br>
        <br>

        <?php

        // AFFICHAGE DES ELEMENTS 

        if($fileEN == "./base1311/Mods.CalamityMod.Configs.hjson"){
            echo "FICHIER CONFIG J'EN VEUX PAS";
            print_r(parcoursElementSpe($obj, " "));
        }else{
            print_r(parcourElement($obj, " "));
        }
    }
    ?>

</body>

</html>