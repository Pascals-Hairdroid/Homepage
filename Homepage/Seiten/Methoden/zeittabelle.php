<?php session_start();
	include_once("../../include_DBA.php");
	$db=new db_con("conf/db.php",true, "utf8");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link  rel="stylesheet" type="text/css" href="../../css/css.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<script type="text/javascript">$(document).ready(function(){
				$(".zeiteinheit").click(function(e){$("input[name='date']").val(e.currentTarget.dataset.time);});
			});
		</script>
		<script>
			function chkFormular () 
			{
				if (document.form.date.value > $now) {
					alert("Der Termin muss in der Zukunft liegen!");
					document.form.date.focus();
					return false;
				}
			}
		</script>
		
<!-- 		<meta name="MobileOptimized" content="320"> -->
<!-- 		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"> -->

	</head>
	<body>
		<?php
	if (isset($_SESSION['email'])){
		$kunde=$db->getKunde($_SESSION['email']);
		$kunde2=($kunde->getEmail());
		
	}
	if (isset($_SESSION['svnr'])){
		$mitarbeiter=$db->getMitarbeiter($_SESSION['svnr']);
// 		var_dump($mitarbeiter);
	}
	
		
		$haarlaenge=$_GET["haarlaenge"];
		$dienstleistung=$_GET["dienstleistung"];
		$dienstleistung2=$_GET["dienstleistung2"];
//		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		
// 		var_dump($dienstleistung, $dienstleistung2, $haarlaenge);
		
				
		
		$dienstleistungen = array();
			if(isset($haarlaenge))
			{
				if (isset($dienstleistung))
					array_push($dienstleistungen, $db->getDienstleistung($dienstleistung, new Haartyp($haarlaenge, "")));
				if (isset($dienstleistung2))
					array_push($dienstleistungen, $db->getDienstleistung($dienstleistung2, new Haartyp($haarlaenge, "")));
			}
		
		$dienstleistungenKuerzel= array();
			foreach($dienstleistungen as $ds)
				array_push($dienstleistungenKuerzel, $ds->getKuerzel());
// 			var_dump($dienstleistungenKuerzel);
					
		if($dienstleistung != "Null" && $dienstleistung2 != "Null")
		{
			$hackler = $db->getNotFreeMitarbeiterMitSkills($dienstleistungenKuerzel);
			echo "Mitarbeiter:";
			var_dump($hackler);
		}
		
		if($dienstleistung != "Null" && $dienstleistung2 != "Null")
		{
			$echteHackler = $db->getMitarbeiterMitSkills($dienstleistungenKuerzel);
			echo "echte Mitarbeiter:";
			var_dump($echteHackler);
		}
		
		if($dienstleistung != "Null" && $dienstleistung2 != "Null")
		{
			var_dump($dienstleistungenKuerzel);
			$arbeitsplatz = $db->getArbeitsplatzMitAusstattung($dienstleistungenKuerzel);
			
			echo "guade Arbeitsplätze:";
			var_dump($arbeitsplatz);
		}
		
		
		if (isset($_GET["schneiden"]))
			$schneiden="ja";
		else 
			$schneiden="nein";
		
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		
		
		//Mitarbeiter + Skill abfrage
		

		
		//Zeitberechnung
		$sht;		//service + haartyp
		$dl;		//dienstleistung
		$br = null;		//pause
		$gesamt;
		
		
		if (strlen($woche) ==8)
		{
			
			$jahr= substr($woche, 0, 4);
			$woche2= substr($woche, 6, 2);
			$ddaw = date( "d.m.Y", strtotime($jahr."W".$woche2."2") ); // Dienstag der ausgewählten Woche
			//echo $ddaw;
			echo "<br>";			

		}
		else
		{
			
			$tag = substr($woche, 3, 2);;
			$monat = substr($woche, 0, 2);
			$jahr = substr($woche, 6, 4); 
			$tag2 = new DateTime();
			$tag2->setDate($jahr, $monat, $tag);
			$week =  $tag2->format('W');
			if ($tag2->format('l') == 'Sunday')
			{
				$week = $week+1;
			}
			$ddaw = date( "d.m.Y", strtotime($jahr."W".$week."2") ); // Dienstag der ausgewählten Woche
			echo "<br>";
		}
		
		
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
		
		
		
		
		//ArbeitsplatzOK suchen
		
// 		if (isset($dienstleistungen))
// 		{
// 			$arbeitsplatzOK = $db->checkArbeitsplatzFree($von1, $bis1, $dienstleistungen);
// 			$boolArbeitsplatzOK = count($arbeitsplatzOK)==0?false:true;
// 			var_dump($arbeitsplatzOK, $boolArbeitsplatzOK);
// 		}	
		
		
		foreach($db->getAllTermin($von1, $bis1) as $termine)
		{
// 				echo $termine->format('Y.m.d');
// 				echo "<br>";
		}
		$termin_array = $db->getAllTermin($von1, $bis1);
// 		foreach($db->getTermineVonBis($von1, $bis1) as $termine)
// 		{
// 			var_dump($termine);
// 		}
// 		foreach($db->getAllArbeitsplatz() as $arbeitsplatz)
// 				{
// 					echo $arbeitsplatz->getName();
// 					echo "<br>";
// 				}
		if (isset($dienstleistungen))
		{		
			$arbeitsplatzl = $db->getNotFreeArbeitsplatzMitAustattungen($dienstleistungenKuerzel);
			echo "Arbeitsplatzl:";
			var_dump($arbeitsplatzl);
		}
		
		if (isset($dienstleistungen))
		{
			$arbeitsplaetze = $db->getArbeitsplaetzeFuerDienstleistung($dienstleistungen);
			// 			var_dump($arbeitsplaetze, $von1, $bis1);
			$plaetze = array($db->getBelegteZeitenVonArbeitsplaetzen($von1, $bis1, $arbeitsplaetze));
			// 			echo "<h1> ".var_dump($plaetze)." </h1>";
		}
		
		if($dienstleistung != "Null" && $dienstleistung2 != "Null")
			$skills = array($db->getSkillFuerDienstleistung($dienstleistungenKuerzel));
		echo "Skills";
		var_dump($skills);
	
		//Tabelle in einem
		$i = 1;
		$j=1;
		$z1 = 11;
		$z2 = 12;
		$arraydi= array((string)$ddaw->format('d.m.Y H:i'));
		$arraymi= array((string)$mdaw->format('d.m.Y H:i'));
		$arraydo= array((string)$dodaw->format('d.m.Y H:i'));
		$arrayfr= array((string)$fdaw->format('d.m.Y H:i'));
		$arraysa= array((string)$sdaw->format('d.m.Y H:i'));
// 		$array = array(1, "hello", 1, "world", "hello");
// 		print_r(array_count_values($termin_array));
		
		echo "<form target='r_frame' method='get' action='termineintragen.php'>";
		
		echo "<input type='text' name='haarlaenge' value='".$haarlaenge."' hidden='true'>";
		echo "<input type='text' name='dienstleistung' value='".$dienstleistung."' hidden='true'>";
		echo "<input type='text' name='dienstleistung2' value='".$dienstleistung2."' hidden='true'>";
		


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
		while ($i < 9)
		{
			echo "<tr>";
			echo "<td rowspan='4'>".$z1." bis ".$z2." </td>";
	
			while ($j < 5)
			{
				if($j != 1)
				{
					echo "<tr>";
				}	
// 				if ($termin_array != null)
// 				{
// 					if (count(array_intersect($arraydi, $termin_array)) > 1)
// 						echo "<td>";
// 					else 
// 						echo "<td style='background-color:red;'>";
// 					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$ddaw->format('H:i')."</a>";
// 					echo "</td>";
// 					if (count(array_intersect($arraymi, $termin_array)) > 1)
// 						echo "<td>";
// 					else
// 						echo "<td style='background-color:red;'>";
// 					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$mdaw->format('H:i')."</a>";
// 					echo "</td>";
// 					if (count(array_intersect($arraydo, $termin_array)) > 1)
// 						echo "<td>";
// 					else
// 						echo "<td style='background-color:red;'>";
// 					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$dodaw->format('H:i')."</a>";
// 					echo "</td>";
// 					if (count(array_intersect($arrayfr, $termin_array)) > 1)
// 						echo "<td>";
// 					else
// 						echo "<td style='background-color:red;'>";
// 					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$fdaw->format('H:i')."</a>";
// 					echo "</td>";
// 					if (count(array_intersect($arraysa, $termin_array)) > 1)
// 						echo "<td>";
// 					else
// 						echo "<td style='background-color:red;'>";
// 					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$sdaw->format('H:i')."</a>";
// 					echo "</td>";
// 				}
				if ($termin_array != null)
				{
					if (!in_array($ddaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:#F83333;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$ddaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($mdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:#F83333;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$mdaw->format("d.m.Y H:i")."\">".$mdaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($dodaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:#F83333;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$dodaw->format("d.m.Y H:i")."\">".$dodaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($fdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:#F83333;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$fdaw->format("d.m.Y H:i")."\">".$fdaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($sdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:#F83333;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$sdaw->format("d.m.Y H:i")."\">".$sdaw->format('H:i')."</a>";
					echo "</td>";
				}
				else
				{	
					echo "<td>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$ddaw->format('H:i')."</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$mdaw->format("d.m.Y H:i")."\">".$mdaw->format('H:i')."</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$dodaw->format("d.m.Y H:i")."\">".$dodaw->format('H:i')."</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$fdaw->format("d.m.Y H:i")."\">".$fdaw->format('H:i')."</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$sdaw->format("d.m.Y H:i")."\">".$sdaw->format('H:i')."</a>";
					echo "</td>";
					echo "</tr>";
				}
				$j++;
				$ddaw->modify('+15 minutes');
				$mdaw->modify('+15 minutes');
				$dodaw->modify('+15 minutes');
				$fdaw->modify('+15 minutes');
				$sdaw->modify('+15 minutes');
// 				array_push($arraydi, (string)$ddaw);
// 				array_push($arraymi, (string)$mdaw);
// 				array_push($arraydo, (string)$dodaw);
// 				array_push($arrayfr, (string)$fdaw);
// 				array_push($arraysa, (string)$sdaw);
			}		
			$i++;
			$j=1;
			$z1= $z1+1;
			$z2= $z2+1;
			
		}
		$bis = clone $sdaw;
		
		
		$mdaw->modify('-180 minutes');
	
		
		echo "</form>";
		echo "</table>";
// 		$svnr = 2050200565;	
// 		$mitarbeiter = $db->getMitarbeiter($svnr);
		$now = new DateTime();
// 		echo $now->format('d.m.Y H:i');

		
		
		if ($dienstleistung != "Null")
		{
			if($dienstleistung != "")
				$dlservice = umlaute_encode ($db->getDienstleistung($dienstleistung, new Haartyp($haarlaenge, null))->getName());
			else 
				$dlservice = "Keine Auswahl";
		}
		if ($dienstleistung2 != "Null")
		{
			if($dienstleistung2 != ""){	
// 				var_dump($dienstleistung2);
// 				var_dump($haarlaenge);
// 				var_dump((new Dienstleistung($dienstleistung2, new Haartyp(null, null), null, null, null, array(), array(), null))->getKuerzel());
			
				$dlcoloration = umlaute_encode($db->getDienstleistung(utf8_decode(utf8_encode($dienstleistung2)), new Haartyp($haarlaenge, null))->getName());
			}
			else
				$dlcoloration = "Keine Auswahl";
		}
		
		if (isset($haarlaenge))
		{
			if($haarlaenge != ""){
				$haartyp = umlaute_encode($db->getHaartyp($haarlaenge)->getBezeichnung());
			}
			else
				$haartyp = "Keine Auswahl";
		}
		
		echo "<br>";
		echo "<div id='openModal' class='modalDialog'>";
		echo "<div>";
		echo "<a href='#close' title='Close' class='close'>X</a>";
		echo "<form action='termineintragen.php' method='post' enctype='multipart/form-data' style='text-align:center;' name='form' onsubmit='return chkFormular()'>";
		echo "<input type='Text' name='kunde' value='$kunde2' hidden>";
		echo "<table border='0' style='text-align:left;'>";
		echo "<tr>";
		echo "<td> Termin: </td>";
		echo "<td> <input type='DateTime' name='date' value='' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Service: </td>";
		echo "<td> <input type='Text' value='$dlservice' readonly> </td>";
		echo "<input type='Text' name='dienstleistung' value='$dienstleistung' hidden>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Haarl&auml;nge: </td>";
		echo "<td> <input type='Text' value='$haartyp' readonly> </td>";
		echo "<input type='Text' name='haarlaenge' value='$haarlaenge' hidden>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Coloration: </td>";
		echo "<td> <input type='Text' value='$dlcoloration' readonly> </td>";
		echo "<input type='Text' name='dienstleistung2' value='$dienstleistung2' hidden>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Schneiden: </td>";
		echo "<td> <input type='Text' name='schneiden' value='$schneiden' readonly> </td>";
		echo "</tr>";
		if(stripos($ua,'android') === false) 
		{ 
			echo "<tr>";
			echo "<td> Wunschfrisur (optional): </td>";
			echo "<td> <input type='file' name='wunschfoto' value='NULL'> </td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
		echo "<input type='submit' value='Reservieren'>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
			
		?>
		

	</body> 
</html>
