<?php
include("../include_DBA.php");
  
	function reg($email,$vn,$nn,$passwort,$pw2,$telnr)
	{
		$db=new db_con("conf/db.php",true);
		if($email !=null &&$vn !=null &&$nn !=null &&$telnr !=null &&$passwort !=null){
			
			// $einlesen="SELECT * FROM `kunden` WHERE EMail='".$email."'";
			// if(mysqli_num_rows($db->query($einlesen))==1)
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
					$db->kundeEintragen(new Kunde($email,$vn,$nn,$telnr,false,NULL,array()));
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				}
			}
		}	
	}
?>