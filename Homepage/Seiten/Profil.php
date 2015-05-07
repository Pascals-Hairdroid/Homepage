<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PASCALS HAIRSTYLE</title>
<link rel="stylesheet" type="text/css" href="../css/css.css">
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>
			$(document).ready(function(){
    $('#login-trigger').click(function() {
        $(this).next('#login-content').slideToggle();
        $(this).toggleClass('active');                    
        
        if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
        })
});
		</script>
</head>
<body>
	<?php
	include("Anmeldung/login.php");
	if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
		}
		?>
	<div id="container">
		<div id="streifen"></div>
		<div id="main">
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
									echo"<a href='Anmeldung/endSession.php'>Log Out</span></a>";
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
							echo"><a href='Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='Verwaltung/Verwaltungsmain.php'>Adminbereich</a></li>";
							}

							}
							else{
								echo"<li id='signup'>";
								echo"<a href='registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>
			</ul>
			</nav>
		</div>
		<div id="head">
			<?php
			include ("HTML/header.html");
			?>
		</div>
		<div id="menu">
			<ul>
				<li class="topmenu"><a href="../index.php">Friseurstudio</a>
					<ul>
						<li class="submenu"><a href="studio.php">Das Studio</a></li>
						<li class="submenu"><a href="team.php">Unser Team</a></li>
						<li class="submenu"><a href="dienstleistung.php">Dienstleistungen</a>
						</li>
						<li class="submenu"><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a>
						</li>
						<li class="submenu"><a href="kontakt.php">Kontakt</a></li>
					</ul>
				</li>
				<li class="topmenu"><a href="terminvergabe.php">Termine</a>
				</li>
				<li class="topmenu"><a href="Angebote.php">Angebote</a>
				</li>
				<li class="topmenu"><a href="#"> Produkte</a>
					<ul>
						<?php 
						$produktkategorie=$db->getAllProduktkategorie();


						foreach ($produktkategorie as $prod){

          echo" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>";
         }
         ?>
					</ul>
				</li>
				</li>
				<li class="topmenu"><a href="Galerie.php">Galerie</a>
				</li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="textArea">
				<?php 				
				$ordner = "../Bilder/Profilbilder/"; // Ordnername
				$allebilder = scandir($ordner); // Ordner auslesen und Array in Variable speichern
				$i=1;
				// Schleife um Array "$alledateien" aus scandir Funktion auszugeben
				// Einzeldateien werden dabei in der Variabel $datei abgelegt
				if(isset($_GET['SVNr'])){
						foreach ($allebilder as $bild) {
							// Zusammentragen der Dateiinfo
							$bildinfo = pathinfo($ordner."/".$bild);
							//Folgende Variablen stehen nach pathinfo zur Verfügung
							// $dateiinfo['filename'] =Dateiname ohne Dateiendung  *erst mit PHP 5.2
							// $dateiinfo['dirname'] = Verzeichnisname
							// $dateiinfo['extension'] = Dateityp -/endung
							// $dateiinfo['basename'] = voller Dateiname mit Dateiendung
							if ($bild != "." && $bild != ".."  && $bild != "_notes" && $bildinfo['basename'] != "Thumbs.db") {
								if($_GET['SVNr']==$bildinfo['filename']){
									$ma=$db->getMitarbeiter($_GET['SVNr']);
									echo "<img src='".$bildinfo['dirname']."/".$bildinfo['basename']."' class='profilbild'>";
									echo "<p class='abstand'><span class='font'>Vorname:</span> &nbsp;&nbsp;&nbsp;".$ma->getVorname()."</p>";
									echo "<p class='abstand'><span class='font'>Nachname: </span>".$ma->getNachname()."</p>";
									}
									else if($i == 1){
									$ma=$db->getMitarbeiter($_GET['SVNr']);
									echo "<img src='".$bildinfo['dirname']."/nopicture.jpg"."' class='profilbild'>";
									echo "<p class='abstand'><span class='font'>Vorname:</span> &nbsp;&nbsp;&nbsp;".$ma->getVorname()."</p>";
									echo "<p class='abstand'><span class='font'>Nachname: </span>".$ma->getNachname()."</p>";

								}
								$i++;
									
							};

						 };

					}
					else{
							if ($_SESSION['admin']==true) {
							$ma=$db->getMitarbeiter($_SESSION['svnr']);

							foreach ($allebilder as $bild) {
								// Zusammentragen der Dateiinfo
								$bildinfo = pathinfo($ordner."/".$bild);
								//Folgende Variablen stehen nach pathinfo zur Verfügung
								// $dateiinfo['filename'] =Dateiname ohne Dateiendung  *erst mit PHP 5.2
								// $dateiinfo['dirname'] = Verzeichnisname
								// $dateiinfo['extension'] = Dateityp -/endung
								// $dateiinfo['basename'] = voller Dateiname mit Dateiendung
								if ($bild != "." && $bild != ".."  && $bild != "_notes" && $bildinfo['basename'] != "Thumbs.db") {
									if($_SESSION['svnr']==$bildinfo['filename']){
										$ma=$db->getMitarbeiter($_SESSION['svnr']);
										echo "<img src='".$bildinfo['dirname']."/".$bildinfo['basename']."' class='profilbild'>";
										echo "<p class='abstand'><span class='font'>Vorname:</span> &nbsp;&nbsp;&nbsp;".$ma->getVorname()."</p>";
										echo "<p class='abstand'><span class='font'>Nachname: </span>".$ma->getNachname()."</p>";
									}
									else if($i == 1){
										$ma=$db->getMitarbeiter($_SESSION['svnr']);
										echo "<img src='".$bildinfo['dirname']."/nopicture.jpg"."' class='profilbild'>";
										echo "<p class='abstand'><span class='font'>Vorname:</span> &nbsp;&nbsp;&nbsp;".$ma->getVorname()."</p>";
										echo "<p class='abstand'><span class='font'>Nachname: </span>".$ma->getNachname()."</p>";
										}
										$i++;
									};
								};
							}
							else{
								$email=$_SESSION['email'];
								$kunde=$db->getKunde($email);
								if ($kunde->getFoto() != null)
									echo"<img class='profilbild'src='../Bilder/Profilbilder/".$kunde->getFoto()."'>";
								else
									echo"<img src='../Bilder/Profilbilder/nopicture.jpg' class='profilbild'>";
								echo"<p>";
								echo "<p class='abstand'><span class='font'>Vorname:</span> &nbsp;&nbsp;&nbsp;".$kunde->getVorname()."</p>";
								echo "<p class='abstand'><span class='font'>Nachname: </span>".$kunde->getNachname()."</p>";
								echo "<p class='abstand'><span class='font'>Telefon Nr: </span>".$kunde->getTelNr()."</p>";
							}
					}
					?>
			</div>
			<div id="werbungsbanner"></div>
		</div>
		<div id="footer" align="center">
			<?php
			include("HTML/footer.html");
			?>
		</div>
	</div>
	</div>
</body>
</html>
