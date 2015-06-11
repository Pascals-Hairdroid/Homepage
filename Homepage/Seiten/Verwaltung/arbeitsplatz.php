<?php 
include("../Anmeldung/authAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

if (isset($anlegen)){
	$ausstattungsarray=array();
	foreach ($db->getAllArbeitsplatzausstattung as $int)
	{
		if(	isset ($_GET[$int->getID()])){
			$int = new Arbeitsplatzausstattung($int->getID(),$int->getBeschreibung());
			$ausstattungsarray[]=$int;
		}
	}
	$arbeitsplatz=new Arbeitsplatz($_GET['id'], $_GET['name'], $ausstattungsarray);
	$erg=$db->arbeitsplatzEintragen($arbeitsplatz);
	
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
				<table border="0">
						<form method="get" action="">
							<tr><td>ID</td><td><input type="text" name="id" readonly
							<?php 
							$produkte=$db->getAllArbeitsplatz();
							$lastelement =count($produkte)+1;
							echo $lastelement;
							echo"value='$lastelement' placeholder='$lastelement'";
							?>/></td></tr>
							
							<tr><td>Arbeitsplatzname:</td><td><input name="naem" type="text" class="loginField"required = "required"></p></td></tr>
							
							<tr><td>Ausstattung:</td>
							<?php 
								echo"<select name='kategorie' size='1'>";
	 							echo "<td><option style='width:17ex;'value='Null'> Keine Auswahl </option></td>";
  								foreach ($db->getAllArbeitsplatzausstattung() as $kat)
  									echo "<td><option style='width:17ex;'value='".$kat->getID()."'>".$kat->getAustattung()." </option></td>";					
							?>
							
							<tr><td><input type="submit" value ="absenden" name="anlegen"></td>
							
						</form>
					</table>
					<?php
					if (isset($erg))
						echo $erg."<br />";
					?>
					<br />
			<table border="0">
				<?php
				

				echo "<tr><td>Arbeitsplatznummer.:</td><td>Arbeitsplatzname</td></tr>";

				foreach($db->getAllArbeitsplatz() as $arbeitsplatz){
							echo umlaute_encode("<tr><td>".$arbeitsplatz->getID()."</td><td>".$arbeitsplatz->getArbeitsplatzname()."</td><td>".$mitarbeiter->getNachname()."</td><td>".$mitarbeiter->getAdmin()."</td>");
							echo "<td><a href='maUpdate.php?SVNr=".$arbeitsplatz->getID()."'>Bearbeiten</a></td>";
							echo "<td><a href='maDelete.php?SVNr=".$arbeitsplatz->getID()."'>L&ouml;schen</a></td>";
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