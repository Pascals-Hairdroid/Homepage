<?php
include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

$haarlaenge = $_POST["haarlaenge"];
$dienstleistung = $_POST["dienstleistung"];
$dienstleistung2 = $_POST["dienstleistung2"];
$date = $_POST["date"];
$schneiden = $_POST["schneiden"];

// var_dump($_FILES);


if (isset($_FILES["wunschfoto"])&& $_FILES["wunschfoto"]["tmp_name"] != "")
{
	$foto = $_FILES["wunschfoto"]["tmp_name"];
	$fotoname = $_FILES["wunschfoto"]["name"];
	echo "ging du hua";
}
// else
// {
// 	$foto = NULL;
// 	$fotoname = NULL;
// }

$date = new DateTime($date);

$mitarbeiter = "1000000000";
$arbeitsplatz = 2;
$kunde = "f.ghadimi@gmx.at";

// var_dump($foto);
// var_dump($fotoname);

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

?>