<?php
include ("Anmeldung/auth.php")
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	</head>
	<body>
		<div id="main">
			<div id="head">
				<?php
					include ("html/header.html");
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
        <a href="terminvergabe.php" class="selected">Termine</a>        
      </li>
      <li class="topmenu">
        <a href="angebote.php">Angebote</a>
      </li>
	  <li class="topmenu">
        <a href="Produkte.php">Produkte</a>
      </li>
	  <li class="topmenu">
        <a href="Galerie">Galerie</a>
      </li>
    </ul>
  </div>
			<div id="wrapper">
				<div id="textArea">
				<br>
					<?php
					include("Methoden/dienstleistung.php")
					?>
				</div>
				<div id="werbungsbanner">
				
				</div>
			</div>
			<div id="footer" align = "center">
				<?php
					include("html/footer.html");
				?>
			</div>
		</div>
	</body>
</html>
