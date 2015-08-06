<?php
include_once(dirname(__FILE__)."/login.php");
include_once(dirname(__FILE__)."/../../PHD_DBA/conf/dba_const.php");
$db = new DB_Con(DB_DEFAULT_CONF_FILE, true);
if(isset($_GET[DBA_SESSION_ID])){
	session_start($_GET[DBA_SESSION_ID]);
	try{
		$susr = $db->getKundeMailBySessionId($_GET[DBA_SESSION_ID]);
		$abf = $db->selectQuery(DB_TB_KUNDEN, DB_F_KUNDEN_PASSWORT, DB_F_KUNDEN_PK_EMAIL."=\"".$db->escape_string($susr)."\"");
		if($abf==false)
			throw new DB_Exception(404, "Kein Eintrag zu Session-ID gefunden. ID: ".$_GET[DBA_SESSION_ID], DB_ERR_VIEW_SESSION_NOT_FOUND);
		$row = mysqli_fetch_assoc($abf);
		if(!login($susr, $row[DB_F_KUNDEN_PASSWORT]))
			throw new DB_Exception(401, "Login fehlgeschlagen!", DB_ERR_VIEW_BAD_LOGIN);
	}catch(Exception $e){}
}
?>