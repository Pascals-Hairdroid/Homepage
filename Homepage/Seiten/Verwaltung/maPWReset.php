<?php 
include("../../include_DBA.php");

function pwReset($svnr)
{
	if($svnr != null){
		$db=new db_con("conf/db.php",true);
		$ma=$db->getMitarbeiter($svnr);
		$db->mitarbeiterPwUpdaten($ma,md5('pascalshairdroid'));	
		return "Passwort wurde ge&auml;ndert!";
	}
	else
		return "Passwort wurde nicht ge&auml;ndert!";
}		

?>
