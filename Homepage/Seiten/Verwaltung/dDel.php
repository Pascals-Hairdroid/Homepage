<?php 
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$wochentag=$db->getWochentag($_GET['tag']);
$dienstzeit=new Dienstzeit($wochentag,DateTime::createFromFormat('H:i',$_GET['von']),DateTime::createFromFormat('H:i',$_GET['bis']));
$mitarbeiter= $db->getMitarbeiter($_GET['svnr']);
$db->dienstzeitEntfernen($dienstzeit, $mitarbeiter);
header('Location: zeiten.php');
exit(0);
?>
