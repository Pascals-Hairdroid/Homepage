<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$arbeitsplatzOld=$db->getArbeitsplatz($_GET['Nr']);

$ausstattung = array();
foreach($db->getAllArbeitsplatzausstattung() as $int){
	if(isset ($_GET[$int->getID()]))
		$int = new Arbeitsplatzausstattung($int->getID(), $int->getName());
	$ausstattung[]=$int;
}
if (isset($_GET['submit']))
{
	$arbeitsplatz=new Arbeitsplatz($arbeitsplatzOld->getNummer(), $_GET['name'], $ausstattung);
	$db->arbeitsplatzUpdaten($arbeitsplatz);
	header('Location: arbeitsplatz.php');
	exit(0);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>

<div id="container">
	<div class ="hide" id="streifen"></div>
<div id="main">
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
					<?php 
				include ("../HTML/Verwaltungheader.html"); 
				?>	
			
				</div>
				<div id="hmenu">		
					<nav id="menu" class="hide">
							<ul>
								<li  class="items">
									<a href=""  class="selected">Personenverwaltung</a>
									<ul>
										<li><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
										<li ><a href="maBearbeiten.php">Mitarbeiter bearbeiten</a></li>
										<li ><a href="zeiten.php">Dienstzeiten</a></li>
										<li ><a href="urlaub.php">Urlaube</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Studioverwaltung</a>
									<ul>
										<li><a href="produktAdd.php">Produkte hinzuf&uuml;gen</a></li>
										<li><a href="dienstleistungAdd.php">Dienstleistungen bearbeiten</a></li>
										<li><a href="arbeitsplatz.php">Arbeitspl&auml;tze bearbeiten</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Terminverwaltung</a>
									<ul>
										<li><a href="terminAnzeigen.php">anzeigen</a></li>
										<li><a href="terminBearbeiten.php">bearbeiten</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Benachrichtigungen</a>
									<ul>
										<li><a href="notificationerstellen.php">erstellen</a></li>
										<li><a href="notification.php">bearbeiten</a></li>
									</ul>
								</li>
								<li class="spacer"></li>
							</ul>
						</nav>
				</div>
				
				<div id="textArea">
						<form method='get' action=''>
						<table border="0">
						<tr>
						<td>Arbeitsplatznummer:</td>
						<td><input type="text" name="Nr" readonly value="<?php echo $arbeitsplatzOld->getNummer();?>"></tD></tr>
						<tr><td>Arbeitsplatzname:</td><td><input name="name" type="text" class="loginField"required = "required" 
						value="<?php echo $arbeitsplatzOld->getName();?>"></p></td></tr>
								
								<tr><td>Ausstattung:</td></tr><tr>
								<?php 
								
								$i=0;
								foreach ($db->getAllArbeitsplatzausstattung() as $int){
									$i++;
									
									echo umlaute_encode("<td><input type='checkbox' name='".$int->getID()."'");
									if (in_array($int,$arbeitsplatzOld->getAusstattung()))
										echo "checked>";
									else
										echo ">";
									echo $int->getName()."</input></td>";
	
									if ($i % 3 === 0) echo "</tr><tr>";
					}	
	  								?>
						</tr>
										
							<tr><td><input type="submit" value ="Update" name="submit"></td>	
						</table>
						</form>
						<?php
						if (isset($erg))
							echo $erg;
						?>
				</div>
				<div id="footer">
				</div>
			</div>	
		</div>
	</div>	
</body>
</html>