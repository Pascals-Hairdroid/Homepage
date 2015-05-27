<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link  rel="stylesheet" type="text/css" href="../../css/css.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript">$(document).ready(function(){
				$(".zeiteinheit").click(function(e){$("input[name='date']").val(e.currentTarget.dataset.time);});
			});</script>
	</head>
	<body>
		<?php
		
		$haarlaenge=$_GET["haarlaenge"];
		$dienstleistung=$_GET["dienstleistung"];
		$dienstleistung2=$_GET["dienstleistung2"];
//		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		
		if (isset($_GET["schneiden"]))
			$schneiden="ja";
		else 
			$schneiden="nein";
		
		
		//Mitarbeiter + Skill abfrage
		

		
		//Zeitberechnung
		$sht;		//service + haartyp
		$dl;		//dienstleistung
		$br = null;		//pause
		$gesamt;
		
		
		include_once("../../include_DBA.php");
		$db=new db_con("conf/db.php",true);
		
		
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
		foreach($db->getAllArbeitsplatzausstattung() as $arbeitsplatz)
				{
					echo $arbeitsplatz->getId();
					echo "<br>";
				}
		
		
		//Tabelle in einem
		$i = 0;
		$j=0;
		$z1 = 11;
		$z2 = 12;
		
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
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$ddaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($mdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:yellow;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$mdaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($dodaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:yellow;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$dodaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($fdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:yellow;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$fdaw->format('H:i')."</a>";
					echo "</td>";
					if (!in_array($sdaw, $termin_array))
						echo "<td>";
					else
						echo "<td style='background-color:yellow;'>";
					echo "<a href=\"#openModal\" class=\"zeiteinheit\" data-time=\"".$ddaw->format("d.m.Y H:i")."\">".$sdaw->format('H:i')."</a>";
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
			}		
			$i++;
			$j=0;
			$z1= $z1+1;
			$z2= $z2+1;
			
		}
		$bis = clone $sdaw;
		
		
		$mdaw->modify('-180 minutes');
	
		
		echo "</form>";
		echo "</table>";
		$svnr = 2050200565;	
		$mitarbeiter= $db->getMitarbeiter($svnr);


		echo "<br>";
		echo "<div id='openModal' class='modalDialog'>";
		echo "<div>";
		echo "<a href='#close' title='Close' class='close'>X</a>";
		echo "<form action='termineintragen.php' method='post' enctype='multipart/form-data' style='text-align:center;'>";
		echo "<table border='0' style='text-align:left;'>";
		echo "<tr>";
		echo "<td> Termin: </td>";
		echo "<td> <input type='DateTime' name='date' value='' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Service: </td>";
		echo "<td> <input type='Text' name='dienstleistung' value='$dienstleistung' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Haarl&auml;nge: </td>";
		echo "<td> <input type='Text' name='haarlaenge' value='$haarlaenge' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Coloration: </td>";
		echo "<td> <input type='Text' name='dienstleistung2' value='$dienstleistung2' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Schneiden: </td>";
		echo "<td> <input type='Text' name='schneiden' value='$schneiden' readonly> </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Wunschfrisur (optional): </td>";
		echo "<td> <input type='file' name='wunschfoto' value='NULL'> </td>";
		echo "</tr>";
		echo "</table>";
		echo "<br>";
		echo "<input type='submit' value='Reservieren'>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
			
		?>
		
<!-- 		<iframe name="r_frame" src="termineintragen.php" > </iframe> -->
		
		

	</body> 
</html>
