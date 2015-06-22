<?php 
include("../../include_DBA.php");
include("../Anmeldung/authMitarbeiterAdmin.php");
include("../Methoden/getBrowser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
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
    $('#von').combodate();  
});
$(function(){
    $('#bis').combodate();  
});
</script>

<?php

function urlaubEintragen($svnr,$von,$bis)
	{
		$db=new db_con("conf/db.php",true);
		if($svnr !=null &&$von !=null &&$bis !=null){
			$von2 = new DateTime($von);
			$bis2 = new DateTime($bis);
			$mitarbeiter=$db->getMitarbeiter($svnr);
			$urlaub=new Urlaub($von2, $bis2);
			
				
					
					$db->urlaubEintragen($urlaub, $mitarbeiter);
				
					
					return 'Urlaub erfolgreich eingetragen!';
				
			
		}	
	}
if(isset($_GET['submit']))
	$erg=urlaubEintragen($_GET['svnr'],$_GET['von'],$_GET['bis']);
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
						<br>
			
						<form method="GET" action="">
							<p>Mitarbeiter:
							<select name="svnr" onChange="settext(this.value)"></p>
							
							<?php 
							$db=new db_con("conf/db.php",true, "utf8");
							$Mitarbeiterarray=$db->getAllMitarbeiter();
							
							foreach ($Mitarbeiterarray as $ma){
							if(isset($_GET['svnr']))
							{
								if($ma->getSVNR()==$_GET['svnr'])
									$check=selected;
								else 
									$check=null;
							}

							echo umlaute_encode("<option value='".$ma->getSVNR()."'".$check.">".$ma->getVorname()." ".$ma->getNachname()."</option>");
							}
							
							  		
							?>
							</select>
							<?php if($binfo!="Google Chrome"){?>
							<p>Von:<input id="von" data-format="DD-MM-YYYY HH:mm" data-template="DD / MM / YYYY     HH : mm"  value="01-01-2015 00:00" type='date' name='von'></input></p>
							<p>Bis: &nbsp;<input id="bis" data-format="DD-MM-YYYY HH:mm" data-template="DD / MM / YYYY     HH : mm"  value="01-01-2015 01:00" type='date' name='bis'></input></p>
							<?php 
							}
							else{
							?>
							<p>Von:<input type='date' name='von'></input>
							Bis:<input type='date' name='bis'></input></p>	
							<?php }?>
							<input type="submit" value ="absenden" name="submit">
							<input type="submit" value ="Urlaube anzeigen" name="submit2">
							
						</form>
					
					<?php 
					if(isset($_GET['submit2'])){
					$tempMa=$db->getMitarbeiter($_GET['svnr']);
					$urlaub=$tempMa->getUrlaube();
					foreach ($urlaub as $u2){
			
					echo "<br>";
					echo "Urlaub von: ";
					echo $u2->getBeginn()->format('d.F Y H:i');
					echo " bis ";
					echo $u2->getEnde()->format('d.F Y H:i');
					echo " <a href='uDel.php?svnr=".$tempMa->getSvnr()."&von=".$u2->getBeginn()->format('d.F Y H:i')."&bis=".$u2->getEnde()->format('d.F Y H:i')."'>entfernen</a>";
						
					}
					
					
					}?>
					
					
					<?php
					
					
					if (isset($erg))
						echo $erg;
					?>
			</div>
			<div id="footer">
</div>
</div>		</div>	
</body>
</html>