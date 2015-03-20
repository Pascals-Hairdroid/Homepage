<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<?php
		
		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
		$woche=$_GET["woche"];
				
		include_once("../include_DBA.php");
  		$db=new db_con("conf/db.php",true);
				
  		
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
		
// 		// Arraylist fÃ¼r die einzelnen Tage
		
// 		$table1 = array ();
		
// 		?>
		
		<!--Table fÃ¼r die Anzeige der Tage-->
		
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
// 							if ($b == FA or $b == TÖ)
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
// 							if ($b == FA or $b == TÖ)
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
<h1> Bissel weiter</h1>
</body> 
</html>
