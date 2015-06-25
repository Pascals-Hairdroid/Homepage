<?php 
include_once 'statistikTermine_const.php';
include ('../Methoden/sessionTimeout.php');
include("../Anmeldung/authAdmin.php");

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
<?php include 'statistikTermine.php'; ?>
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
		</h1></a> 	
		
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
			<p>Statistik Termine</p>
				<?php
					$admin = isset($_SESSION[L_ADMIN])?$_SESSION[L_ADMIN]:false; 
					if(isset($_GET['f'])||!isset($_SESSION['svnr']))
					{
						if ($_GET['f']==1) echo "Sie haben keine Berechtigung auf den Zugriff dieser Seite!";
					}else{
						echo "\n<form method=\"GET\" action=\"statistik.php\"><table border=\"0\"><tr><td>Von: </td><td><input type=\"text\" name=\"".VON."\" value=\"".$von->format(FORMAT_DAY)."\"></td></tr><tr><td>Bis: </td><td><input type=\"text\" name=\"".BIS."\" value=\"".$bis->format(FORMAT_DAY)."\"></td></tr>".($admin?"<tr><td>Mitarbeiter: </td><td><input type=\"text\" name=\"".SVNR."\" value=\"".ALL_MA."\"></td></tr>":"")."<tr><td></td><td><input type=\"submit\" value=\"Generieren\"></table></form>\n";
					}
					if(isset($output))
						echo "<br/>\n<br/>\n<p>".$output."</p>\n";
					//var_dump($von, $bis);
					//echo "<br/>\n";
					//var_dump($auslastung,$var_dump_gewohnheiten , $gewohnheiten, $lines);
						
				?>
				<br/>
				<br/>
				<div id="chart_kundengewohnheiten"></div>
				<br/>
				<br/>
				<div id="chart_auslastung"></div>
			</div>
			<div id="footer">
</div></div>
</div>			
</body>
</html>