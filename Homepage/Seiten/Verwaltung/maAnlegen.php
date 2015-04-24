<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php
include("../../include_DBA.php");
function maAnlegen($svnr,$vn,$nn,$passwort,$pw2)
	{
		$db=new db_con("conf/db.php",true, "utf8");
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
					$mitarbeiter=new Mitarbeiter($svnr,$vn,$nn,array(),true,array(),array());
					$db->mitarbeiterEintragen($mitarbeiter);
					$db->mitarbeiterPwUpdaten($mitarbeiter,$passwort);					
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				}
			}
		}	
	}
if(isset($_POST['submit']))
	$erg=maAnlegen($_POST['svnr'],$_POST['vn'],$_POST['nn'],$_POST['pw'],$_POST['pw2']);
?>

	<div id="container">
<div class ="hide" id="streifen"></div><div id="main">
			<div id="Loginbox" class="hide">
					<nav>
						<ul>
						<?php
						if(!isset($_SESSION['username'])){
							echo"<li id='login'>";
								echo"<a id='login-trigger' href='#'>Log in <span>&#x25BC;</span></a>";
								echo"<div id='login-content'>";
									echo"<form method='post' action=''>";
										echo"<fieldset id='inputs'>";
											echo"<input id='username' type='text' name='username' placeholder='Username' required>";   
											echo"<input id='password' type='password' name='passwort' placeholder='Passwort' required>";
										echo"</fieldset>";
										echo"<fieldset id='actions'>";
											echo"<input type='submit' name ='submit' id='submit' value='Log in'>";
											echo"<label><a href='#'> Forgot Password </a></label>";
										echo"</fieldset>";
									echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='../Anmeldung/endSession.php'>Log Out</span></a>";
									echo"<div id='login-content'>";
										
								}
									
									?>
								</div>                     
							</li>
							<?php
							if(isset($_SESSION['username'])){
							echo"<li "; 
							if($_SESSION['admin']==false)
							echo"id='signup'";
							else
							echo"id='element'";	
							echo"><a href='../Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='../../index.php'>Homepage</a></li>";
							}
													
							
							}
							else{
								echo"<li id='signup'>";
								echo"<a href='../registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>
							
						</ul>
					</nav>
			</div>					
			<div id="head">
				<h1>PASCALS<img src="../../Bilder/Homepage/Logo.png">HAIRSTYLE</h1>
				<h2>Frisuren zum Wohlf&uuml;hlen</h2>		
		
			</div>
			<div id="hmenu">		
					<nav id="menu" class="hide">
							<ul>
<li  class="items">
									<a href="">Mitarbeiter</a>
									<ul>
										<li><a href="maAnlegen.php">anlegen</a></li>
										<li ><a href="maBearbeiten.php">bearbeiten</a></li>
										<li ><a href="zeiten.php">Dienstzeiten</a></li>
										<li ><a href="urlaub.php">Urlaub</a></li>
									</ul>
								</li>
								<li class="items"><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
								<li class="items">
									<a href="">Termine</a>
									<ul>
										<li><a href="terminAnzeigen.php">anzeigen</a></li>
										<li><a href="terminBearbeiten.php">bearbeiten</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Notifications</a>
									<ul>
										<li><a href="notificationerstellen.php">erstellen</a></li>
										<li><a href="notification.php">bearbeiten</a></li>
									</ul>
								</li>								<li class="spacer"></li>
							</ul>
						</nav>

			</div>
			
			
			<div id="textArea">
			<table border="0">
						<form method="post" action="">
							<tr><td>Sozialversicherungsnummer:</td><td><input name="svnr" type="input" class=loginField"required = "required"
							<?php if(isset($erg))echo "value='".$_POST['svnr']."'"; ?>></p></td></tr>
							
							<tr><td>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php if(isset($erg))echo "value='".$_POST['vn']."'"; ?>></p></td></tr>
							
							<tr><td>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php if(isset($erg))echo "value='".$_POST['nn']."'"; ?>></p></td></tr>
							
							<tr><td><p>Passwort:</p></td><td><input  name="pw" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td><p>Password wiederholen:</p></td><td><input name="pw2" type="password"  class="loginField"required = "required"></p></td></tr>
											
							<tr><td><input type="submit" value ="absenden" name="submit"></td>
							
						</form>
					</table>
					<?php
					if (isset($erg))
						echo $erg;
					?>
			</div>
			<div id="footer">
</div>
</div>		</div>	
</body>
</html>