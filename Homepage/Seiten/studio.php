<?php 
include ('Methoden/sessionTimeout.php');
session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='../css/hide.css'>";
?>
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
		include("Anmeldung/login.php");
		if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
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
					if(isset($_GET['web']))include ("HTML/headerNoLink.html");
			else include ("HTML/header.html");
				?>
			</div>
			<?php if(!isset($_GET['web']))
			{?>
			<div id="menu" class="hide">
    <ul>
      <li class="topmenu">
        <a href="../index.php" class="selected">Friseurstudio</a>
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
  <?php }?>
			<div id="wrapper">
				<div id="textArea">
				<br>
				<img src="../Bilder/Homepage/studio1.jpg" style="width:32%;" />
				<img src="../Bilder/Homepage/studio2.jpg" style="width:32%;" />
				<img src="../Bilder/Homepage/studio3.jpg" style="width:32%;" />
				
					<br> <br>
					<p style="text-align:center"> Im Studio "Pascals Hairstyle" wird Freundlichkeit und eine gem&uuml;tliche Atmosph&auml;re gro&szlig; geschrieben!
Das Wohlbefinden der Kunden ist unser Ziel. Um das zu erreichen, f&auml;ngt unser Service schon an, wenn Sie das Studio betreten. Unser modernes Ambiente, immer am Puls der Zeit, und die professionelle Typberatung lassen unsere Kunden schnell den Alltagsstress vergessen.
					</p>

					<br>
					<p style="text-align:center">Unser Salon verf&uuml;gt &uuml;ber 4 Bedienungspl&auml;tze sowie 2 Waschpl&auml;tze, bietet eine moderne Ausstattung und eine klimatisierte Bel&uuml;ftung. Er befindet sich im Zentrum des 22. Wiener Bezirkes in der Wagramer Stra&szlig;e und ist direkt mit der U1 (Station Kagraner Platz) zu erreichen.</p>
					<br>
					<p style="text-align:center"> <img src="../Bilder/Homepage/studio4.jpg" style="width:32%;" /></p>
					
					
				</div>
				<div id="werbungsbanner">
				
				</div>
			</div>
			<div id="footer" align = "center"  class="hide">
				<?php
					include("HTML/footer.html");
				?>
			</div>
		</div></div>
	</body>
</html>
