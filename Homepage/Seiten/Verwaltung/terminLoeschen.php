<?php

include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true, "utf8");
//$db2=new db_con("conf/db.php",true,"utf8");


$id=isset($_GET["id"])?$_GET["id"]:"";
$wann=isset($_GET["wann"])?$_GET["wann"]:"";
$platz=isset($_GET["platz"])?$_GET["platz"]:"";
$kunde=isset($_GET["kunde"])?$_GET["kunde"]:"";
$mitarbeiter=isset($_GET["mitarbeiter"])?$_GET["mitarbeiter"]:"";

// var_dump("kunde oder mitarbeiter", $mitarbeiter, $kunde);

$timestamp = new DateTime($wann);

// echo $id;
echo "Der Termin am: ";
echo $timestamp->format('d.m.Y H:i');
if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
{
	echo " von dem Kunden: ";
	echo $kunde;
}
else {
	echo " von dem Mitarbeiter: ";
	echo $mitarbeiter;
}
echo " wurde erfolgreich gel&ouml;scht.";
// echo $platz;
if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
	$t= $db->terminDelete($timestamp, $kunde, $platz);
else 	
	$t= $db->terminDeleteMitarbeiter($timestamp, $mitarbeiter, $platz);
// var_dump($t);





?>