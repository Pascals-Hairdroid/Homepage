<?php session_start();
include("include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
<head>
<title>PASCALS HAIRSTYLE</title>
<link rel='stylesheet' type='text/css' href='css/css.css'>

<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='css/hide.css'>";
?>


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
<script language="javascript" type="text/javascript">
		var wechselZeit = 2000; 
   imageArr = new Array() 
   imageArr[imageArr.length] = "Bilder/Bildlauf/6.jpg"; 
   imageArr[imageArr.length] = "Bilder/Bildlauf/5.jpg"; 
   imageArr[imageArr.length] = "Bilder/Bildlauf/4.jpg"; 
   imageArr[imageArr.length] = "Bilder/Bildlauf/3.jpg"; 
   imageArr[imageArr.length] = "Bilder/Bildlauf/2.jpg"; 
   imageArr[imageArr.length] = "Bilder/Bildlauf/1.jpg"; 

	
 
   var xAnzahl = imageArr.length; 
   var xCounter=-1; 
   var maxOpacity = 100; 
   var minOpacity = 0; 
   var disableOpacity = maxOpacity; 
   var fadeInterval = 'fadeout'; 
   function Vorladen() 
   { 
	   for (i = 0; i < imageArr.length; i++) 
		   { var Bild = new Image(); Bild.src = imageArr[i]; } 
	   }
 Vorladen();
   function Bildwechsel01() 
   { 
    var objekt = document.getElementById('Foto01'); 
    xCounter++; 
    if (xCounter < xAnzahl) 
    { 
     if (fadeInterval == 'fadeout') {setOpacity(objekt, 'fadeout'); } 
     if (disableOpacity < minOpacity) 
     { 
      objekt.src = imageArr[xCounter]; 
      fadeInterval = 'fadein'; 
     } 
     if (fadeInterval == 'fadein') {setOpacity(objekt, 'fadein');} 
     if (disableOpacity > maxOpacity) 
     { 
      fadeInterval = 'fadeout'; 
      wechselZeit = 3000; 
     } else { 
      wechselZeit = 20; 
     } 
     setTimeout('Bildwechsel01()', wechselZeit); 
    } else { 
     xCounter = -1; 
     Bildwechsel01(); 
    } 
   } 
   setTimeout('Bildwechsel01()', wechselZeit); 
 
   function setOpacity(obj, direction) 
   { 
    obj.style.opacity = (disableOpacity / 100); 
    obj.MozOpacity = (disableOpacity / 100); 
    obj.style.filter = "alpha(opacity=" + disableOpacity + ")"; 
    switch (direction) 
    { 
     case 'fadein': 
      disableOpacity++; 
      break; 
     case 'fadeout': 
      disableOpacity--; 
      break; 
    } 
   } 
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
							echo"<label><a href='Seiten/forgotPassword.php'> Forgot Password </a></label>";
							echo"</fieldset>";
							echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Seiten/Anmeldung/endSession.php'>Logout</span></a>";
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
							echo"<li id='signup'><a href='Seiten/Verwaltung/Verwaltungsmain.php'>Adminbereich</a></li>";
							}

							}
							else{
								echo"<li id='signup'>";
								echo"<a href='Seiten/registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>

			</ul>
			</nav>
		</div>
		<div id="head">
			<a href="#" style="color:black;"><h1>
				PASCALS<img src="Bilder/Homepage/Logo.png"> HAIRSTYLE
			</h1>
			<h2>Frisuren zum Wohlf&uuml;hlen</h2>
		</a></div>

		<div id="hmenu">
			<nav id="menu">
				<ul class="hide">
					<li><a href="index.php" class="selected">Friseurstudio</a>
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
					<li class="topmenu"><a href="#"> Produkte</a>
						<ul>
							<?php 
							$produktkategorie=$db->getAllProduktkategorie();


							foreach ($produktkategorie as $prod){

          echo" <li class='submenu'><a href='Seiten/Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>";
         }
         ?>
						</ul>
					</li>
					<li><a href="Seiten/Galerie.php">Galerie</a></li>
					<li class="spacer"></li>
				</ul>
			</nav>
		</div>



		<div id="textArea">
			<img class="titelbild" id="Foto01" src="Bilder/Bildlauf/1.jpg">
			<h1>Willkommen bei Pascals Hairstyle!</h1>

			<p>wenn du einen Stylisten suchst der sich Zeit nimmt, um wirklich
				auf dich einzugehen und dir auch Tipps mitgibt, damit deine Frisur
				auch in den Wochen nach dem Besuch optimal zur Geltung kommt, bist
				du hier genau richtig.</p>

			<p>jeder Mensch ist anders. Auch jeder Kopf ist anders. Wenn es darum
				geht eine neue Frisur zu finden die individuell auf dich abgestimmt
				ist, dann kann ich dir durch meine intensive Beratung und
				langjährige Erfahrung beratend zur Seite stehen, sodass wir
				gemeinsam zu einem Ergebnis gelangen, dass dich und damit auch mich
				glücklich macht.</p>
			<br>


			<p>Dabei sehe ich mich als deinen Partner der mit dir ein gemeinsames
				Ziel verfolt: einen Style zu finden der dich begeistert und zu
				deinem Wohlbefinden beiträgt.</p>
			<br>

			<p>Wenn du einen Friseur suchst bei dem dein Wohlbefinden im
				Vordergrund steht, bist du bei mir genau richtig. Überzeuge dich
				selbst davon und schau zu einem Beratungstermin vorbei.</p>
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
