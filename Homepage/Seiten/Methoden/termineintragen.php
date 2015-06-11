<?php
include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

$kunde = $_POST["kunde"];
$haarlaenge = $_POST["haarlaenge"];
$dienstleistung = $_POST["dienstleistung"];
$dienstleistung2 = $_POST["dienstleistung2"];
$date = $_POST["date"];
$schneiden = $_POST["schneiden"];
// var_dump($_FILES);

if($dienstleistung == Damenservice)
	$dienstleistung = "DS";
elseif ($dienstleistung == Herrenservice)
	$dienstleistung = "HS";
else
	$dlservice = "Keine Auswahl";

if($dienstleistung2 == F�rben)
	$dienstleistung2 = "FA";
elseif ($dienstleistung2 == Str�hnen)
	$dienstleistung2 = "ME";
elseif ($dienstleistung2 == T�nen)
	$dienstleistung2 = "T�";
else
	$dlcoloration = "Keine Auswahl";


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

$mitarbeiter = "1000000000";
$arbeitsplatz = 2;

// var_dump($foto);
// var_dump($fotoname);

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
		
		$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung2, $haarlaenge);
	}
	else 
	{
			$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, NULL, $dienstleistung2, $haarlaenge);
	}
	
	
	
	switch ($dienstleistung2) {
		case "FA":
			$date->modify('+60 minutes');
			break;
		case "ME":
			$date->modify('+90 minutes');
			break;
		case "T�":
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
		
		$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge);
	}
	else
	{
		$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, NULL, $dienstleistung, $haarlaenge);
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
	
		$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung, $haarlaenge);
	}
	else
	{
		$res = false;
		$abf = $db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, NULL, $dienstleistung, $haarlaenge);
		if($abf!=false)$res = mysqli_fetch_row($abf)[0]=="1"?true:false;
		
		if ($abf == false)
			echo "Datenbankfehler: Termin konnte nicht eingetragen werden.";
		elseif ($res == false)
			echo "Termin konnte nicht eingetragen werden.";
		else 
		{
			echo "Ihr Termin wurde Erfolgreich eingetragen.";
			echo "<br><br>";
			echo "Termindetails:";
			echo  "<br>";
			echo "Terminbeginn: ".$start->format('d.m.Y H:i')."";
			echo  "<br>";
// 			echo "Vorraussichtliches Terminende: $zeit";
// 			echo  "<br>";
			echo "Service: $dienstleistung";
			echo  "<br>";
			echo "Coloration: $dienstleistung2";
			echo  "<br>";
			echo "Haarlaenge: $haarlaenge";;
		}
	}
}
// $zeit= $date->format('Y-m-d H:i:s');
// // echo $zeit;
// if ($dienstleistung != "Null" && $dienstleistung2 != "Null")
// {
// 	if (isset ($fotoname))
// 		{
// 		$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
// 		try
// 		{
// 			file_upload($fotoname, $foto, $target);
// 		}
// 		catch(DB_Exception $e)
// 		{
// 			echo "Fehler bei Bilderupload";
// 		}
// 		$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;

// 		$db->terminEintragen($date, $mitarbeiter, $arbeitsplatz, $kunde, $foto, $dienstleistung2, $haarlaenge);
// 	}
// 	else
// 	{
// 		$i = 0;
// 		$j = 0;
// 		$p = 0;
// 		while ($i < 1)
// 		{
// 			while ($j < 2)
// 			{
// 				$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', 'NULL', '$dienstleistung2', '$haarlaenge')");
					
// 				if ($j == 1)
// 				{
// 					$date->modify('+45 minutes');
// 					$zeit= $date->format('Y-m-d H:i:s');
// 				}
// 				else
// 				{
// 					$date->modify('+15 minutes');
// 					$zeit= $date->format('Y-m-d H:i:s');
// 				}
// 				$j++;
// 			}
// 			while ($p < 4)
// 			{
// 				$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', 'NULL', '$dienstleistung', '$haarlaenge')");
// 				$p++;
// 				$date->modify('+15 minutes');
// 				$zeit= $date->format('Y-m-d H:i:s');
// 			}
// 			$zeit= $date->format('d.m.Y  H:i');
// 			echo "Ihr Termin wurde Erfolgreich eingetragen.";
// 			echo "<br><br>";
// 			echo "Termindetails:";
// 			echo  "<br>";
// 			echo "Terminbeginn: ".$start->format('d.m.Y H:i')."";
// 			echo  "<br>";
// 			echo "Vorraussichtliches Terminende: $zeit";
// 			echo  "<br>";
// 			echo "Service: $dienstleistung";
// 			echo  "<br>";
// 			echo "Coloration: $dienstleistung2";
// 			echo  "<br>";
// 			echo "Haarlaenge: $haarlaenge";
// 			$i++;
// 		}
// 	}



// 	switch ($dienstleistung2) {
// 		case "FA":
// 			$date->modify('+60 minutes');
// 			break;
// 		case "ME":
// 			$date->modify('+90 minutes');
// 			break;
// 		case "T�":
// 			$date->modify('+60 minutes');
// 			break;
// 	}

// // 		echo $date->format("d.m.Y H:i");

// 	if (isset ($fotoname))
// 	{
// 		$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
// 		try
// 		{
// 			file_upload($fotoname, $foto, $target);
// 		}
// 		catch(DB_Exception $e)
// 		{
// 			echo "Fehler bei Bilderupload";
// 		}
// 		$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;

// 		$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', '$foto', '$dienstleistung', '$haarlaenge')");
// 	}
// 	else
// 		{
// 		$i = 0;
// 		$j = 0;
// 		$p = 0;
// 		while ($i < 1)
// 		{	
// 			while ($j < 2)
// 			{
// 				$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', 'NULL', '$dienstleistung2', '$haarlaenge')");
			
// 				if ($j == 1)
// 				{
// 					$date->modify('+45 minutes');
// 					$zeit= $date->format('Y-m-d H:i:s');
// 				}
// 				else
// 				{
// 					$date->modify('+15 minutes');
// 					$zeit= $date->format('Y-m-d H:i:s');
// 				}
// 				$j++;
// 			}
// 			while ($p < 4)
// 			{
// 				$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', 'NULL', '$dienstleistung', '$haarlaenge')");
// 				$p++;
// 				$zeit= $date->format('Y-m-d H:i:s');
// 			}
// 			$i++;
// 		}
// 	}
// }
// else
// 	{
// 	if (isset ($fotoname))
// 		{
// 		$target = NK_Pfad_Frisur_Bildupload_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;
// 		try
// 		{
// 			file_upload($fotoname, $foto, $target);
// 		}
// 		catch(DB_Exception $e)
// 		{
// 			echo "Fehler bei Bilderupload";
// 		}
// 		$foto = NK_Pfad_Frisur_Bild_beginn.$mitarbeiter.NK_Pfad_Frisur_Bild_mitte.$date->format('U').NK_Pfad_Frisur_Bild_ende;

// 		$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', '$foto', '$dienstleistung', '$haarlaenge')");
// 	}
// 	else
// 		{
// 		$db->query("INSERT INTO zeittabelle (Zeitstempel, Mitarbeiter, ArbeitsplatzNr, Kunden_EMail, FrisurwunschFoto, Dienstleistungen_Kuerzel, Dienstleistungen_Haartypen_Kuerzel) VALUES ('$zeit', '$mitarbeiter', '$arbeitsplatz', '$kunde', 'NULL', '$dienstleistung', '$haarlaenge')");
// 	}
// }
 
?>