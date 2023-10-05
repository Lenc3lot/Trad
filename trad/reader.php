<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

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

    <?php require __DIR__ . "/vendor/autoload.php";

    //FONCTION AFFICHAGE ELEMENT FR


    use HJSON\HJSONParser;

    function processElement($leTab, $path)
    {
        foreach ($leTab as $key => $element) {
            if (gettype($element) != "array") {
                echo "<tr><td data-id='" . $path . "." . $key . "'>$key</td><td><textarea data-id='" . $path . "." . $key . "' onchange='sendData(this)' style='width:500px; height:125px'>$element</textarea></td>";
            } else {
                echo "<tr><td><table>";
                $newPath = empty($path) ? $key : $path . "." . $key;
                processElement($element, $newPath);
                echo "</table></td></tr>";
            }
        }
    }

    //FONCTION AFFICHAGE ELEMENT EN
    function processElementEN($leTab, $path)
    {
        foreach ($leTab as $key => $element) {
            if (gettype($element) != "array") {
                echo "<tr><td data-id='" . $path . "." . $key . "'>$key</td><td><textarea data-id='" . $path . "." . $key . "' onchange='sendData(this)' style='width:500px; height:125px' disabled>$element</textarea></td>";
            } else {
                echo "<tr><td><table>";
                $newPath = empty($path) ? $key : $path . "." . $key;
                processElementEN($element, $newPath);
                echo "</table></td></tr>";
            }
        }
    }




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

        // echo "<table>";
        // processElementEN($obj, "");
        // echo "</table>";

        ###############################
        # ELEMENT TRADUIT EN FRANCAIS # 
        ###############################

        echo "<table>";
        processElement($objFR, "");
        echo "</table>";
    }
    ?>

</body>

</html>