<?php
const KUNDE_BEARBEITEN_PAGING_EPP = 20; // HIER DEN WERT FÜR PAGING EINGEBEN!
include ('../Methoden/sessionTimeout.php');
include("../Anmeldung/authAdmin.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>

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
									<a href=""  class="selected">Personenverwaltung</a>
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
			<br/>
			<br/>
				<table border="0">
					<?php
						include("../../include_DBA.php");
						$db=new db_con("conf/db.php",true);

						echo "<tr><td>E-Mail Adresse</td><td>Vorname</td><td>Nachname</td><td>Tel.Nr.</td><td>Freigeschaltet</td></tr>";
						$kunden = $db->getAllKunde();
						$kuCount = count($kunden); 
						$pages = ceil($kuCount / KUNDE_BEARBEITEN_PAGING_EPP);
						if(isset($_GET["page"]))
							$page=$_GET["page"];
						else
							$page=1;
						$startI = ($page-1)*KUNDE_BEARBEITEN_PAGING_EPP;
						for($i=$startI;($i<$startI+KUNDE_BEARBEITEN_PAGING_EPP)&&($i<$kuCount);$i++){
							$kunde=$kunden[$i];
							echo umlaute_encode("<tr><td>".$kunde->getEmail()."</td><td>".$kunde->getVorname()."</td><td>".$kunde->getNachname()."</td><td>".$kunde->getTelNr()."</td><td>".($kunde->getFreischaltung()?"Ja":"Nein")."</td><td><a href='kuUpdate.php?Email=".$kunde->getEmail()."'>Bearbeiten</a></td></tr>")."\n";
						}
					?>
					</table>
					<br>
					<?php
						echo "<p>\n";
						if($page!=1)
							echo "<a href=\"?page=".($page-1)."\">Zur&uuml;ckbl&auml;ttern</a>&nbsp;&nbsp;&nbsp;";
						for($i=1;$i<=$pages;$i++){
							if($i!=$page)echo "<a href=\"?page=".$i."\">".$i."</a>&nbsp;&nbsp;&nbsp;";
							else 
								echo "<span id=\"currentpage\">".$i."</span>&nbsp;&nbsp;&nbsp;";
						}
						if($page<$pages)
							echo "<a href=\"?page=".($page+1)."\">Vorw&auml;rtsbl&auml;ttern</a>";
						echo "</p>\n"; 
					if($_GET['f']==1)echo "Kunde erfolgreich ver&auml;ndert!";
					?>
			</div>
			<div id="footer">
</div>
</div>	
</div>		
</body>
</html>