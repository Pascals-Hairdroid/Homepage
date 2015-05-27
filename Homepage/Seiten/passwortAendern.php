<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);
?>
<!DOCTYPE html>
<html>
<head>
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
	function passwortcheck($pw,$pw2){
		if($pw != $pw2){
			return "Passwörter stimmen nicht überein";
		}
	}
	include("Anmeldung/login.php");
	if(isset($_POST['submit'])){
		$passwort = md5($_POST['passwort']);
		$username=$_POST['username'];
		$weiterleitung=login($username,$passwort);
		header('Location: ../index.php');
	}

	if(isset($_POST['submit2'])){
		
		if($_POST['newPW'] != $_POST['newPW2'])
		{
			$ausgabe="Die Passw&ouml;rter stimmen nicht &uuml;berein";
		}
		else
		{


			if(isset($_GET['tok']))
			{
				$kunde=$db->getKunde($_GET['e']);
				var_dump($kunde);
				$tok=$db->getKundeToken($kunde);
				$db->kundePwUpdaten($kunde, md5($_POST['newPW']));
			}
			else
			{
				if(isset($_SESSION['email']))
				{
					$k=$db->getKunde($_SESSION['email']);
					if($db->authentifiziereKunde($k, md5($_POST['oldPW']))){
						$db->kundePwUpdaten($k, md5($_POST['newPW']));
						$ausgabe="Passwort erfolgreich geändert";
					}
					else $ausgabe="Das eingegebene Passwort ist ungültig!";
				}
				if(isset($_SESSION['svnr']))
				{
					$m=$db->getMitarbeiter($_SESSION['svnr']);
					if($db->authentifiziereMitarbeiter($m, md5($_POST['oldPW'])))
					{
						$db->mitarbeiterPwUpdaten($m, md5($_POST['newPW']));
						$ausgabe="Passwort erfolgreich geändert";
					}
					else $ausgabe="Das eingegebene Passwort ist ungültig!";
				}
			}


		}
		
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
							echo"<a id='login-trigger' href='#'>Login <span>&#x25BC;</span></a>";
							echo"<div id='login-content'>";
							echo"<form method='post' action=''>";
							echo"<fieldset id='inputs'>";
							echo"<input id='username' type='text' name='username' placeholder='Username' required>";
							echo"<input id='password' type='password' name='passwort' placeholder='Passwort' required>";
							echo"</fieldset>";
							echo"<fieldset id='actions'>";
							echo"<input type='submit' name ='submit' id='submit' value='Log in'>";
							echo"<label><a href='forgotPassword.php'> Forgot Password </a></label>";
							echo"</fieldset>";
							echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Anmeldung/endSession.php'>Logout</span></a>";
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
				<li class="topmenu"><a href="angebote.php">Angebote</a>
				</li>
				<li class="topmenu"><a href="#"> Produkte</a>
					<ul>
						<?php 
						$produktkategorie=$db->getAllProduktkategorie();


						foreach ($produktkategorie as $prod){

          echo umlaute_encode(" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>");
         }
         ?>
					</ul>
				</li>
				<li class="topmenu"><a href="Galerie.php">Galerie</a>
				</li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="textArea">

				<?php

				echo"<form method='post' action=''>";
				if(isset($_GET['tok']))
				{
					
				}
				else
				echo"<p><input id='oldPW' type='text' name='oldPW' placeholder='Altes Passwort' required></p>";
				echo"<p><input id='newPW' type='password' name='newPW' placeholder='Passwort' required></p>";
				echo"<p><input id='newPW2' type='password' name='newPW2' placeholder='Passwort' required></p>";
				echo"<p><input type='submit' name ='submit2' id='submit2' value='Passwort ändern'></p>";
				echo"</form>";
				if(isset($ausgabe))
					echo $ausgabe;
				?>

			</div>

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
