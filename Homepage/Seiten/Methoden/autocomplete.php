<?php
//Datenbank Klasse holen
include_once("../../include_DBA.php");

//Wenn in Suchfeld eingegeben wird ist term gesetzt
if(isset($_GET['term'])){
	//DB verbinden und wählen
	$db=new db_con("conf/db.php",true);
	$terms = $_GET["term"];
	//Alle Kunden die in den Filter passen holen
	$kunden = $db->getKundenFilter($terms);
	echo json_encode($kunden);
}

?>

