<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>

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
			<h1>
				PASCALS<img src="../../Bilder/Homepage/Logo.png">HAIRSTYLE
			</h1>
			<h2>Frisuren zum Wohlf&uuml;hlen</h2>

		</div>
		<div id="hmenu">
			<nav id="menu" class="hide">
			<ul>
				<li class="items"><a href="">Mitarbeiter</a>
					<ul>
						<li><a href="maAnlegen.php">anlegen</a></li>
						<li><a href="maBearbeiten.php">bearbeiten</a></li>
						<li><a href="zeiten.php">Dienstzeiten</a></li>
						<li><a href="urlaub.php">Urlaub</a></li>
					</ul>
				</li>
				<li class="items"><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
				<li class="items"><a href="">Termine</a>
					<ul>
						<li><a href="terminAnzeigen.php">anzeigen</a></li>
						<li><a href="terminBearbeiten.php">bearbeiten</a></li>
					</ul>
				</li>
				<li class="items"><a href="">Notifications</a>
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
				<?php
				include("../../include_DBA.php");
				$db=new db_con("conf/db.php",true);

				echo "<tr><td>Sozialversicherungsnr.:</td><td>Vorname</td><td>Nachname</td><td>Admin</td><td>";

				foreach($db->getAllMitarbeiter() as $mitarbeiter){
							echo umlaute_encode("<tr><td>".$mitarbeiter->getSVNr()."</td><td>".$mitarbeiter->getVorname()."</td><td>".$mitarbeiter->getNachname()."</td><td>".$mitarbeiter->getAdmin()."</td><td><a href='maUpdate.php?SVNr=".$mitarbeiter->getSVNr()."&vn=".$mitarbeiter->getVorname()."&nn=".$mitarbeiter->getNachname()."&admin=".$mitarbeiter->getAdmin()."'>Bearbeiten</a></td><td><a href='maPWReset.php?SVNr=".$mitarbeiter->getSVNr()."'>Passwort zurücksetzen</a></td></tr>");

						}
						?>
			</table>
		</div>
		<div id="footer"></div>
	</div>
	</div>
</body>
</html>
