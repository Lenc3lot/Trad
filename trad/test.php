<?php
$dir = scandir("./outputFR");
unset($dir[0]);
unset($dir[1]);
if (isset($_POST["nomFichier"])) {
    echo "<option data-path='" . $_POST["nomFichier"] . "'  value='" . $_POST["nomFichier"] . "' selected>" . $_POST["nomFichier"] . " </option>";
}
foreach ($dir as $fileinfo) {
    $exploser = explode("_",$fileinfo);
    // echo $exploser[1]."<br>";
    print_r($fileinfo);
}
