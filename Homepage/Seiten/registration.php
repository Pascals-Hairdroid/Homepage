<?php session_start();
include("../include_DBA.php");
$db=new DB_CON("conf/db.php",true);?>
<!DOCTYPE html> 
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
	</head>
	<body>
<?php
include("Anmeldung/registration.php");
include("Anmeldung/login.php");
if(isset($_POST["submit2"])){
	$interessenarray = array();
	foreach($db->getAllInteresse() as $int){
		if(isset ($_POST[$int->getID()]))
			$int = new Interesse($int->getID(),$int->getBezeichnung());
			$interessenarray[]=$int;
	}
	
	$ausgabe=reg(trim($_POST['username']),trim($_POST['vn']),trim($_POST['nn']),$_POST['pw'],$_POST['pw2'],$_POST['telnr'],$interessenarray);
}
		if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
		}
	?>
<div id="container">
<div id="streifen"></div>
<div id="main">
<div id="Loginbox">
					<nav>
						<ul>
						<?php
						if(!isset($_SESSION['username'])){
							echo"<li id='login'>";
								echo"<a id='login-trigger' href='#'>Log in <span>&#x25BC;</span></a>";
								echo"<div id='login-content'>";
									echo"<form method='post' action=''>";
										echo"<fieldset id='inputs'>";
											echo"<input id='username' type='text' name='username' placeholder='Username' required>";   
											echo"<input id='password' type='password' name='passwort' placeholder='Passwort' required>";
										echo"</fieldset>";
										echo"<fieldset id='actions'>";
											echo"<input type='submit' name ='submit' id='submit' value='Log in'>";
											echo"<label><a href='#'> Forgot Password </a></label>";
										echo"</fieldset>";
									echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Anmeldung/endSession.php'>Log Out</span></a>";
									echo"<div id='login-content'>";
										
								}
									
									?>
								</div>                     
							</li>
							<li id="signup">
								<a href="registration.php">Sign up</a>
							</li>
						</ul>
					</nav>
			</div>
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
							<tr><td>E-Mail Adresse:</td><td><input name="username" type="input" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}" class="loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['username']."'"; ?>></p></td></tr>
							
							<tr><td>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['vn']."'"; ?>></p></td></tr>
							
							<tr><td>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php if(isset($ausgabe))echo "value='".$_POST['nn']."'"; ?>></p></td></tr>
							
							<tr><td><p>Passwort:</p></td><td><input  name="pw" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td><p>Password wiederholen:</p></td><td><input name="pw2" type="password"  class="loginField"required = "required"></p></td></tr>
							<tr><td>Telefon Nummer:</td><td><input name="telnr" type="string" pattern="[0-9]{1,20}" class="loginField"required = "required"<?php if(isset($ausgabe))echo "value='".$_POST['telnr']."'"; ?>></p></td></tr><tr><td> <br></td></tr>
				
				
						<?php
						
						
						$i=0;
						echo"<tr>";
						foreach ($db->getAllInteresse() as $int)
						  {
							  $i++;
							
							echo "<td><input type='checkbox' name='".$int->getID()."'>".$int->getBezeichnung()." </input></td>";
							
							  if ($i % 3 === 0) echo "</tr><tr>";
						  }
						  echo"</tr>";
						?>
				
							<tr><td><input type="submit" value ="absenden" name="submit2"></td>
							
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
</div></div>
	</body>
</html>
