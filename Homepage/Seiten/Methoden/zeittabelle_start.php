<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<?php
		
		date_default_timezone_set('Europe/Vienna');
		$jahr= date('Y');
		$woche2= date('W');
		$ddaw = date( "d.m.Y", strtotime($jahr."W".$woche2."2") ); // Dienstag der ausgewählten Woche

		//Tabelle in einem
		$i = 0;
		$j=0;
		$z1 = 11;
		$z2 = 12;

		$ddaw= new DateTime($ddaw);
		$ddaw->modify('+660 minutes');
		$mdaw= clone $ddaw;
		$mdaw->add(new DateInterval('P1D'));
		$dodaw= clone $mdaw;
		$dodaw->add(new DateInterval('P1D'));
		$fdaw= clone $dodaw;
		$fdaw->add(new DateInterval('P1D'));
		$sdaw= clone $fdaw;
		$sdaw->add(new DateInterval('P1D'));

		echo "<table border='1' style='margin: 10px auto;text-align:center; width:950px;'>";
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

		echo "</table>";

		?>
	</body>
</html>