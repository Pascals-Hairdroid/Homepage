<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	</head>
	<body>
	
<div id="main">
			<div id="head">
			<?php
					include ("header.html");
					if(!isset($_SESSION['username']))				
					include ("anmeldung.html");
					else{
					include ("angemeldet.php");
					
					}
				?>
			</div>
			<div id="menuMain" align="center">
			<ul>
			<li><a href="index.php" class="selected">Fris&ouml;rstudio</a></li>	
			<li><a href="unserTeam.php">Unser Team</a></li>	
			<li><a href="Produkte.php">Produkte</a></li>			
			<li><a href="terminvergabe.php">Termine</a></li>			
			<li><a href="Angebote.php">Angebote</a></li>
			<li><a href="Galerie.php">Galerie</a></li>
				
			</ul>
			</div>
			<div id="wrapper">
				<div id="textArea">
				
				<img src="../Bilder/Galerie/titelbild.jpg" align="center">
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
				<?php
					include("footer.html");
					
				?>
			</div>
</div>
	</body>
</html>
