<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link  rel="stylesheet" type="text/css" href="../../css/css.css">
	</head>
	<body>
		<?php
		
		$haarlaenge=$_GET["haarlaenge"];
		$dienstleistung=$_GET["dienstleistung"];
		$dienstleistung2=$_GET["dienstleistung2"];
//		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		
		
		//Zeitberechnung
		$sht;		//service + haartyp
		$dl;		//dienstleistung
		$br = null;		//pause
		$gesamt;
		
// 		if ($haarlaenge == "Kurze Haare")
// 			if ($dienstleistung == "DS")
// 				$sht = 45; 
// 			else 
// 				$sht = 30;
// 		else 
// 			if ($dienstleistung == "HS")
// 				$sht = 45;
// 			else
// 				$sht = 60;
		
// 		switch ($dienstleistung2) 
// 		{
//    			case "FA":
//        		$dl = 30;
//        		$br = 30;
//        		break;
//     		case "ME":
//         	$dl = 60;
//        		$br = 30;
//         	break;
//     		case "TÖ":
//         	$dl = 30;
//        		$br = 30;
//         	break;
//         	case "OKME":
//         	$dl = 30;
//         	$br = 30;
//         	break;
// 		}
// 		$gesamt = $sht + $dl + $br;
		
		
		
		include_once("../../include_DBA.php");
		$db=new db_con("conf/db.php",true);
		
// 		echo "Haartyp: ".$haarlaenge."";
// 		echo "<br>";
// 		echo "Gew&uuml;nschte Dienstleistung: ".$dienstleistung.", ";
// 		echo $dienstleistung2;
// 		echo "<br>";
// 		echo "<br>";
// 		echo "".$dienstleistung2." dauert ".$dl." Minuten gefolgt von ".$br." Minuten Pause";
// 		echo "<br>";
// 		echo "Nach Pause ".$haarlaenge." + ".$dienstleistung." braucht ".$sht." Minuten";
// 		echo "<br>";
// 		echo "<br>";
// 		echo "Gesamt ".$gesamt." Minuten";
// 		echo "<br>";
// 		echo "<br>";
// 		echo $woche;
// 		$week = date("W", strtotime($woche));
// 		echo "<br>";

		
		
		
		
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
			$tag=substr($woche, 3, 2);;
			$monat=substr($woche, 0, 2);
			$jahr= substr($woche, 6, 4); 
			$tag2 = new DateTime();
			$tag2->setDate($jahr, $monat, $tag);
			if ($tag2->format('l') == 'Sunday')
			{
				$week=$week+1;
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
// 		echo "erster Termin: ".$von1->format('d.m.Y H:i')."";
// 		echo "<br>";
// 		echo "letzer Termin: ".$bis1->format('d.m.Y H:i')."";
		
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
		
		
		
		//Tabelle in einem
		$i = 0;
		$j=0;
		$z1 = 11;
		$z2 = 12;
		
		echo "<form target='r_frame' method='get' action='termineintragen.php'>";
		
		echo "<input type='text' name='haarlaenge' value='".$haarlaenge."' hidden='true'>";
		echo "<input type='text' name='dienstleistung' value='".$dienstleistung."' hidden='true'>";
		echo "<input type='text' name='dienstleistung2' value='".$dienstleistung2."' hidden='true'>";
		


		echo "<table border='1' id='zeittabelle' style='border:1px solid red;'>";
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
						echo "<td style='background-color:green;'>";
					else 
						echo "<td style='background-color:yellow;'>";
					echo $ddaw->format('H:i');
					echo "</td>";
					if (!in_array($mdaw, $termin_array))
						echo "<td style='background-color:green;'>";
					else
						echo "<td style='background-color:yellow;'>";
					echo $mdaw->format('H:i');
					echo "</td>";
					if (!in_array($dodaw, $termin_array))
						echo "<td style='background-color:green;'>";
					else
						echo "<td style='background-color:yellow;'>";
					echo $dodaw->format('H:i');
					echo "</td>";
					if (!in_array($fdaw, $termin_array))
						echo "<td style='background-color:green;'>";
					else
						echo "<td style='background-color:yellow;'>";
					echo $fdaw->format('H:i');
					echo "</td>";
					if (!in_array($sdaw, $termin_array))
						echo "<td style='background-color:green;'>";
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
	
// 		$ft= $db->getFreieTermine($von, $bis, $mitarbeiter); 		//FreieTermine
// 		var_dump($ft);
// 		while ($fta = mysqli_fetch_object($ft))
// 		{
// 			echo $fta->Zeitstempel;
// 		}
		
		
		?>
		
		<iframe name="r_frame" style="min-width:200px;min-height:90px;padding:0px;margin:auto;">
			<p> hi </p>
		</iframe>

	</body> 
</html>
