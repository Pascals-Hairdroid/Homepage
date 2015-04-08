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
		
		
		include_once("../../include_DBA.php");
		$db=new db_con("conf/db.php",true);
		
		echo "Haartyp: ".$haarlaenge."";
		echo "<br>";
		echo "Gew&uuml;nschte Dienstleistung: ".$dienstleistung.", ";
		echo $dienstleistung2;
		echo "<br>";
		echo $woche;
		$week = date("W", strtotime($woche));
		echo "<br>";

		
		
		if (strlen($woche) ==8)
		{
			$jahr= substr($woche, 0, 4);
			$woche2= substr($woche, 6, 2);
			$ddaw = date( "d.m.Y", strtotime($jahr."W".$woche2."2") ); // Dienstag der ausgew‰hlten Woche
			echo $ddaw;
			echo "<br>";			

		}
		else
		{
			$jahr= substr($woche, 6, 4); 
			$ddaw = date( "d.m.Y", strtotime($jahr."W".$week."2") ); // Dienstag der ausgew‰hlten Woche
			echo $ddaw;
			echo "<br>";
		}
		
	

		
		//Zeittabelle
		$i = 0;
		$z1 = 11;
		$z2 = 12;
  		echo "<table border='1' style='float:left'>";
  		echo "<tr>";
  		echo "<th> Zeit </th>";
  		echo "</tr>";
  		while ($i < 8)
  		{	
  			echo "<tr>";
			echo "<td height='90'>".$z1." bis ".$z2." </td>";
			echo "</tr>";
			$i++;
			$z1= $z1+1;
			$z2= $z2+1;
  		}
		echo "</table>";

		
		//Table f√ºr die Anzeige der Tage
		
		//Dienstag
		echo "<table border='1' style='float:left;'>";
  		echo "<tr>";
  		echo "<th> Dienstag $ddaw </th>";
  		echo "</tr>";
  		$i=0;
  		$ddaw= new DateTime($ddaw);
  		$ddaw->modify('+660 minutes');
  		while ($i < 32)
  		{	
  			echo "<tr>";
			echo "<td>";
			echo $ddaw->format('H:i');
			echo "</td>";
			echo "</tr>";
			$i++;
			$ddaw->modify('+15 minutes');
  		}
		echo "</table>";
	
		//Mittwoch
		$mdaw=$ddaw;
		$mdaw->add(new DateInterval('P1D'));
		$mdaw->modify('-480 minutes');
		echo "<table border='1' style='float:left'>";
		echo "<tr>";
		echo "<th> Mittwoch ";
		echo $mdaw->format('d.m.Y');
		echo "</th>";
		echo "</tr>";
  		$i=0;
		while ($i < 32)
		{
		echo "<tr>";
		echo "<td>";
		echo $mdaw->format('H:i');
		echo "</td>";
		echo "</tr>";
			$i++;
			$mdaw->modify('+15 minutes');
		}
		echo "</table>";
		
		//Donnerstag
		$dodaw= $mdaw;
		$dodaw->add(new DateInterval('P1D'));
		$dodaw->modify('-480 minutes');
		echo "<table border='1' style='float:left'>";
		echo "<tr>";
		echo "<th> Donnerstag ";
		echo $dodaw->format('d.m.Y');
		echo "</th>";
		echo "</tr>";
		$i=0;
		while ($i < 32)
		{
			echo "<tr>";
			echo "<td>";
			echo $dodaw->format('H:i');
			echo "</td>";
			echo "</tr>";
			$i++;
			$dodaw->modify('+15 minutes');
		}
		echo "</table>";
		
		//Freitag
		$fdaw= $dodaw;
		$fdaw->add(new DateInterval('P1D'));
		$fdaw->modify('-480 minutes');
		echo "<table border='1' style='float:left'>";
		echo "<tr>";
		echo "<th> Freitag ";
		echo $fdaw->format('d.m.Y');
		echo "</th>";
		echo "</tr>";
		$i=0;
		while ($i < 32)
		{
			echo "<tr>";
			echo "<td>";
			echo $fdaw->format('H:i');
			echo "</td>";
			echo "</tr>";
			$i++;
			$fdaw->modify('+15 minutes');
		}
		echo "</table>";
		
		//Samstag
		$sdaw= $fdaw;
		$sdaw->add(new DateInterval('P1D'));
		$sdaw->modify('-480 minutes');
		echo "<table border='1' style='float:left'>";
		echo "<tr>";
		echo "<th> Samstag ";
		echo $sdaw->format('d.m.Y');
		echo "</th>";
		echo "</tr>";
		$i=0;
		while ($i < 32)
		{
			echo "<tr>";
			echo "<td>";
			echo $fdaw->format('H:i');
			echo "</td>";
			echo "</tr>";
			$i++;
			$sdaw->modify('+15 minutes');
		}
		echo "</table>";
			
		
		
		foreach ($db->getFreieTermine() as $termine)
		{
 		 	echo $termine;
 		}
		?>

</body> 
</html>
