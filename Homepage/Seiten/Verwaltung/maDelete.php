<?php 
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$ma=$db->getMitarbeiter($_GET['SVNr']);
$db->mitarbeiterPwUpdaten($ma, Null);
header('Location: maBearbeiten.php');
exit(0);
?>
