<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../../include_DBA.php");
include("../Methoden/getBrowser.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
    <script src="../../javascript/jquery.min.js"></script> 
    <script src="../../javascript/moment.js"></script> 
    <script src="../../javascript/combodate.js"></script> 
<script>
$(function(){
    $('#time').combodate({
        firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 15
    });  
});

$(function(){
    $('#time2').combodate({
        firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 15
    });  
});
</script>
</head>
<body>
<?php

function zeitEintragen($svnr,$von,$bis,$tag)
	{
		$db=new db_con("conf/db.php",true);
		if($svnr !=null &&$von !=null &&$bis !=null &&$tag !=null){
			$von2 = DateTime::createFromFormat('H:i',$von);
			$bis2 = DateTime::createFromFormat('H:i',$bis);
			$mitarbeiter=$db->getMitarbeiter($svnr);
			$wochentag=$db->getWochentag($tag);
			
			
			if($von > $bis){ return 'Bis-Zeit liegt vor der Vor-Zeit';}
				if($db->getDienstzeit($mitarbeiter, $wochentag)){
					$dienstzeit = new Dienstzeit($wochentag, $von2, $bis2);
					$db->dienstzeitUpdaten($dienstzeit, $mitarbeiter);
					return 'Zeit erfolgreich ver&auml;ndert';
					}
				else 
				{
					$dienstzeit = new Dienstzeit($wochentag, $von2, $bis2);
					$db->dienstzeitEintragen($dienstzeit, $mitarbeiter);
					return 'Zeit erfolgreich eingetragen';
				}
			}
	
				
			
		}	
	
if(isset($_GET['submit'])){
	try{
if($_GET['von'] != "" && $_GET['bis'] != "")
	$erg=zeitEintragen($_GET['svnr'],$_GET['von'],$_GET['bis'],$_GET['tag']);
else $erg="Bitte f&uuml;llen Sie alle Felder aus!";
		}
		catch (Exception $e)
		{
			echo 'Die Dienstzeit ist ung&uuml;ltig: ',  $e->getMessage(), "\n";
		}
}
?>

	<div id="container">
<div class ="hide" id="streifen"></div><div id="main">
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
									<a href="" class="selected">Personenverwaltung</a>
									<ul>
										<li><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
										<li ><a href="maBearbeiten.php">Mitarbeiter bearbeiten</a></li>
										<li ><a href="zeiten.php">Dienstzeiten</a></li>
										<li ><a href="urlaub.php">Urlaube</a></li>
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
			
						<form method="get" action="">
							<p>Mitarbeiter:
							<select name="svnr" onChange="settext(this.value)"></p>
							
							<?php 
							$Mitarbeiterarray=$db->getAllMitarbeiter();
							
							foreach ($Mitarbeiterarray as $ma){
							if(isset($_GET['svnr']))
							{
								if($ma->getSVNR()==$_GET['svnr'])
									$check=selected;
								else 
									$check=null;
							}

							echo "<option value='".$ma->getSVNR()."'".$check.">".$ma->getVorname()." ".$ma->getNachname().
							"</option>";
							}
							
							  		
							?>
							</select>
							<br><br>
							<?php 
							if($binfo!="Google Chrome"){
							?><p>Von:<input id="time" data-format="HH:mm" data-template="HH : mm"  type='time' name='von' value="08:00"></p></input>
							<p>Bis: &nbsp;<input id="time2" data-format="HH:mm" data-template="HH : mm"  type='time' name='bis' value="19:00"></p></input>  
							<?php 
							}
							else{?>
							<p>Von:<input type='time' name='von'></p></input>
							<p>Bis: &nbsp;<input type='time' name='bis'></p></input>  
							<?php 
							}?>
							<p>Tag: <select name="tag">
								<option value="MO">Montag</option>
								<option value="DI">Dienstag</option>
								<option value="MI">Mittwoch</option>
								<option value="DO">Donnerstag</option>
								<option value="FR">Freitag</option>
								<option value="SA">Samstag</option>							
							</select></p>		
							<br>	
							<input type="submit" value ="absenden" name="submit">
							<input type="submit" value ="Dienstzeiten anzeigen" name="submit2">
							
						</form>
					
					<?php 
					if (isset($_GET['submit']))
						echo $erg;
					if(isset($_GET['submit2'])){
					$wochentage = array("Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag");
	

					$tempMa=$db->getMitarbeiter($_GET['svnr']);
					$dienstzeit=$tempMa->getDienstzeiten();
					foreach ($dienstzeit as $dz){
					$tempMa=$db->getMitarbeiter($_GET['svnr']);
					echo "<br>";
					echo $dz->getWochentag()->getKuerzel();
					echo " ";
					echo Date_format($dz->getBeginn(),'H:i');
					echo " - ";
					echo Date_format($dz->getEnde(),'H:i');
					echo " <a href='dDel.php?svnr=".$tempMa->getSvnr()."&tag=".$dz->getWochentag()->getKuerzel()."&von=".$dz->getBeginn()->format('H:i')."&bis=".$dz->getEnde()->format('H:i')."'>entfernen</a>";
					} 
					}
					
					
					?>
			</div>
			<div id="footer">
</div>
</div>		</div>	
</body>
</html>