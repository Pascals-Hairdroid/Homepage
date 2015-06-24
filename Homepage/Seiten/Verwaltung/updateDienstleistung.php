<?php 
include("../Anmeldung/authAdmin.php");
include("../../include_DBA.php");
$db=new db_con("conf/db.php",true);
$haartyp=$db->getHaartyp($_GET['haartyp']);
$dienstleistung=$db->getDienstleistung($_GET['Krzl'], $haartyp);
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
<?php
if(isset($_POST["submit2"])){
$skillarray = array();
$ausstattungsarray=array();
foreach($db->getAllSkill() as $skill)
	{
		if(isset ($_POST['s'.$skill->getID()])){
			$int = new Skill($skill->getID(),$skill->getBeschreibung());
		$skillarray[]=$skill;}
	}
foreach($db->getAllArbeitsplatzausstattung() as $int)
	{
		if(isset ($_POST['a'.$int->getID()])){
			$int = new Arbeitsplatzausstattung($int->getID(), $int->getName());
		$ausstattungsarray[]=$int;}
	}
	$dienstleistungNew=$dienstleistung;
	$dienstleistungNew->setName($_POST['name']);
	$dienstleistungNew->setBenoetigteEinheiten($_POST['einheiten']);
	$dienstleistungNew->setPausenEinheiten($_POST['pause']);
	$dienstleistungNew->setHaartyp($db->getHaartyp($_POST['laenge']));
	$dienstleistungNew->setArbeitsplatzausstattungen($ausstattungsarray);
	$dienstleistungNew->setSkills($skillarray);
	$dienstleistungNew->setGruppierung($_POST['group']);
	
	var_dump($dienstleistungNew);
	var_dump($db->dienstleistungUpdaten($dienstleistungNew));
	$erg="Dienstleistung eingetragen!";
	
}
	?>
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
									<a href=""  class="selected">Studioverwaltung</a>
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
						<form method="post" action="">
							<tr><td>K&uuml;rzel</td><td><input type="text" name="kuerzl" required="required"<?php echo "value='".$dienstleistung->getKuerzel()."'readonly"?>/></td></tr>
							<tr><td>Dienstleistungsname</td><td><input type="text" name="name" required="required"<?php echo "value='".$dienstleistung->getName()."'"?>/></td></tr>
							<tr><td>Haarl&auml;nge</td>
							<td>
							<?php 
								echo"<select name='laenge' size='1'>";
  								foreach ($db->getAllHaartyp() as $haartyp){
									if(in_array($haartyp,$dienstleistung->getHaartyp()))
										echo "<option selected='selected' style='width:17ex;'value='".$haartyp->getKuerzel()."'>".$haartyp->getBezeichnung()." </option>";
										else
  									echo "<option style='width:17ex;'value='".$haartyp->getKuerzel()."'>".$haartyp->getBezeichnung()." </option>";					
							}
  									?>
							</select></td></tr>
							<tr><td>Ben&ouml;tigte Einheiten</td><td><input type="text" name="einheiten" required="required" <?php echo "value='".$dienstleistung->getBenoetigteEinheiten()."'"?>/></td></tr>
							<tr><td>Pauseneinheiten</td><td><input type="text>" name="pause" required="required"<?php echo "value='".$dienstleistung->getPausenEinheiten()."'"?>/></td></tr>
							<tr><td>Gruppe</td><td><input type="text>" name="group" required="required" <?php echo "value='".$dienstleistung->getGruppierung()."'"?>/></td></tr>
							<tr><td>Skills:</td></tr><tr>
							<?php 
							$i=0;
							foreach($db->getAllSkill() as $skills)
							{
								
								$i++;
								if(in_array($skills,$dienstleistung->getSkills()))
									echo umlaute_encode("<td><input type='checkbox' name='s".$skills->getID()."' checked> ".$skills->getBeschreibung()." </input></td>");
									else
								echo umlaute_encode("<td><input type='checkbox' name='s".$skills->getID()."'> ".$skills->getBeschreibung()." </input></td>");
								
								if ($i % 4 === 0) echo "</tr><tr>";
							}
							
							
							?>
							</tr>
							<tr><td>Arbeitsplatzausstattung:</td></tr><tr>	
							<?php 	
							$i=0;
							foreach($db->getAllArbeitsplatzausstattung() as $ausstattung)
							{
								
								$i++;
								if(in_array($ausstattung,$dienstleistung->getArbeitsplatzausstattungen()))
									echo umlaute_encode("<td><input type='checkbox' name='a".$ausstattung->getID()."'checked> ".$ausstattung->getName()." </input></td>");
									else
								echo umlaute_encode("<td><input type='checkbox' name='a".$ausstattung->getID()."'> ".$ausstattung->getName()." </input></td>");
								
								if ($i % 4 === 0) echo "</tr><tr>";
							}
							
							
							?>
							<tr><td><input type="submit" value ="absenden" name="submit2"></td>
							
						</form>
					</table>
			</div>
			<div id="footer">
</div></div>
</div>			
</body>
</html>