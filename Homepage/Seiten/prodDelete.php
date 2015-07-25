<?php 
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);
$produkt=$db->getProdukt($_GET['id']);
$kat=$_GET['kat'];
$db->produktEntfernen($produkt);
unlink('../Bilder/Produkte/ESTELProdukte/'.$_GET['id'].'.jpg');
header('Location: Produkte.php?Kat='.$kat.'');
exit(0);
?>
