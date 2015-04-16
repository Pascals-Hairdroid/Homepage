<?php session_start();?>
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
							echo"><a href='Seiten/Profil.php'>Profil</a></li>";
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
				<li class="topmenu"><a href="Produkte.php">Produkte</a>
				</li>
				<li class="topmenu"><a href="Galerie.php">Galerie</a>
				</li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="textArea">
				<?php 
				include("../include_DBA.php");
				$db= new DB_Con("conf/db.php",true, "utf8");
					
				if ($_SESSION['admin']==true) {
						$mitarbeiter=$db->getMitarbeiter($_SESSION['svnr']);
						if ($mitarbeiter->getFoto() != null)
							echo"<img class='profilbild'src='../Bilder/Profilbilder/".$mitarbeiter->getFoto()."'>";
						else
							echo"<img src='../Bilder/Profilbilder/nopicture.jpg' class='profilbild'>";
						echo"<p>";
						echo "<p>Vorname: &nbsp;&nbsp;&nbsp;".$mitarbeiter->getVorname()."</p>";
						echo "<p>Nachname: ".$mitarbeiter->getNachname()."</p>";
						echo "<p>Zitat: ".$mitarbeiter->getZitat()."</p>";
					}
					else{
					$email=$_SESSION['email'];		
					$kunde=$db->getKunde($email);
					if ($kunde->getFoto() != null)
					echo"<img class='profilbild'src='../Bilder/Profilbilder/".$kunde->getFoto()."'>";
					else
					echo"<img src='../Bilder/Profilbilder/nopicture.jpg' class='profilbild'>";
					echo"<p>";
					echo "<p>Vorname: &nbsp;&nbsp;&nbsp;".$kunde->getVorname()."</p>";
					echo "<p>Nachname: ".$kunde->getNachname()."</p>";
					echo "<p>Telefon Nr: ".$kunde->getTelNr()."</p>";
					
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
