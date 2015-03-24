<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>PASCALS HAIRSTYLE</title>
		<link rel='stylesheet' type='text/css' href='css/css.css'>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
		include("Seiten/Anmeldung/login.php");
		if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
		}
	?>
	
<div id="container">
<div id="streifen"></div>
		<div id="main">
			<div id="Loginbox">
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
									echo"<a href='Seiten/Anmeldung/endSession.php'>Log Out</span></a>";
									echo"<div id='login-content'>";
										
								}
									
									?>
								</div>                     
							</li>
							<li id="signup">
								<a href="Seiten/registration.php">Sign up</a>
							</li>
						</ul>
					</nav>
			</div>
			<div id="head">
				<h1>PASCALS<img src="Bilder/Homepage/Logo.png">HAIRSTYLE</h1>
				<h2>Frisuren zum Wohlf&uuml;hlen</h2>	
			</div>
			
			<div id="hmenu">
				<nav id="menu" class="hide">
					<ul>
						<li>
							<a href="index.php" class="selected">Friseurstudio</a>
							<ul>
								<li><a href="Seiten/studio.php">Das Studio</a></li>
								  <li><a href="Seiten/team.php">Unser Team</a></li>
								  <li><a href="Seiten/dienstleistung.php">Dienstleistungen</a></li>
								  <li><a href="Seiten/offnungszeiten.php">&Ouml;ffnungszeiten</a></li>
								  <li><a href="Seiten/kontakt.php">Kontakt</a></li>
							</ul>
						</li>
						<li><a href="Seiten/terminvergabe.php">Termine</a></li>
						<li><a href="Seiten/Angebote.php">Angebote</a></li>
						<li><a href="Seiten/Produkte.php">Produkte</a></li>
						<li><a href="Seiten/Galerie.php">Galerie</a></li>
						<li class="spacer"></li>
					</ul>
				</nav>
			</div>
			
			
			
			<div id="textArea">
				<img class="titelbild" src="Bilder/Galerie/homepage74.jpg">
				<h1>Willkommen bei Pascals Hairstyle!</h1>

				<p>wenn du einen Stylisten suchst der sich Zeit nimmt, um wirklich auf dich einzugehen und dir auch Tipps mitgibt, damit deine Frisur auch in den Wochen nach dem Besuch optimal zur Geltung kommt, bist du hier genau richtig.</p>

				<p>jeder Mensch ist anders. Auch jeder Kopf ist anders. Wenn es darum geht eine neue Frisur zu finden die individuell auf dich abgestimmt ist, dann kann ich dir durch meine intensive Beratung  und langjährige Erfahrung beratend zur Seite stehen, sodass wir gemeinsam zu einem Ergebnis gelangen, dass dich und damit auch mich glücklich macht.</p><br>

				
				<p>Dabei sehe ich mich als deinen Partner der mit dir ein gemeinsames Ziel verfolt: einen Style zu finden der dich begeistert und zu deinem Wohlbefinden beiträgt.</p>
				<br>
				
				<p>Wenn du einen Friseur suchst bei dem dein Wohlbefinden im Vordergrund steht, bist du bei mir genau richtig. Überzeuge dich selbst davon und schau zu einem Beratungstermin vorbei. </p>
				<br>
				
				<p>Ich freue mich darauf schon bald mit dir zusammenzuarbeiten.</p>
				<br>
				<p>Pascal</p>
			</div>
			
			<div id="footer">	
				<a href="">Impressum</a>
			</div>
		</div>
		
		</div>
	</body>
</html>
