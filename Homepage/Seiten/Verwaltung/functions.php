<?php
include("../../include_DBA.php");

	function maAnlegen($svnr,$vn,$nn,$passwort,$pw2)
	{
		$db=new db_con("conf/db.php",true);
		if($svnr !=null &&$vn !=null &&$nn !=null &&$passwort !=null){
			
				if($db->getMitarbeiter($svnr))
			{
				return "User existiert schon!";
			}
			else{
				if($passwort != $pw2) {
					return "Passwort stimmen nicht &Uuml;berein";
				}
				else {
					$passwort = md5($passwort);	
					$mitarbeiter=new Mitarbeiter($svnr,$vn,$nn,array(),false,array(),array());
					$db->mitarbeiterEintragen($mitarbeiter);
					$db->mitarbeiterPwUpdaten($mitarbeiter,$passwort);					
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				}
			}
		}	
	}
	
	function maUpdate($svnr, $vn, $nn, $skills, $admin, $urlaube, $dienstzeiten)
	{
		if($svnr != null){
	
	
			$mitarbeiter=new Mitarbeiter($svnr, $vn, $nn, $skills, $admin, $urlaube, $dienstzeiten);
			$db->mitarbeiterUpdaten($mitarbeiter);
	
			return true;
		}
		else
			return false;
	}
	function kuUpdate($email, $vn, $nn, $telNr, $freischalten, $foto, $interessen)
	{
		if($email != null){
	
	
			$kunde=new Mitarbeiter($email, $vn, $nn, $telNr, $freischalten, $foto, $interessen);
			$db->kundeUpdaten($kunde);
	
			return true;
		}
		else
			return false;
	}
?>
