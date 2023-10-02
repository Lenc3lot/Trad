<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="./style2.css">
</head>


<body>

<?php require __DIR__ . "/vendor/autoload.php";

use HJSON\HJSONParser;

$option = ['keepWsc' => false, 'assoc' => true];

$data = file_get_contents("./base1311/Mods.CalamityMod.Attunement.hjson");
$parser = new HJSONParser();
$obj = $parser->parse($data, $option);

$dataFR = file_get_contents("./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson");
$objFR = $parser->parse($dataFR, $option);
json_encode($objFR);
//var_dump($objFR);
// $retourTab = array();
// $dataTotal = array();

?> 

<table>

	<tr>
		<th> EN_Id </th>
		<th> EN_desc </th>
	<tr>


<?php
foreach ($obj as $key => $element) {
	echo "
	<tr> 		
		<td>".$key."</td>
		<td>";
	if (gettype($element) != 'array') {
		echo $element;
	} else {

		foreach ($element as $key2 => $souselement) {
			//echo " key2 = " . htmlspecialchars($key2) . " : ";
			
			
			if (gettype($key2) != 'array') {

				if (gettype($souselement) == 'array') {

					foreach ($souselement as $key3 => $text) {
						echo " key3 = ".htmlspecialchars($key3)." : ".htmlspecialchars($text).'';
					}

				} else {

					echo htmlspecialchars($key2) ." : ".htmlspecialchars($souselement)." <br>";
				
				}
			}
		}
		echo "</td>";
		
	}
	
}
echo "</tr>";
echo "</table>";
?>

<table>

	<tr>
		<th> FR_Id </th>
		<th> FR_desc </th>
	<tr>


<?php
foreach ($objFR as $FRkey => $FRelement) {
	echo "
	<tr> 		
		<td>".$FRkey."</td>
		<td>";
	if (gettype($FRelement) != 'array') {
		echo $FRelement;
	} else {

		foreach ($FRelement as $FRkey2 => $FRsouselement) {
			//echo " key2 = " . htmlspecialchars($key2) . " : ";
			
			
			if (gettype($FRkey2) != 'array') {

				if (gettype($FRsouselement) == 'array') {

					foreach ($FRsouselement as $FRkey3 => $FRtext) {
						echo " key3 = ".htmlspecialchars($FRkey3)." : ".htmlspecialchars($FRtext).'';
					}

				} else {

					echo htmlspecialchars($FRkey2) ." : ".htmlspecialchars($FRsouselement)." <br>";
				
				}
			}
		}
		echo "</td>";
		
	}
	
}
echo "</tr>";
echo "</table>";

?>
</body>
<html>