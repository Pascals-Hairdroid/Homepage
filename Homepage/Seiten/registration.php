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
	
	<script>
    function passCheck() {				
		
        var pass1 = document.getElementById("pw1").value;
        var pass2 = document.getElementById("pw2").value;
        if (pass1 != pass2) {
            alert("Passwörter stimmen nicht überein");
            document.getElementById("pw1").style.borderColor = "#E34234";
            document.getElementById("pw2").style.borderColor = "#E34234";
			var f = document.getElementById("demo");         
			f.style.color = "red"; 
			var g = document.getElementById("demo2");           
			g.style.color = "red"; 
			
			 return false;
        }
    }
	
</script>
	
	
	
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
				
					<table border="0">
						<form  name="registration" accept-charset="UTF-8" method="post" action="anmeldung/registration.php">
							<tr><td>E-Mail Adresse:</td><td><input name="username" type="text" class="loginField"required = "required"></p></td><td>
							<?php							
							if(isset($_GET['n'])){
								if ($_GET['n'] == 1)
								echo "<p style='color:red;'>E-Mail Adresse ist schon vorhanden</p>";
							}
							?>
							
							
							</td></tr>
							<tr><td>Vorname:</td><td><input name="vn" id="vn" type="text" class="loginField"required = "required"></p></td></tr>
							<tr><td>Nachname:</td><td><input name="nn" id="nn" type="text" class="loginField"required = "required"></p></td></tr>
							<tr><td><p id="demo">Passwort:</p></td><td><input id="pw1" name="pw" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td><p id="demo2">Password wiederholen:</p></td><td><input id="pw2" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td>Telefon Nummer:</td><td><input name="telnr" id="telnr"type="string" pattern="[0-9]{1,20}" class="loginField"required = "required"></p></td></tr>
				
							<tr><td><input type="submit" value ="absenden" name="submit" onclick="return passCheck()"></td>
							
						</form>
					</table>
					</div>
				
			</div>
			<div id="footer" align="center">
				<?php
					include("html/footer.html");
					
				?>
			</div>
</div>
	</body>
</html>
