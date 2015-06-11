<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

function kuUpdate($email, $vn, $nn, $telNr, $freischalten, $foto, $interessen)
	{
		$db=new db_con("conf/db.php",true);
		if($email != null){
			$kunde=new Kunde($email, $vn, $nn, $telNr, $freischalten, $foto, $interessen);
			$db->kundeUpdaten($kunde);
	
			return true;
		}
		else
			return false;
	}
$tempKu=$db->getKunde($_GET['Email']);
	$vn=$tempKu->getVorname();
	$nn=$tempKu->getNachname();
	$telnr=$tempKu->getTelNr();
	$freischalten=$tempKu->getFreischaltung();
	
	
if(isset($_GET['submit'])){
		$email=$_GET["Email"];
		$vn=$_GET['vn'];
		$nn=$_GET['nn'];
		$telNr=$_GET['telnr'];
		$foto=$tempKu->getFoto();
		$interessen=$tempKu->getInteressen();	
		$freischalten=false;
		if(isset($_GET['rights'])){
			if ($_GET['rights']=="on") {
				$freischalten=true;
			}
		}
		
			kuUpdate($email, $vn, $nn, $telNr, $freischalten, $foto, $interessen);
		}		
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
			<table border="0">
						<form method="get" action="">
							<tr><td>Email:</td><td><input name="Email" type="input" class=loginField"required = "required"
							<?php echo "value='".$_GET['Email']."'"; ?>></p></td></tr>
							
							<tr><td>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php echo "value='".$vn."'"; ?>></p></td></tr>
							
							<tr><td>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php echo "value='".$nn."'"; ?>></p></td></tr>
							
							<tr><td>Tel Nr.:</td><td><input name="telnr" type="text" class="loginField"required = "required"
							<?php echo "value='".$telnr."'"; ?>></p></td></tr>
							
							<tr><td>Freigeschalten:</td><td><input name="rights" type="checkbox"  class="loginField"
							<?php 
							if ($freischalten == 1) {
								echo "checked";
							}
							?>></p></td></tr>
							
										
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
</div>	
</div>		
</body>
</html>