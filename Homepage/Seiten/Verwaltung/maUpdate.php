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
		$mitarbeiter=new Mitarbeiter($svnr, $vn, $nn, $skills, $admin, $urlaube, $dienstzeiten);
		$db->mitarbeiterUpdaten($mitarbeiter);

		return true;
	}
	else
		return false;
}

$tempMa=$db->getMitarbeiter($_GET['SVNr']);
	$vn=$tempMa->getVorname();
	$nn=$tempMa->getNachname();
	$admin=$tempMa->getAdmin();
	
	
	
if(isset($_GET['submit'])){
		$svnr=$_GET['SVNr'];
		$vn=$_GET['vn'];
		$nn=$_GET['nn'];
		$skills=$tempMa->getSkills();
		$urlaube=$tempMa->getUrlaube();
		$dienstzeiten=$tempMa->getDienstzeiten();
		$admin=false;
		if(isset($_GET['admin'])){
		if ($_GET['admin']=="on") {
			$admin=true;
		}
		}
		maUpdate($svnr, $vn, $nn, $skills, $admin, $urlaube, $dienstzeiten);
	}	

			
		
if(isset($_POST['submit'])){

}
	
?>
<div id="main">
			<div id="head">
				<h1>PASCALS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HAIRSTYLE</h1>
		<h2>weil Deine Haare den Meister verdienen</h2>		
		<img src="../../Bilder/Homepage/Logo.png"> 
			</div>
			<div id="menuVerwaltung">
			
		<ul>		
			<li class="topmenu1"><a href="">Mitarbeiterverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="maAnlegen.php">Mitarbeiter anlegen</a></li>
					  <li class="submenu1"><a href="maBearbeiten.php">Mitarbeiter bearbeiten</a></li>
				</ul>
			</li>
		  <li class="topmenu1"><a href="">Kundenverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="kuAktivieren.php">Kunde freischalten</a></li>
					  <li class="submenu1"><a href="kuBearbeiten.php">Kunde bearbeiten</a></li>
				</ul>
			</li>
		  <li class="topmenu1"><a href="">Terminverwaltung</a>
				<ul>
					  <li class="submenu1"><a href="terminAnzeigen.php">Termine anzeigen</a></li>
					  <li class="submenu1"><a href="terminBearbeiten.php">Termine bearbeiten</a></li>
				</ul>
			</li>
		</ul>
			</div>
			<div id="textArea">
			<table border="0">
						<form method="get" action="">
							<tr><td>Sozialversicherungsnummer:</td><td><input name="SVNr" type="input" class=loginField"required = "required"
							<?php echo "value='".$_GET['SVNr']."'"; ?>></p></td></tr>
							
							<tr><td>Vorname:</td><td><input name="vn" type="text" class="loginField"required = "required"
							<?php echo "value='".$vn."'"; ?>></p></td></tr>
							
							<tr><td>Nachname:</td><td><input name="nn" type="text" class="loginField"required = "required"
							<?php echo "value='".$nn."'"; ?>></p></td></tr>
							
							<tr><td>Admin:</td><td><input name="admin" type="checkbox"  class="loginField"
							<?php 
							if ($admin == 1) {
								echo "checked";
							}
							?>></p></td></tr>
										
							<tr><td><input type="submit" value ="absenden" name="submit"></td>
							
						</form>
					</table>
					<?php
					if (isset($erg))
						echo $erg;
					?>
			</div>
			<div id="footer">
</div>
</div>			
</body>
</html>