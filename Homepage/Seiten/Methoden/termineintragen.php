<?php
include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true, "utf8");
$db2=new db_con("conf/db.php",true,"utf8");

$kunde = $_POST["kunde"];
$haarlaenge = $_POST["haarlaenge"];
$dienstleistung = $_POST["dienstleistung"];
$dienstleistung2 = $_POST["dienstleistung2"];
$date = $_POST["date"];
$schneiden = $_POST["schneiden"];
// var_dump($_FILES);

var_dump($kunde);
var_dump($haarlaenge);
var_dump($dienstleistung);
var_dump($dienstleistung2);
echo "<br> <br>";


if (isset($dienstleistung2))
{
	if($dienstleistung2 != "Null")
	{
		$dlcoloration = umlaute_encode($db->getDienstleistung($dienstleistung2, new Haartyp($haarlaenge, null))->getName());
	}
	else
		$dlcoloration = "Keine Auswahl";
}


if ($haarlaenge == "Kurze Haare")
	$haarlaenge = "KH";
else
	$haarlaenge = "LH";


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
$i = 0;
$z1 = 0;
$z2 = 0;
$plätze = array(1,2,3,4,5,6);
$hackler = array("1713270187","3071240769","1662120287");
while ($a == 0 && $i < 18)
{
	$mitarbeiter = $hackler[$z1];
	echo "<h1> ".var_dump($mitarbeiter)." </h1>";
	while ($a == 0 && $z2 < 6)
	{
		$arbeitsplatz = $plätze[$z2];
		if ($dienstleistung != "Null" && $dienstleistung2 != "Null")
		{
			if (isset ($fotoname))
			{
				$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
				try
				{
					file_upload($fotoname, $foto, $target);
				}
				catch(DB_Exception $e)
				{
					echo "Fehler bei Bilderupload";
				}
				$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
				
				$a = mysqli_fetch_row($db2->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, utf8_encode($dienstleistung2), $haarlaenge))[0];
				var_dump($a);
		// 		if ($a=="1")
		// 			echo "Ihr Termin wurde erfolgreich eingetragen.";
		// 		else
		// 			echo "Fehler beim eintragen des Termins.";
			}
			else 
			{
					$a = mysqli_fetch_row($db2->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, Null, utf8_encode($dienstleistung2), $haarlaenge))[0];
					var_dump($a);
		// 			if ($a=="1")
		// 				echo "Ihr Termin wurde erfolgreich eingetragen.";
		// 			else
		// 				echo "Fehler beim eintragen des Termins.";
			}
			
			
			
			switch ($dienstleistung2) {
				case "FA":
					$date->modify('+60 minutes');
					break;
				case "ME":
					$date->modify('+90 minutes');
					break;
				case "TÖ":
					$date->modify('+60 minutes');
					break;
			}
			
		// 		echo $date->format("d.m.Y H:i");
			
			if (isset ($fotoname))
			{
				$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
				try
				{
					file_upload($fotoname, $foto, $target);
				}
				catch(DB_Exception $e)
				{
					echo "Fehler bei Bilderupload";
				}
				$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
				
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge))[0];
				var_dump($a);
// 				if ($a=="1")
// 			echo "Ihr Termin wurde erfolgreich eingetragen.";
// 				else 
// 					echo "Fehler beim eintragen des Termins.";
			}
			else
			{
				$a = mysqli_fetch_row($db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, NULL, $dienstleistung, $haarlaenge))[0];
// 				if ($a=="1")
// 					echo "Ihr Termin wurde erfolgreich eingetragen.";
// 				else 
// 					echo "Fehler beim eintragen des Termins.";
			}
		}
		else 
		{
			if (isset ($fotoname))
			{
				$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
				try
				{
					file_upload($fotoname, $foto, $target);
				}
				catch(DB_Exception $e)
				{
					echo "Fehler bei Bilderupload";
				}
				$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
			
				$a = mysqli_fetch_row($db2->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge))[0];
				var_dump($a);
// 				if ($a=="1")
// 					echo "Ihr Termin wurde erfolgreich eingetragen.";
// 				else 
// 					echo "Fehler beim eintragen des Termins.";
			}
			else
			{
				$res = false;
				$a = mysqli_fetch_row($db2->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge))[0];
				var_dump($a);
// 				if ($a=="1")
// 					echo "Ihr Termin wurde erfolgreich eingetragen.";
// 				else 
// 					echo "Fehler beim eintragen des Termins.";
		// 		if($a!=false)$res = mysqli_fetch_row($abf)[0]=="1"?true:false;
				
// 				if ($a == false)
// 					echo "Datenbankfehler: Termin konnte nicht eingetragen werden.";
		// 		elseif ($res == false)
		// 			echo "Termin konnte nicht eingetragen werden.";
		// 		else 
		// 		{
		// 			echo "Ihr Termin wurde Erfolgreich eingetragen.";
		// 			echo "<br><br>";
		// 			echo "Termindetails:";
		// 			echo  "<br>";
		// 			echo "Terminbeginn: ".$start->format('d.m.Y H:i')."";
		// 			echo  "<br>";
		//  			echo "Vorraussichtliches Terminende: $zeit";
		//  			echo  "<br>";
		// 			echo "Service: $dienstleistung";
		// 			echo  "<br>";
		// 			echo "Coloration: $dienstleistung2";
		// 			echo  "<br>";
		// 			echo "Haarlaenge: $haarlaenge";;
		// 		}
			}
		}
		$z2++;
		$i++;
		var_dump($arbeitsplatz, $mitarbeiter);
	}
	$z2 = 0;
	$z1++;
	if ($a == false)
		echo "Datenbankfehler: Termin konnte nicht eingetragen werden.";
	if ($a=="1")
		echo "Ihr Termin wurde erfolgreich eingetragen.";
	else
		echo "Fehler beim eintragen des Termins.";
}
 
?>