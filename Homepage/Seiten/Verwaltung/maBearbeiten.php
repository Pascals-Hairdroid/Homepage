<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
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
					
					$mitarbeiter=new Mitarbeiter($svnr,$vn,$nn,null,array(),false,array(),array());
					$db->mitarbeiterEintragen($mitarbeiter);
					$db->mitarbeiterPwUpdaten($mitarbeiter,$passwort);					
					
					return 'Mitarbeiter hinzugef&uuml;gt';
				}
			}
		}	
	}
if(isset($_POST['anlegen']))
	$erg=maAnlegen($_POST['svnr'],$_POST['vn'],$_POST['nn'],$_POST['pw'],$_POST['pw2']);
?>
	<div id="container">
		<div class="hide" id="streifen"></div>
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
							<tr><td><input type="submit" value ="absenden" name="anlegen"></td>
							
						</form>
					</table>
					<?php
					if (isset($erg))
						echo $erg."<br />";
					?>
					<br />
			<table border="0">
				<?php
				

				echo "<tr><td>Sozialversicherungsnr.:</td><td>Vorname</td><td>Nachname</td><td>Admin</td><td>";

				foreach($db->getAllMitarbeiter(false) as $mitarbeiter){
							echo umlaute_encode("<tr><td>".$mitarbeiter->getSVNr()."</td><td>".$mitarbeiter->getVorname()."</td><td>".$mitarbeiter->getNachname()."</td><td>".$mitarbeiter->getAdmin()."</td>");
							echo "<td><a href='maUpdate.php?SVNr=".$mitarbeiter->getSVNr()."&vn=".$mitarbeiter->getVorname()."&nn=".$mitarbeiter->getNachname()."&admin=".$mitarbeiter->getAdmin()."'>Bearbeiten</a></td>";
							echo "<td><a href='maDelete.php?SVNr=".$mitarbeiter->getSVNr()."'>L&ouml;schen</a></td>";
							echo "<td><a href='maPWReset.php?SVNr=".$mitarbeiter->getSVNr()."'>Passwort zur&uuml;cksetzen</a></td>";
							
							echo"</tr>";
						}
						?>
			</table>
		</div>
		<div id="footer"></div>
	</div>
	</div>
</body>
</html>
