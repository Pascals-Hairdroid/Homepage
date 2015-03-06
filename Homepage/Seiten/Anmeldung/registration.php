<?php
include("../include_DBA.php");
  
	function reg($email,$vn,$nn,$passwort,$pw2,$telnr)
	{
		$db=new db_con("conf/db.php",true);
		if($email !=null &&$vn !=null &&$nn !=null &&$telnr !=null &&$passwort !=null){
			
				if($db->getKunde($email))
			{
				return "User existiert schon!";
			}
			else{
				if($passwort != $pw2) {
					return "Passwort stimmen nicht &Uuml;berein";
				}
				else {
					$passwort = md5($passwort);	
					$kunde=new Kunde($email,$vn,$nn,$telnr,false,NULL,array());
					$db->kundeEintragen($kunde);
					$db->kundePwUpdaten($kunde,$passwort);					
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				}
			}
		}	
	}
?>