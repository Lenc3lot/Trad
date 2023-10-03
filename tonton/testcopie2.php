<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Onglet Trad</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="./style2.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="./script.js"></script>
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
$MonTab = [];
$anothertab = [];

$i = 0;

?> 

<section id="ZoneSelect">

	<!--#####################################-->
	<!-- SECTION DE SELECTION / CONFIRMATION -->
	<!--#####################################-->

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
	<br>
	<br>
	<br>

	<button><a href="./test.json" download>Télécharger</a></button>

	<?php 

	// print_r($objFR);
	
	

	?>

</section>

<section id= "EN_table">

<table>

	<tr>
		<th> EN_Id </th>
		<th> EN_desc </th>
	<tr>


<?php


###############################
# ELEMENT ORIGINAL EN ANGLAIS # 
###############################


foreach ($obj as $key => $element) { //élément non traduit
	echo "
	<tr> 		
		<td>".$key."</td>
		<td>";
	$soustab[$key]= [];

		
	if (gettype($element) != 'array') {
		echo $element;
	} else {

		foreach ($element as $key2 => $souselement) {
			echo htmlspecialchars($key2) . " : ";
			
			if (gettype($key2) != 'array') {

				if (gettype($souselement) == 'array') {

					foreach ($souselement as $key3 => $text) {
						echo " key3 = ".htmlspecialchars($key3)." : ".htmlspecialchars($text).'';
					}

				} else {

					echo htmlspecialchars($key2) ." : ".htmlspecialchars($souselement)." </br>";
					$anothertab[$key2] = $souselement;
					//print_r($anothertab);
					

				}
			}
		}
		echo "</td>"; 

	}
	$soustab[$key] = $anothertab;
	$i ++;
}
$MonTab[]=$soustab;
echo "</tr>";
echo "</table>
</section>";
?>

<section id="FR_table">
	<form name = "monForm" action="./CopierDonnee.php" method="post">
<table>

	<tr>
		<th> FR_Id </th>
		<th> FR_desc </th>
	<tr>


<?php


###############################
# ELEMENT TRADUIT EN FRANCAIS # 
###############################


foreach ($objFR as $FRkey => $FRelement) {//élément traduit ou partiellement traduit
	echo "
	<tr> 		
		<td>
			<input type='text' value = '$FRkey' disabled>
			<input type='text' id='$FRkey' value = '$FRkey' hidden>
		</td>
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

					echo "<input type='text' id='FRelementINTIT' value = '".htmlspecialchars($FRkey2) ." =' onchange='Test()'><textarea id ='FR_desc' value ='".htmlspecialchars($FRsouselement)."' onchange='Test()'>".htmlspecialchars($FRsouselement)."</textarea>";
				
				}
			}
		}
		echo "</td>";
		
	}
	
}
echo "</tr>";
echo "</table>
</section>"; 

// echo(json_encode($MonTab));
file_put_contents("./test.json",json_encode($MonTab));

$srch = "DefaultAttunement";

?>
<input type="submit">
</form>
</body>
<html>

