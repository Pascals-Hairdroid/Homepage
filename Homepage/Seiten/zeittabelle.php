<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<?php
		$db = mysqli_connect("localhost", "root", "", "phd");
		if(!$db)
		{
			exit("Verbindungsfehler: ".mysqli_connect_error());
		}
		
		$ergebnis = mysqli_query($db, "SELECT Zeitstempel, Mitarbeiter, Kunden_EMail FROM Zeittabelle");
		while($row = mysqli_fetch_object($ergebnis))
		{
		echo $row->Zeitstempel;
		echo "<br>";
		echo $row->Mitarbeiter;
		echo "<br>";
		echo $row->Kunden_EMail;
		echo "<br><br>";
		}
		
		$timestamp = time();
		echo "<br><br><br>";
		echo "$timestamp";
		echo "<br>";
		
		/*echo "<table>
			<tr>
				<th>  </th>
				<th> Dienstag </th>
				<th> Mittwoch </th>
				<th> Donnerstag </th>
				<th> Freitag </th>
				<th> Samstag </th>
			</tr> ";
			$count = 1;
			$zeit = 5;
			while ($count >=40)
			{
			
			$count++;
			}
echo		"<tr>
				<td> 12:00 </td>
				<td>  </td>
				<td>  </td>
				<td>  </td>
				<td>  </td>
				<td>  </td>
			</tr>
		</table> ";
		*/
		?>
	</body>
</html>
