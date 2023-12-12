<?php require __DIR__."/vendor/autoload.php";
session_start();

use HJSON\HJSONParser;

//FONCTIONS AFFICHAGE ELEMENT
function processElement($leTab, $path, $arg = "") {
    foreach($leTab as $key => $element) {
        if(gettype($element) != "array") {
            echo "<tr><td data-id='".$path.".".$key."'>$key</td><td><textarea data-id='".$path.".".$key."' onchange='sendData(this)' style='width:500px; height:125px' $arg>$element</textarea></td>";
        } else {
            echo "<tr><td><table>";
            $newPath = empty($path) ? $key : $path.".".$key;
            processElement($element, $newPath, $arg);
            echo "</table></td></tr>";
        }
    }
}

function parcourElement($unTab, $path) {
    $tableauRacine = array();
    foreach($unTab as $key => $value) {
        if(gettype($value) != "array") {
            $tableauRacine[] = $key;
        } else {
            $tableauRacine[] = $key;
            foreach($value as $key1 => $value1) {
                if(gettype($value1) != "array") {
                } else {
                    foreach($value1 as $key2 => $value2) {
                        if(gettype($value2) != "array") {
                        } else {
                            foreach($value2 as $key3 => $value3) {
                                if(gettype($value3) != "array") {
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

function parcoursElementSpe($unTab, $path) {
    $tableauRacine = array();
    foreach($unTab as $key => $value) {
        if(gettype($value) != "array") {
            $tableauRacine[] = $key;
        } else {
            $tableauRacine[] = $key;
            foreach($value as $key => $element) {
                $tableauRacine[] = $key;
            }
        }
    }
    return $tableauRacine;
}

// if(!isset($_SESSION["utlisateur"])){
//     header("Location: ./connexion.php");
// }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="./style2.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="./script.js"></script>
</head>

<body>
    <header>
        <ul>
            <h1> Calamity traducteur </h1>
            <li>
                <?php echo "Modifie les fichiers en temps que : ".$_SESSION["utlisateur"] ?>
            </li>
        </ul>
    </header>

    <p> File selector : </p>
    <form action="./reader.php" method="post">
        <select name='nomFichier'>
            <?php
            $dir = scandir("./outputFR");
            unset($files[0]);
            unset($files[1]);
            if(isset($_POST["nomFichier"])) {
                echo "<option data-path='".$_POST["nomFichier"]."'  value='".$_POST["nomFichier"]."' selected> FICHIER ACTUEL : ".$_POST["nomFichier"]." </option>";
            } else {
                echo "<option selected> Selectionnez un fichier ... </option>";
            }
            foreach($dir as $fileinfo) {
                $nomfichier = explode("_", $fileinfo);
                if($nomfichier[1] != "") {
                    echo "<option data-path='".$nomfichier[1]."'  value='".$nomfichier[1]."'>".$nomfichier[1]." </option>";
                }
            }
            ?>
        </select>

        <input type="submit" value="Choisir le fichier">
    </form>


    <?php
    if(isset($_POST["nomFichier"])) {
        $fileEN = "./base1311/".$_POST["nomFichier"];
        $fileFR = "./outputFR/fr-FR_".$_POST["nomFichier"];
    }

    if(isset($fileEN) && isset($fileFR) && isset($_POST["nomFichier"])) {
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

        <div id="displayData">
            <?php
            // AFFICHAGE DES ELEMENTS 
            if($fileEN == "./base1311/Mods.CalamityMod.Configs.hjson") {
                $listeElements = parcoursElementSpe($obj, " ");
                echo "<ul>";
                foreach($listeElements as $elem) {
                    echo "<li onclick='afficherValues(this)' data-tab='".$fileEN."'>".$elem."</li>";
                }
                echo "</ul>";
            } else {
                $listeElements = parcourElement($obj, " ");
                echo "<ul>";
                foreach($listeElements as $elem) {
                    echo "<li onclick='afficherValues(this)' data-tab='".$fileEN."'>".$elem."</li>";
                }
                echo "</ul>";
            }
    } ?>
    </div>
</body>

</html>