<?php session_start();
//var_dump($_FILES);
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);
if(isset($_POST['anlegenM']))
{
	$mitarbeiter=$db->getMitarbeiter($_POST['id']);
	$mitarbeiter->setVorname($_POST['vn']);
	$mitarbeiter->setNachname($_POST['nn']);
	
//Server:
 	file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], NK_Pfad_Kunde_Bildupload_beginn.$_POST['id'].NK_Pfad_Kunde_Bild_ende,true);
//Local:
//  file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], dirname(__FILE__)."/../Bilder/Profilbilder/".$_POST['id'].NK_Pfad_Kunde_Bild_ende,true);
	
	
	$db->mitarbeiterUpdaten($mitarbeiter);
}
if(isset($_POST['anlegenK']))
{
	$interessenarray = array();
	foreach($db->getAllInteresse() as $int){
		if(isset ($_POST[$int->getID()])){
			$int = new Interesse($int->getID(),$int->getBezeichnung());
			$interessenarray[]=$int;
		}
	}
		
	$kunde=$db->getKunde($_POST['id']);
	$kunde->setVorname($_POST['vn']);
	$kunde->setNachname($_POST['nn']);
	$kunde->setTelNr($_POST['tel']);
	$kunde->setInteressen($interessenarray);
	$kunde->setFoto(NK_Pfad_Kunde_Bild_beginn.md5($_POST['id']).NK_Pfad_Kunde_Bild_ende);
	//$kunde->setFoto("http://localhost/homepage/Homepage/bilder/Profilbilder/".md5($_POST['id']).NK_Pfad_Kunde_Bild_ende);
	
//Server:::::::::::::::: 	
	file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], NK_Pfad_Kunde_Bildupload_beginn.md5($_POST['id']).NK_Pfad_Kunde_Bild_ende,true);

//Local:	
//	file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], dirname(__FILE__)."/../Bilder/Profilbilder/".md5($_POST['id']).NK_Pfad_Kunde_Bild_ende,true);
	
	$db->kundeUpdaten($kunde);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PASCALS HAIRSTYLE</title>
<link rel="stylesheet" type="text/css" href="../css/css.css">
<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='../css/hide.css'>";
?>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
		<div id="streifen" class="hide"></div>
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
				<li class="topmenu"><a href="../index.php">Friseurstudio</a>
					<ul>
						<li class="submenu"><a href="studio.php">Das Studio</a></li>
						<li class="submenu"><a href="team.php">Unser Team</a></li>
						<li class="submenu"><a href="dienstleistung.php">Dienstleistungen</a>
						</li>
						<li class="submenu"><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a>
						</li>
						<li class="submenu"><a href="kontakt.php">Kontakt</a></li>
					</ul>
				</li>
				<li class="topmenu"><a href="terminvergabe.php">Termine</a>
				</li>
				<li class="topmenu"><a href="Angebote.php">Angebote</a>
				</li>
				<li class="topmenu"><a href="#"> Produkte</a>
					<ul>
						<?php 
						$produktkategorie=$db->getAllProduktkategorie();


						foreach ($produktkategorie as $prod){

          echo umlaute_encode(" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>");
         }
         ?>
					</ul>
				</li>
				</li>
				<li class="topmenu"><a href="Galerie.php">Galerie</a>
				</li>
			</ul>
		</div>
		<?php }?>
		<div id="wrapper">
			<div id="textArea">

				<?php 
				if(isset($_GET['SVNr']))
				{
					$ma=$db->getMitarbeiter($_GET['SVNr']);
					echo "<table border='0'>";
						echo "<form method='post' enctype='multipart/form-data'>";
							echo "<tr><td>SozialversicherungsNr.:</td><td><input type='text' name='id' readonly value='".$_GET['SVNr']."' placeholder='".$_GET['SVNr']."'></td></tr>";
							echo "<tr><td>Vorname: </td><td><input type='text' name='vn'value='".$ma->getVorname()."' placeholder='".$ma->getVorname()."'></td></tr>";
							echo "<tr><td>Nachname: </td><td><input type='text' name='nn' value='".$ma->getNachname()."' placeholder='".$ma->getNachname()."'></td></tr>";
							echo "<tr><td>Motto:</td><td><input type='text' name='mo' value='".$ma->getMotto()."' placeholder='".$ma->getMotto()."'></td></tr>";
							echo "<tr><td>Profilbild:</td><td><input type='file' name='fileToUpload' id='fileToUpload'></td></tr>";
							echo "<tr><td><input type='submit' name='anlegenM' value='aktualisieren'></td></tr>";
						echo "</form>";
					echo "</table>";
				}
				if(isset($_GET['Email']))
				{
					$ku=$db->getKunde($_GET['Email']);	
					echo "<table border='0'>";
						echo "<form method='post' enctype='multipart/form-data'>";
							echo "<tr><td>E-Mail.:</td><td><input type='text' name='id' readonly value='".$_GET['Email']."' placeholder='".$_GET['Email']."'></td></tr>";
							echo "<tr><td>Vorname: </td><td><input type='text' name='vn'value='".$ku->getVorname()."' placeholder='".$ku->getVorname()."'></td></tr>";
							echo "<tr><td>Nachname: </td><td><input type='text' name='nn' value='".$ku->getNachname()."' placeholder='".$ku->getNachname()."'></td></tr>";
							echo "<td>Nachname: </td><td><input type='text' name='tel' value='".$ku->getTelNr()."' placeholder='".$ku->getTelNr()."'></td></tr>";
							echo "<tr><td>Profilbild:</td><td><input type='file' name='fileToUpload' id='fileToUpload'></td></tr>";
							
							$i=0;
							echo"<tr>";
							foreach ($db->getAllInteresse() as $int)
							{
								$i++;
									
								echo umlaute_encode("<td><input type='checkbox' name='".$int->getID()."'>".$int->getBezeichnung()." </input></td>");
									
								if ($i % 3 === 0) echo "</tr><tr>";
							}
							echo"</tr>";
							
							echo "<tr><td><input type='submit' name='anlegenK' value='aktualisieren'></td></tr>";
						echo "</form>";
					echo "</table>";
				}
					?>
			</div>
			<div id="werbungsbanner"></div>
		</div>
		<div id="footer" align="center" class="hide">
			<?php
			include("HTML/footer.html");
			?>
		</div>
	</div>
	</div>
</body>
</html>