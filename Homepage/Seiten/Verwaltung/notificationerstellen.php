<?php 
include ('../Methoden/sessionTimeout.php');
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../../include_DBA.php");
include("../Methoden/getBrowser.php");
include("../Methoden/emailMe.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<script src="../../javascript/jquery.min.js"></script> 
    <script src="../../javascript/moment.js"></script> 
    <script src="../../javascript/combodate.js"></script> 
<script type="text/javascript">
$(function(){
    $('#bis').combodate();  
});
</script>
	<?php
	$interessenarray = array();
	foreach($db->getAllInteresse() as $int){
		if(isset ($_POST[$int->getID()]))
			$int = new Interesse($int->getID(),$int->getBezeichnung());
		$interessenarray[]=$int;
	}
	if(isset($_POST['submit']))
	{
    $abf = $db->query("SELECT werbung_nextval() FROM dual;");
    //var_dump($abf, mysqli_error($db->con));
      $lastelement=mysqli_fetch_row($abf)[0];
		if(isset($_FILES["fileToUpload"]["name"])&&$_FILES["fileToUpload"]["name"]!="")
      file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], NK_Pfad_Werbung_Bildupload_beginn.$lastelement.NK_Pfad_Werbung_Bild_mitte."0".NK_Pfad_Werbung_Bild_ende);
		
		//file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], dirname(__FILE__)."/../../Bilder/Werbung/".$lastelement.NK_Pfad_Werbung_Bild_mitte."0".NK_Pfad_Werbung_Bild_ende);
		
		$werbung=new Werbung($lastelement, $_POST['titel'], $_POST['text'], new Datetime($_POST['bis']), $interessenarray);
		$eingetragen = $db->werbungEintragen($werbung);
		$erg = "Werbung wurde gespeichert!";
	}
	if(isset($_POST['Email']))
	{
		$abf = $db->query("SELECT werbung_nextval() FROM dual;");
		//var_dump($abf, mysqli_error($db->con));
		$lastelement=mysqli_fetch_row($abf)[0];
		if(isset($_FILES["fileToUpload"]["name"])&&$_FILES["fileToUpload"]["name"]!=""){
			file_upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], NK_Pfad_Werbung_Bildupload_beginn.$lastelement.NK_Pfad_Werbung_Bild_mitte."0".NK_Pfad_Werbung_Bild_ende);
}
		else $file=null;
			
		$werbung=new Werbung($lastelement, $_POST['titel'], $_POST['text'], new Datetime($_POST['bis']), $interessenarray);
		$eingetragen = $db->werbungEintragen($werbung);
		
		//Lokales Testen
		//foreach ($db->getAllKunde() as $kun){
		//sendEmailNotification("ket14088@spengergasse.at", $_POST['titel'], $_POST['text'], "http://www.pascals.at/v2/Bilder/Werbung/".$lastelement."_0".NK_Pfad_Werbung_Bild_ende);
		//}
		
		foreach ($db->getAllKunde() as $kun){
		sendEmailNotification($kun->getEmail(), $_POST['titel'], $_POST['text'], "http://www.pascals.at/v2/Bilder/Werbung/".$lastelement."_0".NK_Pfad_Werbung_Bild_ende);
		}
		$erg = "Werbung wurde verschickt!";
	}

	
	?>

	<div id="container">
		<div class="hide" id="streifen"></div>
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
									<a href="">Studioverwaltung</a>
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
										<li><a href="terminBearbeiten.php">bearbeiten</a></li>
										<li><a href="statistik.php">Statistik</a></li>
									</ul>
								</li>
								<li class="items">
									<a href=""  class="selected">Benachrichtigungen</a>
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
		<?php
      if(isset($eingetragen)){
        echo "<br/>";
        if($eingetragen)
          echo "<h3>Werbung eingetragen.</h3>";
        else
          echo "<h3>Fehler beim eintragen der Werbung!</h3>";
        echo "<br/>";
      }
		?>
			<form action="" method="post" enctype="multipart/form-data">
				<p>
					Titel:<input type="text" name="titel" required="required">
				</p>
				<p>
					Text:<textarea rows="10" cols="20" name="text" ></textarea> <!-- style="height:100px"-->
				</p>
					
				<?php if($binfo!="Google Chrome"){?>
					<p>Bis: &nbsp;<input id="bis" data-format="DD-MM-YYYY HH:mm" data-template="DD / MM / YYYY     HH : mm"  value="<?php echo date('d-m-Y H:i');?>" type='date' name='bis'></input></p>
							<?php 
							}
							else{
							?>
				<p>
					G&uuml;ltig bis: <input type="datetime-local" name="bis">
				</p>
				<?php }?>
				<p>
					Werbungsbild: <input type="file" name="fileToUpload" id="fileToUpload">
				</p>
				<br>
				<p>
				<?php 
				$i=0;
				
				foreach ($db->getAllInteresse() as $int)
				{
					$i++;

					echo umlaute_encode("<input type='checkbox' name='".$int->getID()."'>".$int->getBezeichnung()." </input>");

					if ($i % 3 === 0) echo "</p><p>";
				}

				?>
				<br>
				<br>
				<input type="submit" value="Notification speichern" name="submit">
				<input type="submit" value="Notification und E-Mail verschicken" name="Email">
			</form>
			<?php
			if (isset($erg))
				echo $erg;
			?>
			
		</div>
		<div id="footer"></div>
	</div>
	</div>
</body>
</html>
