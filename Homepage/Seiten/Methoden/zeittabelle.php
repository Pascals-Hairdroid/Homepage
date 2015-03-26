<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<?php
		
		$haarlaenge=$_GET["haarlaenge"];
		$dienstleistung=$_GET["dienstleistung"];
		$dienstleistung2=$_GET["dienstleistung2"];
//		$woche=$_GET["woche"];
		$calender=$_GET["calender"];
				
		include_once("../../include_DBA.php");
  		$db=new db_con("conf/db.php",true);
				
  		echo "Haartyp: ".$haarlaenge."";
  		echo "<br>";
  		echo "Gew&uuml;nschte Dienstleistung: ".$dienstleistung.", ";
  		echo $dienstleistung2;
  		echo "<br>";
  		echo $woche;
  		
  		
  		
  		
  		
  		
  		
  		
  		
  		
  		
  		//echo $woche;
//  		foreach ($db->)
  			
  			
// 		$ergebnis = mysqli_query($db, "SELECT * FROM Zeittabelle");
// 		$alleZeitstempel = array();
// 		$nachtage = array();
// 		while($row = mysqli_fetch_object($ergebnis))
// 		{
		
// 		$datum = date("Y.m.d", strtotime($row->Zeitstempel));
// 		if(!isset($nachtage[$datum])){
// 			$nachtage[$datum] = array();
// 		}
// 		$nachtage[$datum][] = $row;
		
// 		$array= array();
// 		echo $row->Zeitstempel;
// 		echo "<br>";
// 		$date=new DateTime($row->Zeitstempel);
// 		echo $date->format("d.n ");
// 		echo "<br>";
// 		echo $date->format("H:i");
		
// 		echo "<br>";
// 		$alleZeitstempel[] = $date;
// 		$date = $date->add(new DateInterval("P4D"));
// 		echo $date->format("d.n H:i");
// 		echo "<br>";
// 		echo $row->Mitarbeiter;
// 		echo "<br>";
// 		echo $row->ArbeitsplatzNr;
// 		echo "<br>";
// 		echo $row->Kunden_EMail;
// 		echo "<br>";
// 		echo $row->FrisurwunschFoto;
// 		echo "<br>";
// 		echo $row->Dienstleistungen_Kuerzel;
// 		echo "<br>";
// 		echo $row->Dienstleistungen_Haartypen_Kuerzel;
// 		echo "<br><br>";
// 		}

// 		var_dump($nachtage);
// 			$nachtage["2015.02.27"][0]->Mitarbeiter;
			
// 		echo $nachtage;
		
// 		// Arraylist f√ºr die einzelnen Tage
		
// 		$table1 = array ();
		$i = 0;
		$z1 = 11;
		$z2 = 12;
  		echo "<table border='1' style='width:50px;height:800px;'>";
  		echo "<tr>";
  		echo "<th> Zeit </th>";
  		echo "</tr>";
  		while ($i < 8)
  		{	
  			echo "<tr>";
			echo "<td rowspan='4'>".$z1." bis ".$z2." </td>";
  			//echo "<td rowspan='4'>seas </td>";
			echo "</tr>";
			$i++;
			$z1= $z1+2;
			$z2= $z2+2;
  		}
		echo "</table>"
// 		?>
		
		<!--Table f√ºr die Anzeige der Tage-->
		
		<!--
<!-- 		$zeit= new DateTime; -->
<!-- 		$zeit->setTime(10,0); -->
<!-- 		$zeit2= new DateTime; -->
<!-- 		$zeit2->setTime(14,30); -->
<!-- 		echo $zeit->format('H:i'); -->
<!-- 		while ($zeit < $zeit2) -->
<!-- 		{ -->
<!-- 			echo $zeit->format('H:i'); -->
<!-- 			$zeit = $zeit->add(new DateInterval("PT15M")); -->
<!-- 			echo "<br>"; -->
<!-- 		} -->
	
		
		
		<?php
// 			$count = 1;
// 			$count2 = 1;
			
// 			$dauer = 0;
			
// 			while ($count <=4)
// 			{
// 				$zeit= new DateTime;
// 				$zeit->setTime(11,0);
// 				echo $zeit->format('H:i');
// 				echo "<table>";
// 				echo "";
// 					while($count2 <=32)
// 					{
// 						if ($a == KH)
// 						{
// 							if ($b == FA or $b == T÷)
// 							{
// 								$dauer = 4;
// 							}
// 							elseif ($b == ME)
// 							{
// 								$dauer = 6;
// 							}
// 							elseif ($b == DS)
// 							{
// 								$dauer = 3;
// 							}
// 							else
// 							{
// 								$dauer = 2;
// 							}
// 						}
// 						else
// 						{
// 							if ($b == FA or $b == T÷)
// 							{
// 								$dauer = 4;
// 							}
// 							elseif ($b == ME)
// 							{
// 								$dauer = 6;
// 							}
// 							elseif ($b == DS)
// 							{
// 								$dauer = 4;
// 							}
// 							else
// 							{
// 								$dauer = 3;
// 							}
// 						}
// 						if ($zeit=$termin)
// 						{
// 							echo "<tr rowspan='$dauer'>";
// 							echo "<td>";
// 							echo $count;
// 							echo "</td>";
// 							echo "</tr>";
// 						}
// 						$count2++;
// 						$zeit = $zeit->add(new DateInterval("PT15M"));
// 					}
// 				echo "</table>";
// 				$count++;
// 			}
// 		?>
	

</body> 
</html>
