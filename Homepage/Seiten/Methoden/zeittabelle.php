<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
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
		
		if ($haarlaenge == "Kurze Haare")
			if ($dienstleistung == "DS")
				$sht = 45; 
			else 
				$sht = 30;
		else 
			if ($dienstleistung == "HS")
				$sht = 45;
			else
				$sht = 60;
		
		switch ($dienstleistung2) 
		{
   			case "FA":
       		$dl = 30;
       		$br = 30;
       		break;
    		case "ME":
        	$dl = 60;
       		$br = 30;
        	break;
    		case "TÖ":
        	$dl = 30;
       		$br = 30;
        	break;
        	case "OKME":
        	$dl = 30;
        	$br = 30;
        	break;
		}
		$gesamt = $sht + $dl + $br;
		
		
		
		include_once("../../include_DBA.php");
		$db=new db_con("conf/db.php",true, "utf8");
		
		echo "Haartyp: ".$haarlaenge."";
		echo "<br>";
		echo "Gew&uuml;nschte Dienstleistung: ".$dienstleistung.", ";
		echo $dienstleistung2;
		echo "<br>";
		echo "<br>";
		echo "".$dienstleistung2." dauert ".$dl." Minuten gefolgt von ".$br." Minuten Pause";
		echo "<br>";
		echo "Nach Pause ".$haarlaenge." + ".$dienstleistung." braucht ".$sht." Minuten";
		echo "<br>";
		echo "<br>";
		echo "Gesamt ".$gesamt." Minuten";
		echo "<br>";
		echo "<br>";
		echo $woche;
		$week = date("W", strtotime($woche));
		echo "<br>";

		
		
		if (strlen($woche) ==8)
		{
			$jahr= substr($woche, 0, 4);
			$woche2= substr($woche, 6, 2);
			$ddaw = date( "d.m.Y", strtotime($jahr."W".$woche2."2") ); // Dienstag der ausgewählten Woche
			echo $ddaw;
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
		
		
		//Tabelle in einem
		$i = 0;
		$j=0;
		$z1 = 11;
		$z2 = 12;

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

		echo "<table border='1' id='zeittabelle'>";
		echo "<tr>";
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
		echo "</table>";
			
		
		
		echo $db->getFreieTermine($von, $bis) 
		?>

</body> 
</html>
