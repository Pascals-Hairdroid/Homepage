<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">   
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	</head>
	<body>
<?php
include("Anmeldung/registration.php");
if(isset($_POST["submit"])){
	
	$ausgabe=reg(trim($_POST['username']),trim($_POST['vn']),trim($_POST['nn']),$_POST['pw'],$_POST['pw2'],$_POST['telnr']);
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
				
					<table border="0">
						<form method="post" action="">
							<tr><td>E-Mail Adresse:</td><td><input name="username" type="input" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}" class=loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['username']."'"; ?>></p></td></tr>
							
							<tr><td>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['vn']."'"; ?>></p></td></tr>
							
							<tr><td>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['nn']."'"; ?>></p></td></tr>
							
							<tr><td><p>Passwort:</p></td><td><input  name="pw" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td><p>Password wiederholen:</p></td><td><input name="pw2" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td>Telefon Nummer:</td><td><input name="telnr" type="string" pattern="[0-9]{1,20}" class="loginField"required = "required"<?php if(isset($ausgabe))echo "value='".$_POST['telnr']."'"; ?>></p></td></tr>
				
							<tr><td><input type="submit" value ="absenden" name="submit"></td>
							
						</form>
					</table>
					<?php
						if(isset($ausgabe))
							echo $ausgabe;
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
