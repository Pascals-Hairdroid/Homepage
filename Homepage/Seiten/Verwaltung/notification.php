<?php 
include ('../Methoden/sessionTimeout.php');
include("../Anmeldung/authAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
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
			<?php
			if(isset($_GET["del"]) && isset($_GET["nummer"])){
        if(isset($_SESSION[L_ADMIN])&&$_SESSION[L_ADMIN])
          if($db->werbungEntfernen($db->getWerbung($_GET["nummer"])))
            echo "<h3>Werbung gel&ouml;scht.</h3>";
          else
            echo "<h3>Fehler beim l&ouml;schen!</h3>";
        else
          echo "<h3>Keine Berechtigung!</h3>";
        $_GET["nummer"] = null;
      }
			if(!isset($_GET['nummer'])){
        foreach($db->getAllWerbung() as $werbung){
          echo "<div id='werbungsbox'>";
          echo "<br/><br/>";
          echo "<span style=\"font-weight:bold;\">".umlaute_encode($werbung->getTitel())."</span>";
          echo"<br>";
          echo umlaute_encode($werbung->getText());
          echo "<br/>";
          foreach($werbung->getFotos() as $foto)
          echo "<img src=\"".$foto."\" height=\"200px\"/>";
          echo "<br/>";
          echo "<a style='padding-right:15px' href=\"notification.php?del=1&nummer=".$werbung->getNummer()."\">L&ouml;schen</a>";
          echo "<a href=\"notificationUpdate.php?Nr=".$werbung->getNummer()."\">Bearbeiten</a>";
          echo "</div>";
        }
			}
			else{
			$werbung=$db->getWerbung($_GET['nummer']);
			echo $werbung->getTitel();
			echo"<br>";
			echo $werbung->getText();
			echo "<a href=\"notificationUpdate.php?nummer=".$werbung->getNummer()."\">Bearbeiten</a>";
			}
			?>
			</div>
			<div id="footer">
</div></div>
</div>			
</body>
</html>