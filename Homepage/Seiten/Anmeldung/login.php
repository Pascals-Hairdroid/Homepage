<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include_once("../../include_DBA.php");	
	$db=new DB_CON("conf/db.php",true);

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['username'];
      $passwort = $_POST['passwort'];
	  
			
		//Mitarbeiterlogin
			IF(is_numeric($username)){
			$passwort = md5($_POST['passwort']);				
				try{
					$Mitarbeiter=$db->getMitarbeiter($username);
						if (is_null($Mitarbeiter)){
							header('Location:../anmelden.php');		
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

					header('Location:../../index.php');
					exit;
				}
	   
			}
	   
	   //Kundenlogin
			elseif($username != null and $passwort != null){
			$passwort = md5($_POST['passwort']);				
				try{
					$kunde=$db->getKunde($username);
					if (is_null($kunde)){	
						header('Location:../anmelden.php');
					}
					$abf=$db->authentifiziereKunde($kunde,$passwort);
					$name= $kunde->getVorname();
					}
				catch(Exception $e){
					$abf=false;
				}
		
	  // Benutzername und Passwort werden überprüft
				if ($abf) {
					$_SESSION['angemeldet'] = true;
					$_SESSION['admin'] = false;
					$_SESSION['username'] = $name;
	  
					header('Location:../../index.php');
					exit;
				}
			}	
			else{
				echo"<meta http-equiv='refresh' content='0; url=../anmelden.php' />";
			}
	   
    }
?>
</body>
</html>