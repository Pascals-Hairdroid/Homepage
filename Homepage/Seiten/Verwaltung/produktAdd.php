<?php 
include ('../Methoden/sessionTimeout.php');
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$produkte=$db->getAllProdukt();

$abf= $db->query("SELECT MAX( ID ) FROM produkte");
$lastelement = mysqli_fetch_row($abf)[0]+1;

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
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
include("../Anmeldung/login.php");
if(isset($_POST["submit2"])){

	file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], NK_Pfad_Produkt_Bildupload_beginn.$lastelement.NK_Pfad_Produkt_Bild_ende,true);



	$produktkat=$db->getProduktkategorie($_POST['kategorie']);
 	$produkt=new Produkt($lastelement, $_POST['name'],$_POST['hersteller'], $_POST['beschreibung'], $_POST['preis'], $_POST['bestand'], $produktkat);	
 
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
											echo"<label><a href='#'> Forgot Password </a></label>";
										echo"</fieldset>";
									echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='../Anmeldung/endSession.php'>Logout</span></a>";
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
							echo"><a href='../Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='../../index.php'>Homepage</a></li>";
							}
													
							
							}
							else{
								echo"<li id='signup'>";
								echo"<a href='../registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>
							
						</ul>
					</nav>
			</div>							
			<div id="head">
			<?php 
				include ("../HTML/Verwaltungheader.html"); 
				?>
		
			</div>
			<div id="hmenu">		
					<nav id="menu" class="hide">
							<ul>
								<li  class="items">
									<a href="">Personenverwaltung</a>
									<ul>
										<li><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
										<li ><a href="maBearbeiten.php">Mitarbeiter bearbeiten</a></li>
										<li ><a href="zeiten.php">Dienstzeiten</a></li>
										<li ><a href="urlaub.php">Abwesenheiten</a></li>
									</ul>
								</li>
								<li class="items">
									<a href=""  class="selected">Studioverwaltung</a>
									<ul>
										<li><a href="produktAdd.php">Produkte hinzuf&uuml;gen</a></li>
										<li><a href="dienstleistungAdd.php">Dienstleistungen bearbeiten</a></li>
										<li><a href="arbeitsplatz.php">Arbeitspl&auml;tze bearbeiten</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Terminverwaltung</a>
									<ul>
										<li><a href="terminAnzeigen.php">anzeigen</a></li>
										<li><a href="kuTerminvergabe.php">hinzuf&uuml;gen</a></li>
										<li><a href="kuTerminverwaltung.php">bearbeiten</a></li>
										<li><a href="statistik.php">Statistik</a></li>
									</ul>
								</li>
								<li class="items">
									<a href="">Benachrichtigungen</a>
									<ul>
										<li><a href="notificationerstellen.php">erstellen</a></li>
										<li><a href="notification.php">bearbeiten</a></li>
									</ul>
								</li>
								<li class="spacer"></li>
							</ul>
						</nav>
				</div>
			<div id="textArea">
				<table border="0">
						<form method="post" action="" enctype='multipart/form-data'>
							<tr><td>Name</td><td><input type="text" name="name" required="required"/></td></tr>
							<tr><td>Hersteller</td><td><input type="text" name="hersteller" required="required"/></td></tr>
							<tr><td>Beschreibung</td><td><input type="text>" name="beschreibung" required="required"/></td></tr>
							<tr><td>Preis</td><td><input type="text>" name="preis" required="required"/></td></tr>
							<tr><td>Bestand</td><td><input type="text>" name="bestand" required="required"/></td></tr>
							<tr><td>Bild</td><td><input type="file" name="fileToUpload" id='fileToUpload' required="required"/></td></tr>
							<tr><td>Produktkategorie</td>
							<td>
							<?php 
								echo"<select name='kategorie' size='1' required>";
// 	 							echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  								foreach ($db->getAllProduktkategorie() as $kat)
  									echo umlaute_encode("<option style='width:17ex;'value='".$kat->getKuerzel()."'>".$kat->getBezeichnung()." </option>");					
							?>
							</select></td></tr>
							</tr>
							<tr><td><input type="submit" value ="absenden" name="submit2"></td>
							
						</form>
					</table>
			</div>
			<div id="footer">
</div></div>
</div>			
</body>
</html>