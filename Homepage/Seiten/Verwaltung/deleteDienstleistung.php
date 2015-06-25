<?php 
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$haartyp=$db->getHaartyp($_GET['haartyp']);

$dienstleistung=$db->getDienstleistung($_GET['Krzl'], $haartyp);
$db->dienstleistungEntfernen($dienstleistung);

header('Location: dienstleistungAdd.php?f=1');
exit(0);
?>
