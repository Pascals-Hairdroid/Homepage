<?php
include ('../Methoden/sessionTimeout.php');
include ('../Anmeldung/authAdmin.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<link  rel="stylesheet" type="text/css" href="../../css/css.css">
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
									<a href="" class="selected">Terminverwaltung</a>
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
		<?php
		date_default_timezone_set('Europe/Vienna');
		$jahr= date('Y');
		$woche2= date('W');
		$ddaw = date( "d.m.Y", strtotime($jahr."W".$woche2."2") ); // Dienstag der ausgewählten Woche
//Zeitberechnung
$sht;		//service + haartyp
$dl;		//dienstleistung
$br = null;		//pause
$gesamt;


include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true);

	if (isset($_SESSION['svnr'])){
		$mitarbeiter=$db->getMitarbeiter($_SESSION['svnr']);
		$mitarbeiterSvnr=$mitarbeiter->getSvnr();
		}
// var_dump($_SESSION, "svnr");
// $mitarbeiter = $ma->getSvnr();
// var_dump($mitarbeiterSvnr);
// echo "<br>";

// Datumsvariablen Definieren

$ddaw= new DateTime($ddaw);
$ddaw->modify('+660 minutes');
$von= clone $ddaw;
$mdaw= clone $ddaw;
$mdaw->add(new DateInterval('P1D'));
$dodaw= clone $mdaw;
$dodaw->add(new DateInterval('P1D'));
$fdaw= clone $dodaw;
$fdaw->add(new DateInterval('P1D'));
$sdaw= clone $fdaw;
$sdaw->add(new DateInterval('P1D'));


//Auslesen der Termine im Rahmen
$von1 = clone $von;
$bis1 = clone $von1;
$bis1->add(new DateInterval('P4DT7H45M'));
// 		echo "erster Termin: ".$von1->format('d.m.Y H:i')."";
// 		echo "<br>";
// 		echo "letzer Termin: ".$bis1->format('d.m.Y H:i')."";

foreach($db->getAllTermin($von1, $bis1) as $termine)
{
	// 				echo $termine->format('Y.m.d');
	// 				echo "<br>";
}


// $termin_array = $db->getAllTermin($von1, $bis1);
$termin_array = $db->getTermineZeitstempelVonMitarbeiter($mitarbeiter, $von1, $bis1);
// 		foreach($db->getTermineVonBis($von1, $bis1) as $termine)
	// 		{
	// 			var_dump($termine);
	// 		}

// var_dump($termin_array);

//Tabelle in einem
$i = 0;
$j=0;
$z1 = 11;
$z2 = 12;

echo "<form target='r_frame' method='get' action='termineintragen.php'>";

echo "<br>";
echo "<table border='1' id='zeittabelle'>";
echo "<tr height='50px'>";
echo "<th> Zeit </th>";
echo "<th> Dienstag ";
echo $ddaw->format('d.m.Y');
echo " </th>";
echo "<th> Mittwoch ";
echo $mdaw->format('d.m.Y');
echo "</th>";
echo "<th> Donnerstag ";
echo $dodaw->format('d.m.Y');
echo "</th>";
echo "<th> Freitag ";
echo $fdaw->format('d.m.Y');
echo "</th>";
echo "<th> Samstag ";
echo $sdaw->format('d.m.Y');
echo "</th>";
echo "</tr>";
while ($i < 8)
{
	echo "<tr>";
	echo "<td rowspan='4'>".$z1." bis ".$z2." </td>";

	while ($j < 4)
	{
		if($j != 0)
		{
			echo "<tr>";
		}
		if ($termin_array != null)
		{
			if (!in_array($ddaw, $termin_array))
				echo "<td>";
			else
				echo "<td style='background-color:yellow;'>";
			echo $ddaw->format('H:i');
			echo "</td>";
			if (!in_array($mdaw, $termin_array))
				echo "<td>";
			else
				echo "<td style='background-color:yellow;'>";
			echo $mdaw->format('H:i');
			echo "</td>";
			if (!in_array($dodaw, $termin_array))
				echo "<td>";
			else
				echo "<td style='background-color:yellow;'>";
			echo $dodaw->format('H:i');
			echo "</td>";
			if (!in_array($fdaw, $termin_array))
				echo "<td>";
			else
				echo "<td style='background-color:yellow;'>";
			echo $fdaw->format('H:i');
			echo "</td>";
			if (!in_array($sdaw, $termin_array))
				echo "<td>";
			else
				echo "<td style='background-color:yellow;'>";
			echo $sdaw->format('H:i');
			echo "</td>";
		}
		else
		{
			echo "<td>";
			echo $ddaw->format('H:i');
			echo "</td>";
			echo "<td>";
			echo $mdaw->format('H:i');
			echo "</td>";
			echo "<td>";
			echo $dodaw->format('H:i');
			echo "</td>";
			echo "<td>";
			echo $fdaw->format('H:i');
			echo "</td>";
			echo "<td>";
			echo $sdaw->format('H:i');
			echo "</td>";
			echo "</tr>";
		}
		$j++;
		$ddaw->modify('+15 minutes');
		$mdaw->modify('+15 minutes');
		$dodaw->modify('+15 minutes');
		$fdaw->modify('+15 minutes');
		$sdaw->modify('+15 minutes');
	}
	$i++;
	$j=0;
	$z1= $z1+1;
	$z2= $z2+1;
		
}
$bis= clone $sdaw;



echo "</form>";
echo "</table>";
// 		echo $von;
// 		echo $bis;
$svnr=2050200565;
$mitarbeiter= $db->getMitarbeiter($svnr);


		
		?>
		
<!-- 		<iframe name="r_frame" src="termineintragen.php" > </iframe> -->
		
		</div>
		<div id="footer">
</div>
		</div>
	</body> 
</html>
