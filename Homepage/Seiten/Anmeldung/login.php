<?php
	include_once(dirname(__FILE__)."\"../../../include_DBA.php");	
	

	function login($username,$passwort){
		$db=new DB_CON("conf/db.php",true, "utf8");
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(!isset($_SESSION)) 
      session_start();
	$abf = false;
		//Mitarbeiterlogin
			IF(is_numeric($username)){	
							
					$Mitarbeiter=$db->getMitarbeiter($username);
						if (is_null($Mitarbeiter)){
							return false;	
						}
					$abf=$db->authentifiziereMitarbeiter($Mitarbeiter,$passwort);
					$name= $Mitarbeiter->getVorname();
					
				

		// Benutzername und Passwort werden überprüft
				if ($abf) {
					$_SESSION['angemeldet'] = true;
					$_SESSION['admin'] = true;
					$_SESSION['mAdmin']= $Mitarbeiter->getAdmin();
					$_SESSION['username'] = $name;
					$_SESSION['svnr'] = $username;

					return true;
				}
	   
			}
	   
	   //Kundenlogin
			elseif($username != null and $passwort != null){

					$kunde=$db->getKunde($username);
					if (is_null($kunde)){						
						return false;
					}	
					$abf=$db->authentifiziereKunde($kunde,$passwort);
					$name= $kunde->getVorname();
					
				
					
				}
		
	  // Benutzername und Passwort werden überprüft
				if ($abf) {
					$_SESSION['angemeldet'] = true;
					$_SESSION['admin'] = false;
					$_SESSION['freigeschaltet']= $kunde->getFreischaltung();
					$_SESSION['username'] = $name;
					$_SESSION['email']=$username;
					return true;
				}
			}	
			else{
				return false;
			}
	   
    }
	
?>