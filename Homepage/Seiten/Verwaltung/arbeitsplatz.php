<?php 
include("../Anmeldung/authAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

$ausstattung = array();
foreach($db->getAllArbeitsplatzausstattung() as $int){
	if(isset($_GET[$int->getID()])){
		$int = new Arbeitsplatzausstattung($int->getID(), $int->getName());
		$ausstattung[]=$int;
	}
}
if(isset($_GET['arbeitsplatz']))
{

	$produkte=$db->getAllArbeitsplatz();
	$lastelement =count($produkte)+1;


$arbeitsplatz=new Arbeitsplatz($lastelement, $_GET['name'], $ausstattung);
$db->arbeitsplatzEintragen($arbeitsplatz);
$erg="Arbeitsplatz erfolgreich angelegt";
}

if(isset($_GET['arbeitsplatzausstattung']))
{

	$produkte=$db->getAllArbeitsplatzausstattung();
	$lastelement =count($produkte)+1;

	$arbeitsplatzausstattung=new Arbeitsplatzausstattung($lastelement, $_GET['name']);
	$db->arbeitsplatzausstattungEintragen($arbeitsplatzausstattung);
	$erg="Arbeitsplatzausstattung erfolgreich angelegt";
}
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
				<div id="arbeitspaltz">
				Arbeitsplatz hinzuf&uuml;gen:<br>
					<table border="0">
						<form method='get'>
						<tr>
						<td>
							<tr>
								<td>Arbeitsplatznummer:</td>
								<td><input type="text" name="id" readonly
								<?php 
								$produkte=$db->getAllArbeitsplatz();
								$lastelement =count($produkte)+1;
								echo $lastelement;
								echo"value='$lastelement' placeholder='$lastelement'";
								?>/></td></tr>
								
								<tr><td>Arbeitsplatzname:</td><td><input name="name" type="text" class="loginField"required = "required"></p></td></tr>
								
								<tr><td>Ausstattung:</td></tr><tr>
								<?php 
								$i=0;
								foreach ($db->getAllArbeitsplatzausstattung() as $int){
									$i++;
	
									echo umlaute_encode("<td><input type='checkbox' name='".$int->getID()."'>".$int->getName()." </input></td>");
	
									if ($i % 2 === 0) echo "</tr><tr>";
					}	
	  								?>
	  								
									</tr><tr><td><input type="submit" value ="anlegen" name="arbeitsplatz"></td></tr>
								
							</form>
						</table>
					</div>
					<div id="Arbeitsplatzausstattung">
					Arbeitsplatzausstattung hinzuf&uuml;gen:<br>
					<table border="0">
					<form method='get'>
							<tr>
								<td>Ausstattungs ID:</td>
								<td><input type="text" name="id" readonly
								<?php 
								$produkte=$db->getAllArbeitsplatzausstattung();
								$lastelement =count($produkte)+1;
								echo $lastelement;
								echo"value='$lastelement' placeholder='$lastelement'";
								?>/></td></tr>
								
								<tr><td>Ausstattung:</td><td><input name="name" type="text" class="loginField"required = "required"></p></td></tr>
								
								<tr><td><input type="submit" value ="anlegen" name="arbeitsplatzausstattung"></td></tr>
								
							</form>
						</table>
						
					</div>
					
					
					
					<br />
					<?php
						if (isset($erg))
							echo $erg."<br />";
						?>
							<table border="0">
							
				<?php
				

				echo "<tr><td>Arbeitsplatznummer.:</td><td>Arbeitsplatzname</td><td>Ausstattung</td></tr>";

				foreach($db->getAllArbeitsplatz() as $arbeitsplatz){
							echo umlaute_encode("<tr><td>".$arbeitsplatz->getNummer()."</td><td>".$arbeitsplatz->getName()."</td><td>");
							
							foreach ($arbeitsplatz->getAusstattung() as $aus)
								echo umlaute_encode($aus->getName()."<br>");
							echo "</td>";
							
							echo "<td><a href='aUpdate.php?Nr=".$arbeitsplatz->getNummer()."'>Bearbeiten</a></td>";
							echo "<td><a href='aDelete.php?Nr=".$arbeitsplatz->getNummer()."'>L&ouml;schen</a></td>";
							echo"</tr>";
						}
						?>
					</table>
					
			</div>
			<div id="footer">
</div></div>
</div>			
</body>
</html>