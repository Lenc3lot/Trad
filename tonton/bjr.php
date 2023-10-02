<!DOCTYPE html>d
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./scripts/style.css">
	<title>Acceuil</title>
</head>

<body style="display :flex">

	<?php require __DIR__ . "/vendor/autoload.php";
	use HJSON\HJSONParser;

	$option = ['keepWsc' => false, 'assoc' => true];


	$data = file_get_contents("./base1311/Mods.CalamityMod.BossChecklistIntegration.hjson");
	$parser = new HJSONParser();
	$obj = $parser->parse($data, $option);
	print_r($obj);

	$dataFR = file_get_contents("./outputFR/fr-FR_Mods.CalamityMod.Attunement.hjson");
	$objFR = $parser->parse($dataFR, $option);

	?>
	<table>
		<tr>
			<th>Original File Name</th>
			<th>Orginial File Desc</th>
		</tr>

		<?php
		foreach ($obj as $element) { ?>
			<tr>

				<td>
					<input type="text" value="<?php echo $element["EntryName"]; ?>" disabled></input>
				</td>
				<td>
					<input type="text" value="<?php echo $element["SpawnInfo"]; ?>" disabled style="width : 150em"></input>
				</td>

			<?php } ?>
		
	</table>

	<table>
		<tr>
			<th>Trad File Name</th>
		</tr>

		<?php foreach ($objFR as $elementFR) { ?>
			<tr>
				<td>
					<input type="text" value="<?php echo $elementFR["Name"]; ?>"></input>	
				</td>
				<td>
					<input type="text" value="<?php echo $elementFR["Function"]; ?>" style="width : 150em"></input>
				</td>
			</tr>
		<?php } ?>
	</table>


</body>

</html>