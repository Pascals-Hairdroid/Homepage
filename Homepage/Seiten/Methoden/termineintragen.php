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
echo "Haarlänge: ".$haarlaenge."";
echo "<br />";
switch ($dienstleistung2)
{
	case "FA":
		$dienstleistung2="Färben";
		break;
	case "ME":
		$dienstleistung2="Strähnen";
		break;
	case "TÖ":
		$dienstleistung2="Tönung";
		break;
	case "OKME":
		$dienstleistung2="Oberkopf Strähnen";
		break;
}
echo "Colorierung: ".$dienstleistung2."";
echo "<br />";
echo "Datum: ".$date."";



?>