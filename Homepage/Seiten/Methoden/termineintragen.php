<?php
$haarlaenge=$_GET["haarlaenge"];
$dienstleistung=$_GET["dienstleistung"];
$dienstleistung2=$_GET["dienstleistung2"];
$date=$_GET["date"];

switch ($dienstleistung)
{
	case "HS":
		$dienstleistung="Herren Service";
		break;
	case "DS":
		$dienstleistung="Damen Service";
		break;

}
echo "Service: ".$dienstleistung."";
echo "<br />";
echo "Haarl�nge: ".$haarlaenge."";
echo "<br />";
switch ($dienstleistung2)
{
	case "FA":
		$dienstleistung2="F�rben";
		break;
	case "ME":
		$dienstleistung2="Str�hnen";
		break;
	case "T�":
		$dienstleistung2="T�nung";
		break;
	case "OKME":
		$dienstleistung2="Oberkopf Str�hnen";
		break;
}
echo "Colorierung: ".$dienstleistung2."";
echo "<br />";
echo "Datum: ".$date."";



?>