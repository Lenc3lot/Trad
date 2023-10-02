<?php require __DIR__ . "/vendor/autoload.php";

use HJSON\HJSONParser;

$option = ['keepWsc' => false, 'assoc' => true];

$data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$objFR = $parser->parse($dataFR, $option);
json_encode($objFR);
//var_dump($objFR);
// $retourTab = array();
// $dataTotal = array();

?> 

<table>

	<tr>
		<th> EN_Id </th>
		<th> EN_name </th>
		<th> EN_desc </th>
		<th> FR_Id </th>
		<th> FR_name </th>
		<th> FR_desc </th>
	<tr>


<?php
foreach ($objFR as $key => $element) {
	echo "
	<tr> 		
		<td>".$key."</td><td>";
	if (gettype($element) != 'array') {
		//echo "element1 = ".$element;
	} else {

		foreach ($element as $key2 => $souselement) {
			//echo " key2 = " . htmlspecialchars($key2) . " : ";
			echo htmlspecialchars($key2) ." : ".htmlspecialchars($souselement)." <br>";
			
			if (gettype($key2) != 'array') {

				if (gettype($souselement) == 'array') {

					foreach ($souselement as $key3 => $text) {
						echo " key3 = ".htmlspecialchars($key3)." : ".$text.'';
					}

				}// else {

				// 	//echo "element2 =".htmlspecialchars($souselement);
				
				// }
			}
		}
		echo "</td>";
		
	}
	
}
echo "</tr>";
echo "</table>";

?>