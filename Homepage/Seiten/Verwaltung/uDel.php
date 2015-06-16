<?php 
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$db->urlaubEntfernen(new Urlaub(DateTime::createFromFormat('d.F Y H:i',$_GET['von']),DateTime::createFromFormat('d.F Y H:i',$_GET['bis'])), $db->getMitarbeiter($_GET['svnr']));
header('Location: urlaub.php');
exit(0);
?>
