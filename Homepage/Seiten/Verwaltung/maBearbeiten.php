
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<div id="main">
			<div id="head">
				<h1>PASCALS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HAIRSTYLE</h1>
		<h2>weil Deine Haare den Meister verdienen</h2>		
		<img src="../../Bilder/Homepage/Logo.png"> 
			</div>
			<div id="menuVerwaltung">
			
		<ul>		
			<li class="topmenu1"><a href="">Mitarbeiterverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="maAnlegen.php">Mitarbeiter anlegen</a></li>
					  <li class="submenu1"><a href="maBearbeiten.php">Mitarbeiter bearbeiten</a></li>
				</ul>
			</li>
		  <li class="topmenu1"><a href="">Kundenverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="kuAktivieren.php">Kunde freischalten</a></li>
					  <li class="submenu1"><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
				</ul>
			</li>
		  <li class="topmenu1"><a href="">Terminverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="terminAnzeigen.php">Termine anzeigen</a></li>
					  <li class="submenu1"><a href="terminBearbeiten.php">Termine bearbeiten</a></li>
				</ul>
			</li>
		</ul>
			</div>
			<div id="textArea">
				<?php
				include("../../include_DBA.php");
				$db=new db_con("conf/db.php",true);
				
					?>
			</div>
			<div id="footer">
</div>
</div>			
</body>
</html>