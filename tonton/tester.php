<?php require __DIR__ . "/vendor/autoload.php";

use HJSON\HJSONParser;

$option = ['keepWsc' => false, 'assoc' => true];


$data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./base1311/Mods.CalamityMod.Configs.hjson");
$objFR = $parser->parse($dataFR, $option);
json_encode($objFR);
//var_dump($objFR);

foreach ($objFR as $key => $element) {
	echo "<b style='font-size:1.75em'>" . $key . "</b>" . " :<br>	";
	if (gettype($element) != 'array') {
		echo $element;
	} else {
		foreach ($element as $key2 => $souselement) {
			echo "<b>" . $key2 . " :</b><br/> ";
			if (gettype($key2) != 'array') {
				if (gettype($souselement) == 'array') {
					foreach ($souselement as $key3 => $text) {
						echo " \_>	<b>".$key3." :</b> ".$text.'<br/>';
					}
				} else {
					echo $souselement.'<br/>';
				}
			}
		}
	}
	echo "<br><br>";

}


//print_r($tab);
?>