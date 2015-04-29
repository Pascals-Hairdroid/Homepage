<?php session_start();
include("../../include_DBA.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php

function zeitEintragen($svnr,$von,$bis,$tag)
	{
		$db=new db_con("conf/db.php",true);
		if($svnr !=null &&$von !=null &&$bis !=null &&$tag !=null){
			$von2 = DateTime::createFromFormat('H:i',$von);
			$bis2 = DateTime::createFromFormat('H:i',$bis);
			$mitarbeiter=$db->getMitarbeiter($svnr);
			$wochentag=$db->getWochentag($tag);
			
				if($db->getDienstzeit($mitarbeiter, $wochentag)){
					$dienstzeit = new Dienstzeit($wochentag, $von2, $bis2);
					$db->dienstzeitUpdaten($dienstzeit, $mitarbeiter);
					}
				else 
				{
					$dienstzeit = new Dienstzeit($wochentag, $von2, $bis2);
					$db->dienstzeitEintragen($dienstzeit, $mitarbeiter);
				}
					
					return 'Erfolgreich registriert!<a href="../index.php">Zum Login</a>';
				
			
		}	
	}
if(isset($_POST['submit']))
	$erg=zeitEintragen($_POST['svnr'],$_POST['von'],$_POST['bis'],$_POST['tag']);
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
			
						<form method="post" action="">
							<p>Mitarbeiter:
							<select name="svnr" onChange="settext(this.value)"></p>
							
							<?php 
							$db=new db_con("conf/db.php",true);
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
							Bis:<input type='text' name='bis'></input>  
							Tag:<select name="tag">
								<option value="MO">Montag</option>
								<option value="DI">Dienstag</option>
								<option value="MI">Mittwoch</option>
								<option value="DO">Donnerstag</option>
								<option value="FR">Freitag</option>
								<option value="SA">Samstag</option>							
							</select></p>		
							<span id="text"></span>		
							<input type="submit" value ="absenden" name="submit">
							<input type="submit" value ="Dienstzeiten anzeigen" name="submit2">
							
						</form>
					
					<?php 
					if(isset($_POST['submit2'])){
					$tempMa=$db->getMitarbeiter($_POST['svnr']);
					$dienstzeit=$tempMa->getDienstzeiten();
					foreach ($dienstzeit as $dz){
					echo $dz->getWochentag()->getKuerzel();
					echo Date_format($dz->getBeginn(),'H:i');
					echo Date_format($dz->getEnde(),'H:i');} 
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