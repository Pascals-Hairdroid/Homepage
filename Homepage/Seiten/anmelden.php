<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
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
<div id="main">
			<div id="head">
				<?php
					include ("HTML/header.html");
				?>
			</div>
			<div id="menu">
   <ul>
      <li class="topmenu">
        <a href="../index.php">Friseurstudio</a>
        <ul>
          <li class="submenu"><a href="studio.php">Das Studio</a></li>
          <li class="submenu"><a href="team.php">Unser Team</a></li>
          <li class="submenu"><a href="dienstleistung.php">Dienstleistungen</a></li>
          <li class="submenu"><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a></li>
          <li class="submenu"><a href="kontakt.php">Kontakt</a></li>
        </ul>
      </li>
      <li class="topmenu">
        <a href="terminvergabe.php">Termine</a>        
      </li>
      <li class="topmenu">
        <a href="angebote.php">Angebote</a>
      </li>
	  <li class="topmenu">
        <a href="Produkte.php">Produkte</a>
      </li>
	  <li class="topmenu">
        <a href="Galerie.php">Galerie</a>
      </li>
    </ul>
  </div>
			<div id="wrapper">
				<div id="textArea">
				
				<?php
				include ("Formulare/anmeldung.php");
				?>
				
				</div>
				
			</div>
			<div id="footer" align="center">
				<?php
					include("HTML/footer.html");
				?>
			</div>
</div>
	</body>
</html>
