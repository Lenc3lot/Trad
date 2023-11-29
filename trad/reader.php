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


function parcourElement($unTab, $path, $arg = "")
{

    $tableauRacine = array();

    foreach ($unTab as $key => $value) {
        if (gettype($value) != "array") {
            echo 'bout <br>' ;
            //echo "<tr><td> -----> PAS ARRAY ".$key."</td>";
            $tableauRacine[] = $key;
        } else {
            //echo "<tr><td><table> --> ARRAY ".$key." path : ".$path.".".$key;
            // $nvPath = empty($path) ? $key : $path . "." . $key;
            // $tableau[] = $key;
            echo'pas bout <br>';
            $tableauRacine[] = $key;
            foreach ($value as $key1 => $value1) {
                if (gettype($value1) != "array") {
                    echo "bout1 <br>";
                } else {
                    echo 'pas bout 1 <br>';
                    // $tableauRacine[] = $key1;
                    foreach ($value1 as $key2 => $value2) {
                        if (gettype($value2) != "array") {
                            echo "bout2 <br>";
                        } else {
                            echo " pas bout2";
                            foreach ($value2 as $key3 => $value3) {
                                if (gettype($value3) != "array") {
                                    echo "bout3 <br>";
                                } else {
                                    echo " pas bout3";
                                }
                            }
                        }
                    }
                    // parcourElement($value,$nvPath,$arg);
                    //echo "</table></td></tr>";
                }
            }
        }
    }
    return $tableauRacine;
}


// foreach($key as $key2 => $value2){
//     if(gettype($value) != "array"){
//         echo "<tr><td> -----> PAS ARRAY ".$key2."</td>";
//     }else{
//         echo "<tr><td><table> --> ARRAY ".$key2;
//     } 
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

        $option = ['keepWsc' => false, 'assoc' => true];
        $data = file_get_contents($fileEN);
        $parser = new HJSONParser();
        $obj = $parser->parse($data, $option);
        $dataFR = file_get_contents($fileFR);
        $objFR = $parser->parse($dataFR, $option);

        ###############################
        # ELEMENT ORIGINAL EN ANGLAIS # 
        ###############################
    
        $Newtableau = array();
        echo "<section><table>";
        //processElement($obj, "","disabled");
        print_r(parcourElement($obj, " ", "disabled"));
        echo "</table>";
        ###############################
        # ELEMENT TRADUIT EN FRANCAIS # 
        ###############################
    
        echo "<table>";
        //processElement($objFR, "");
        echo "</table></section>";
    }
    ?>

</body>

</html>