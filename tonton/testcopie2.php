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
$fulldata = array();
$retourTab = array();
$dataTotal = array();
$i = 0;

?> 

<section id="ZoneSelect">
	
	<header>
		<h2>Traducteur CalamityFR</h2>
	</header>

	<select>
	
	<?php
	$dir = new DirectoryIterator(dirname("./base1311/test"));
	foreach ($dir as $fileinfo) {
		echo "<option>" .$fileinfo->getFilename() . " </option>";
	}
	?>

	</select>

</section>

<section id= "EN_table">

<table>

	<tr>
		<th> EN_Id </th>
		<th> EN_desc </th>
	<tr>


<?php
foreach ($obj as $key => $element) { //élément non traduit
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

					echo htmlspecialchars($key2) ." : ".htmlspecialchars($souselement)." </br>";
					$retourTab["$key2"] = $souselement;
					$dataTotal["$key"] = $retourTab["$key2"];
					$fulldata[] = $retourTab; 
				}
			}
		}
		echo "</td>"; 

	}
	$i ++;
}
echo "</tr>";
echo "</table>
</section>";
?>

<section id="FR_table">
<table>

	<tr>
		<th> FR_Id </th>
		<th> FR_desc </th>
	<tr>


<?php
foreach ($objFR as $FRkey => $FRelement) {//élément traduit ou partiellement traduit
	echo "
	<tr> 		
		<td><input type='text' name='FRelement' value = '$FRkey' disabled></td>
		<td>";
	if (gettype($FRelement) != 'array') {
		echo "<input type='text' name='FRelement' value = '$FRelement' >";
	} else {

		foreach ($FRelement as $FRkey2 => $FRsouselement) {
			
			if (gettype($FRkey2) != 'array') {

				if (gettype($FRsouselement) == 'array') {

					foreach ($FRsouselement as $FRkey3 => $FRtext) {
						echo " key3 = ".htmlspecialchars($FRkey3)." : ".htmlspecialchars($FRtext).'';
					}

				} else {

					echo "<input type='text' name='FRelement' value = '".htmlspecialchars($FRkey2) ." =' disabled><textarea value ='".htmlspecialchars($FRsouselement)."'>".htmlspecialchars($FRsouselement)."</textarea>";
				
				}
			}
		}
		echo "</td>";
		
	}
	
}
echo "</tr>";
echo "</table>
</section>";


print_r($fulldata);
?>
</body>
<html>