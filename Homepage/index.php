<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	</head>
	<body>
	
<div id="main">
			<div id="head">
			<h1>PASCALS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HAIRSTYLE</h1>
			<h2>weil Deine Haare den Meister verdienen</h2>		
			<img src="Bilder/Homepage/Logo.png"> 
		
			<?php
					
					if(!isset($_SESSION['username']))				
					echo"<table border='0'><form  accept-charset='UTF-8' action='Seiten/Anmeldung/login.php' method='post'><tr><td><input name='username' type='text'placeholder='username' class='loginField'></p></td></tr><tr><td><input name='passwort' type='password' placeholder='passwort' class='loginField'></p></td></tr><tr><td><input type='submit' value=' Login '  class='loginButtons'></td></form><form action='Seiten/registration.php'><td><input type='submit' value=' Registrieren '  class='regButton'></td></tr></form></table>";
					else{
					echo"<br><table border='0' class='gruss'>";
					echo "<tr><td>hallo ".$_SESSION['username']."</tr></td>";
					echo"<form action='Seiten/Anmeldung/endSession.php'><tr><td><input type='submit' value='Log-Out' class='logout'></td></tr></form></table>";
					}
				?>
			</div>
			  <div id="menu">
    <ul>
      <li class="topmenu">
        <a href="index.php" class="selected">Friseurstudio</a>
        <ul>
          <li class="submenu"><a href="studio.php">Das Studio</a></li>
          <li class="submenu"><a href="Seiten/team.php">Unser Team</a></li>
          <li class="submenu"><a href="dienstleistung.php">Dienstleistungen</a></li>
          <li class="submenu"><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a></li>
          <li class="submenu"><a href="kontakt.php">Kontakt</a></li>
        </ul>
      </li>
      <li class="topmenu">
        <a href="Seiten/terminvergabe.php">Termine</a>        
      </li>
      <li class="topmenu">
        <a href="Seiten/angebote.php">Angebote</a>
      </li>
	  <li class="topmenu">
        <a href="Seiten/Produkte.php">Produkte</a>
      </li>
	  <li class="topmenu">
        <a href="Seiten/Galerie">Galerie</a>
      </li>
    </ul>
  </div>
			<div id="wrapper">
				<div id="textArea">
				
				<img src="Bilder/Galerie/titelbild.jpg">
					<h1>Willkommen bei Pascals Hairstyle!</h1><br>

<p>Schneiden, föhnen frisieren, kurz gesagt "Stylen" im positivsten Sinne. Wenn es um Haare geht, dann ist Vertrauen gefragt. </p>

<p>Wenn du einen Stylisten suchst der wirklich auf dich eingeht, wenn Trend und Mode für dich wichtig sind, aber die Frisierbarkeit zu Hause fast noch wichtiger ist, wenn du Wert auf einen Haarschnitt legst der bis zum Nächsten Friseurbesuch hält, was er beim schneiden versprach, dannhab ich wen für Dich:</p><br>

<h2>PASCALS HAIRSTYLE</h2><br>
<p>Wagramerstrasse 154 a<br>
1220 Wien<br>
Mobil: 0676 92 38 217<br>
Montag - Freitag :	11:00 -19:00 Uhr<br>
Samstag :	09:00 -15:00 Uhr</p><br>
<p>In meinem "Ein-Mann"-Studio gilt die Devise "Können, Service & Friesierbarkeit". Meine Kundinnen wissen meine intensive Beratung zu schätzen und vertrauen meiner Erfahrung. </p>
<br>
<p>Selbst die tollste Frisur passt nicht auf jeden Kopf. Darum ist Beratung so wichtig und macht Dich auf lange Zeit glücklich mit Deinen Haaren.</p>
<br>
<p>Ich sehe mich nicht nur als reinen "Dienst"-leister meiner Kundinnen. Vielmehr als sowas wie ein Partner. Es ist eine Vertrauensbasis auf die sich die Zusammenarbeit stützt. Nur so kann etwas Besonderes entstehen, das über lange Zeit Freude bereitet. Das wissen auch einige Prominente, wie Mausi Lugner oder Manuel Ortega. </p>
<br>
<p>Service ist bei mir groß geschrieben . Ich will, dass Du zufrieden bist, wiederkommst, mich vielleicht auch empfielst.</p>
<br>
<p>Ich freu mich auf deinen Besuch!</p>
<br>
<p>Pascal</p>
				</div>
				
			</div>
			<div id="footer" align="center">
				<ul>
		<li><a href="">Impressum</a></li>
		
	</ul>
			</div>
</div>
	</body>
</html>
