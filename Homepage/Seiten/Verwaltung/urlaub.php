<?php 
include("../../include_DBA.php");
include("../Anmeldung/authMitarbeiterAdmin.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php

function urlaubEintragen($svnr,$von,$bis)
	{
		$db=new db_con("conf/db.php",true);
		if($svnr !=null &&$von !=null &&$bis !=null){
			$von2 = new DateTime($von);
			$bis2 = new DateTime($bis);
			$mitarbeiter=$db->getMitarbeiter($svnr);
			$urlaub=new Urlaub($von2, $bis2);
			
				
					
					$db->urlaubEintragen($urlaub, $mitarbeiter);
				
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				
			
		}	
	}
if(isset($_POST['submit']))
	$erg=urlaubEintragen($_POST['svnr'],$_POST['von'],$_POST['bis']);
?>

	<div id="container">
<div class ="hide" id="streifen"></div><div id="main">
			<div id="Loginbox" class="hide">
					<nav>
						<ul>
						<?php
						if(!isset($_SESSION['username'])){
							echo"<li id='login'>";
								echo"<a id='login-trigger' href='#'>Login <span>&#x25BC;</span></a>";
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
									echo"<a href='../Anmeldung/endSession.php'>Logout</span></a>";
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
						<br>
			
						<form method="post" action="">
							<p>Mitarbeiter:
							<select name="svnr" onChange="settext(this.value)"></p>
							
							<?php 
							$db=new db_con("conf/db.php",true, "utf8");
							$Mitarbeiterarray=$db->getAllMitarbeiter();
							
							foreach ($Mitarbeiterarray as $ma){
							if(isset($_POST['svnr']))
							{
								if($ma->getSVNR()==$_POST['svnr'])
									$check=selected;
								else 
									$check=null;
							}

							echo "<option value='".$ma->getSVNR()."'".$check.">".$ma->getVorname()." ".$ma->getNachname().
							"</option>";
							}
							
							  		
							?>
							</select>
							<p>Von:<input type='text' name='von'></input>
							Bis:<input type='text' name='bis'></input></p>	
							<input type="submit" value ="absenden" name="submit">
							<input type="submit" value ="Urlaube anzeigen" name="submit2">
							
						</form>
					
					<?php 
					if(isset($_POST['submit2'])){
					$tempMa=$db->getMitarbeiter($_POST['svnr']);
					$urlaub=$tempMa->getUrlaube();
					foreach ($urlaub as $u2){
					echo "<<br>";
					echo "Urlaub von: ";
					echo $u2->getBeginn()->format('d.F Y H:i');
					echo " bis ";
					echo $u2->getEnde()->format('d.F Y H:i');
					}
					
					
					}?>
					
					
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