<?php 
include("../Anmeldung/authMitarbeiterAdmin.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/css.css">
</head>
<body>
<?php
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

function maUpdate($svnr, $vn, $nn, $skills, $admin, $urlaube, $dienstzeiten)
{
	if($svnr != null){
				
		$db=new db_con("conf/db.php",true);
		$mitarbeiter=new Mitarbeiter($svnr, $vn, $nn, null,$skills, $admin, $urlaube, $dienstzeiten);
		$db->mitarbeiterUpdaten($mitarbeiter);

		return true;
	}
	else
		return false;
}
$tempMA = $db->getMitarbeiter($_GET['SVNr']);
$admin=$tempMA->getAdmin();
$skillarray = array();
if(isset($_GET['submit'])){
	foreach ($db->getAllSkill() as $int)
	{
		if(	isset ($_GET[$int->getID()])){
		$int = new Skill($int->getID(),$int->getBeschreibung());
		$skillarray[]=$int;}
	}
	
		
	
		$svnr=$_GET['SVNr'];
		$vn=$_GET['vn'];
		$nn=$_GET['nn'];
		
		$urlaube=$tempMA->getUrlaube();
		$dienstzeiten=$tempMA->getDienstzeiten();
		$admin=false;
		if(isset($_GET['admin'])){
		if ($_GET['admin']=="on") {
			$admin=true;
		}
		}
		
		maUpdate($svnr, $vn, $nn, $skillarray, $admin, $urlaube, $dienstzeiten);
	}	

			
		
if(isset($_POST['submit'])){

}
	
?>

<div id="container">
	<div class ="hide" id="streifen"></div>
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
					<a href="#" style="color:black;"><h1>PASCALS<img src="../../Bilder/Homepage/Logo.png">HAIRSTYLE</h1>
					<h2>Frisuren zum Wohlf&uuml;hlen</h2>	</a>	
			
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
						<form method='get' action=''>
						<table border="0">
							<tr><td><p>Sozialversicherungsnummer:</td><td><input name="SVNr" type="input" class=loginField" readonly
							<?php echo "value='".$_GET['SVNr']."'"; ?>></p></td></tr>
							
							<tr><td><p>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php echo "value='".$_GET['vn']."'"; ?>></p></td></tr>
							
							<tr><td><p>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php echo "value='".$_GET['nn']."'"; ?>></p></td></tr>
							
							<tr><td>Admin:<input name="admin" type="checkbox"  class="loginField"
							<?php if ( $admin == 1) echo "checked";	?>></td></tr>
							<?php 
														
							$i=0;
							echo "<br>";
							Echo"<tr>";
							foreach ($db->getAllSkill() as $int)
							{
								$i++;
								if(in_array($int,$tempMA->getSkills()))
								echo umlaute_encode("<td><input type='checkbox' name='".$int->getID()."' checked></input></td><td>".$int->getBeschreibung()."</td>");
								else
								echo umlaute_encode("<td><input type='checkbox' name='".$int->getID()."'></input></td><td>".$int->getBeschreibung()."</td>");
								
								
							
								if ($i % 3 === 0) echo "</tr></td><tr><td>";
							}
							
						
							
							?></tr>
										
							<tr><td><input type="submit" value ="absenden" name="submit"></td>	
						</table>
						</form>
						<?php
						if (isset($erg))
							echo $erg;
						?>
				</div>
				<div id="footer">
				</div>
			</div>	
		</div>
	</div>	
</body>
</html>