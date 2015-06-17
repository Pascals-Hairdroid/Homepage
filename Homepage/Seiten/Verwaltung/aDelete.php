<?php 
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

$arbeitsplatz=$db->getArbeitsplatz($_GET['Nr']);
$db->arbeitsplatzEntfernen($arbeitsplatz);
header('Location: arbeitsplatz.php');
exit(0);
?>
