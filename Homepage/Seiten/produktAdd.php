<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
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
	$produktkat=$db->getProduktkategorie($_POST['kategorie']);
 	$produkt=new Produkt($_POST['id'], $_POST['name'],$_POST['hersteller'], $_POST['beschreibung'], $_POST['preis'], $_POST['bestand'], $produktkat);	
 	$db->produktEintragen($produkt);
}
	?>
<div id="container">
<div id="streifen"></div>
<div id="main">
<div id="Loginbox" class="hide">
					<nav>
						<ul>
						<?php
						if(!isset($_SESSION['username'])){
							echo"<li id='login'>";
								echo"<a id='login-trigger' href='#'>Login <span>&#x25BC;</span></a>";
								echo"<div id='login-content'>";
									echo"<form method='post' action=''>";
										echo"<fieldset id='inputs'>";
											echo"<input id='username' type='text' name='username' placeholder='Username' required>";   
											echo"<input id='password' type='password' name='passwort' placeholder='Passwort' required>";
										echo"</fieldset>";
										echo"<fieldset id='actions'>";
											echo"<input type='submit' name ='submit' id='submit' value='Log in'>";
											echo"<label><a href='forgotPassword.php'> Forgot Password </a></label>";
										echo"</fieldset>";
									echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Anmeldung/endSession.php'>Logout</span></a>";
									echo"<div id='login-content'>";	
								}
									?>
								</div>                     
							</li>
							<?php
							if(isset($_SESSION['username'])){
							echo"<li "; 
							if($_SESSION['admin']==false)
							echo"id='signup'";
							else
							echo"id='element'";	
							echo"><a href='Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='Verwaltung/Verwaltungsmain.php'>Adminbereich</a></li>";
							}
													
							}
							else{
								echo"<li id='signup'>";
								echo"<a href='registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>
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
       <a href="#"> Produkte</a>
         <ul>
        <?php 
       	$produktkategorie=$db->getAllProduktkategorie();
       	
       	
        	foreach ($produktkategorie as $prod){
		
          echo umlaute_encode(" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>");
         }
         ?>
        </ul>
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
							<tr><td>ID</td><td><input type="text" name="id" readonly <?php 
							$produkte=$db->getAllProdukt();
							$lastelement =count($produkte)+1;
							echo $lastelement;
							echo"value='$lastelement' placeholder='$lastelement'";
							?>/></td></tr>
							<tr><td>Name</td><td><input type="text" name="name" required="required"/></td></tr>
							<tr><td>Hersteller</td><td><input type="text" name="hersteller" required="required"/></td></tr>
							<tr><td>Beschreibung</td><td><input type="text>" name="beschreibung" required="required"/></td></tr>
							<tr><td>Preis</td><td><input type="text>" name="preis" required="required"/></td></tr>
							<tr><td>Bestand</td><td><input type="text>" name="bestand" required="required"/></td></tr>
							<tr><td>Produktkategorie</td>
							<td>
							<?php 
								echo"<select name='kategorie' size='1'>";
	 							echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  								foreach ($db->getAllProduktkategorie() as $kat)
  									echo "<option style='width:17ex;'value='".$kat->getKuerzel()."'>".$kat->getBezeichnung()." </option>";					
							?>
							</select></td></tr>
							</tr>
							<tr><td><input type="submit" value ="absenden" name="submit2"></td>
							
						</form>
					</table>
					<?php
						
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