<?php
include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true, "utf8");
//$db2=new db_con("conf/db.php",true,"utf8");

$kunde = $_POST["kunde"];
$haarlaenge = $_POST["haarlaenge"];
$dienstleistung = $_POST["dienstleistung"];
$dienstleistung2 = $_POST["dienstleistung2"];
$date = $_POST["date"];
$schneiden = $_POST["schneiden"];
$alleArbeiter = $_POST["mitarbeiter"];
$alleArbeitsplaetze = $_POST["arbeitsplatz"];
// var_dump($_FILES);

// var_dump($kunde);
// var_dump($haarlaenge);
// var_dump($dienstleistung);
// var_dump($dienstleistung2);

// var_dump("Haare: ", $haarlaenge);
// echo "\n\n\n\n\n";
// var_dump("DL1: ", $dienstleistung);
// echo "\n\n\n\n\n";
// var_dump("DL2: ", $dienstleistung2);


echo "<br> <br>";



// if (isset($dienstleistung2))
// {
// 	if($dienstleistung2 != "" && $haarlaenge = "")
// 	{
// 		$dlcoloration = umlaute_encode($db->getDienstleistung($dienstleistung2, new Haartyp($haarlaenge, null))->getName());
// 	}
// 	else
// 		$dlcoloration = "Keine Auswahl";
// }


if (isset($_FILES["wunschfoto"])&& $_FILES["wunschfoto"]["tmp_name"] != "")
{
	$foto = $_FILES["wunschfoto"]["tmp_name"];
	$fotoname = $_FILES["wunschfoto"]["name"];
}

$date = new DateTime($date);
$start = clone ($date);

// $mitarbeiter = "1713270187";
// $arbeitsplatz = 2;

// var_dump($foto);
// var_dump($fotoname);

$a = 0;
$z1 = 0;
$z2 = 0;
$plätze = array();
$hackler = array();

$plätze = explode(", ", $alleArbeitsplaetze);
$hackler = explode(", ", $alleArbeiter);

//var_dump($alleArbeitsplaetze, $alleArbeiter);

$date2 = clone $date;
switch ($dienstleistung2) {
	case "FA":
		$date2->modify('+60 minutes');
		break;
	case "ME":
		$date2->modify('+90 minutes');
		break;
	case "TÖ":
		$date2->modify('+60 minutes');
		break;
}

// var_dump ($plätze, $hackler);
$done=false;
//var_dump($hackler, $plätze);
while ($z1 < count($hackler) && !$done)
{
	$mitarbeiter = $hackler[$z1];
// 	echo "<h1> ".var_dump($mitarbeiter)." </h1>";
	$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
	$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
	
	while ($z2 < count($plätze) && !$done)
	{
		$arbeitsplatz = $plätze[$z2];
// 		var_dump($arbeitsplatz);
		
		if ($dienstleistung != "" && $dienstleistung2 != "")
		{
			//echo "a";
			if (isset ($fotoname))
			{
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, utf8_encode($dienstleistung2), $haarlaenge))[0];
				$a = $a=="1"?mysqli_fetch_row($db->terminEintragen($date2, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge))[0]:$a;
			}
			else 
			{
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, Null, utf8_encode($dienstleistung2), $haarlaenge))[0];
				$a = $a=="1"?mysqli_fetch_row($db->terminEintragen($date2, $mitarbeiter, $arbeitsplatz, $kunde, NULL, $dienstleistung, $haarlaenge))[0]:$a;
 			}
		}
		else 
		{
			//var_dump($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge);
			//echo "b";
			if (isset ($fotoname))
			{
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge))[0];
// 				var_dump($a);
// 				if ($a=="1")
// 					echo "Ihr Termin wurde erfolgreich eingetragen.";
// 				else 
// 					echo "Fehler beim eintragen des Termins.";
			}
			else
			{
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, Null, $dienstleistung, $haarlaenge))[0];
			}
		}
		$z2++;
		if($a=="1")
			$done=true;
// 		var_dump($arbeitsplatz, $mitarbeiter);
	}
	$z2 = 0;
	$z1++;
}
	if ($a == false)
		echo "Datenbankfehler: Termin konnte nicht eingetragen werden.<br/>\n";
	if ($a=="1"){

		try
		{
			if (isset ($fotoname))
				file_upload($fotoname, $foto, $target);
			echo "Ihr Termin wurde erfolgreich eingetragen.";
		}
		catch(DB_Exception $e)
		{
			echo "Fehler bei Bilderupload";
		}
	}
	else
		echo "Fehler beim eintragen des Termins.";

?>