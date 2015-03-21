<?php
include ("Anmeldung/auth.php")
?>
<!DOCTYPE html>
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	</head>
	<body>
	<div id="container">
<div id="streifen"></div>
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
        <a href="terminvergabe.php" class="selected">Termine</a>        
      </li>
      <li class="topmenu">
        <a href="Angebote.php">Angebote</a>
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
				<br>
					<?php
					include("Methoden/dienstleistung.php")
					?>
					<br>
					<iframe name="iframe" src="methoden/zeittabelle_start.php" style="width:970px;height:600px;">
					</iframe>
				</div>
				<div id="werbungsbanner">
				
				</div>
			</div>
			<div id="footer" align = "center">
				<?php
					include("HTML/footer.html");
				?>
			</div>
		</div></div>
	</body>
</html>
