<?php
	include_once(dirname(__FILE__)."\"../../../include_DBA.php");	
	

	function login($username,$passwort){
		$db=new DB_CON("conf/db.php",true);
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(!isset($_SESSION)) 
      session_start();
	
		//Mitarbeiterlogin
			IF(is_numeric($username)){
				echo "testMA";
			$passwort = md5($_POST['passwort']);				
				try{
					$Mitarbeiter=$db->getMitarbeiter($username);
						if (is_null($Mitarbeiter)){
							return false;	
						}
					$abf=$db->authentifiziereMitarbeiter($Mitarbeiter,$passwort);
					$name= $Mitarbeiter->getVorname();
					}
				catch(Exception $e){
					$abf=false;
				}

		// Benutzername und Passwort werden überprüft
				if ($abf) {
					$_SESSION['angemeldet'] = true;
					$_SESSION['admin'] = true;
					$_SESSION['username'] = $name;

					return true;
				}
	   
			}
	   
	   //Kundenlogin
			elseif($username != null and $passwort != null){
								
				
			$passwort = md5($_POST['passwort']);
			
				
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
					$_SESSION['username'] = $name;
					return true;
				}
			}	
			else{
				echo "testFALSE";
				return false;
			}
	   
    }
	
?>