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
					include ("header.html");
				?>
			</div>
			<div id="menuMain" align="center">
				<ul>
			<li><a href="index.php">Fris&ouml;rstudio</a></li>	
			<li><a href="unserTeam.php">Unser Team</a></li>	
			<li><a href="Produkte.php">Produkte</a></li>			
			<li><a href="terminvergabe.php" class="selected">Termine</a></li>			
			<li><a href="Angebote.php">Angebote</a></li>
			<li><a href="Galerie.php">Galerie</a></li>
			
			</ul>
			</div>
			<div id="wrapper">
				<div id="textArea">
				<br>
					<?php
					include("dienstleistung.php")
					?>
					<iframe name="z_iframe" src="zeittabelle.php"> </iframe>
				</div>
				<div id="werbungsbanner">
				
				</div>
			</div>
			<div id="footer" align = "center">
				<?php
					include("footer.html");
				?>
			</div>
		</div>
	</body>
</html>
