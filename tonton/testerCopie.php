<?php require __DIR__ . "/vendor/autoload.php";

use HJSON\HJSONParser;

$option = ['keepWsc' => false, 'assoc' => true];
$data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson");

$objFR = $parser->parse($dataFR, $option);
//json_encode($objFR);
//var_dump($objFR);

###############################
# ELEMENT ORIGINAL EN ANGLAIS # 
###############################

echo "##################################<br>";
echo "# ELEMENT TRADUIT EN ANGLAIS #<br>";
echo "##################################<br>";
echo "<br><br>";

foreach ($obj as $key => $element) { //On parcoure l'élément obtenu et parsé

	echo "<b style='font-size:1.75em'>" . $key . "</b>" . " :<br>	"; //On affiche la "clé" correspondante a chaque entrée dans le tableau
	
	if (gettype($element) != 'array') { // Si l'élément précedement obtenu n'est pas un tableau , on l'affiche...

		echo $element;
	
	} else { // ...Sinon c'est que c'est un tableau donc on le parcoure en répétant la structure précédente

		foreach ($element as $key2 => $souselement) { // Meme principe, on parcoure le tableau en affichant chaque "clé"

			echo "<b>" . $key2 . " :</b><br/> ";

			if (gettype($key2) != 'array') { // Et on vérifie encore si l'élément est un tableau ou pas.

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

echo "###################################<br>";
echo "# ELEMENT TRADUIT EN FRANCAIS #<br>";
echo "###################################<br>";
echo "<br><br>";

###############################
# ELEMENT TRADUIT EN FRANCAIS # 
###############################

foreach ($objFR as $key => $element) { //On parcoure l'élément obtenu et parsé

	echo "<b style='font-size:1.75em'>" . $key . "</b>" . " :<br>	"; //On affiche la "clé" correspondante a chaque entrée dans le tableau
	
	if (gettype($element) != 'array') { // Si l'élément précedement obtenu n'est pas un tableau , on l'affiche...

		echo $element;	
	
	} else { // ...Sinon c'est que c'est un tableau donc on le parcoure en répétant la structure précédente

		foreach ($element as $key2 => $souselement) { // Meme principe, on parcoure le tableau en affichant chaque "clé"

			echo "<b>" . $key2 . " :</b><br/> ";

			if (gettype($key2) != 'array') { // Et on vérifie encore si l'élément est un tableau ou pas.

				if (gettype($souselement) == 'array') {

					foreach ($souselement as $key3 => $text) {
						echo " \_>	<b>".$key3." :</b> ".$text.'<br/>';
					}

				} else {

					$text = htmlspecialchars($souselement);
					echo $text;
					echo "<input type='text' name='saisie' value='$text'><br/>";//.$souselement.'<br/>';
				}
			}
		}
	}	
	echo "<br><br>";
}

?>