<?php 
include("../../include_DBA.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="refresh" content="10;url=maBearbeiten.php" />
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php

function pwReset($svnr)
{
	if($svnr != null){
		$db=new db_con("conf/db.php",true);
		$ma=$db->getMitarbeiter($svnr);
		$db->mitarbeiterPwUpdaten($ma,md5('pascalshairdroid'));	
		return true;
	}
	else
		return false;
}		
?>

</body>
</html>