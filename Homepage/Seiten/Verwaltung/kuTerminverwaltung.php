<?php
include ('../Methoden/sessionTimeout.php');
session_start();
include("../Anmeldung/auth.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
?>
<!DOCTYPE html>
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../../css/css.css">
	<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='../../css/hide.css'>";
?>
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
		
<!--		
		<meta name="MobileOptimized" content="350">
		

		<meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=5.0, minimum-scale=0.25, user-scalable=yes">
-->		
	</head>
	<body>
	<?php
		include("../Anmeldung/login.php");
		if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
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
			<div id="wrapper">
				<div id="textArea">
				<br>
					<?php
					include("terminAuswahl.php")
					?>
					<br>
					<iframe name="iframe" src="terminTabelle.php" style="width:100%;min-height:900px;height:1200px;padding:0px;margin:auto;" />
				</div>
				<div id="werbungsbanner">
				
				</div>
			</div>
			<div id="footer" align = "center">
				<?php
					include("../HTML/footer.html");
				?>
			</div>
		</div>
	</body>
</html>
