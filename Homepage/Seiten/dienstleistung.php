<html>
<body>
<form action="zeittabelle.php" method="get" target="z_iframe">
 <?php
	
	$verbindung = mysql_connect ("localhost","root", "")
	or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

	mysql_select_db("phd")
	or die ("Die Datenbank existiert nicht.");

	include("../DBA/DB_Con.php");
	
	echo"<select name='mitarbeiter' size='1'>";
$abfrage = "SELECT * FROM mitarbeiter";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   echo "<option style='width:17ex;'value='$row->Nachname'>$row->Vorname, $row->Nachname </option>";
   }
	echo"</select><p><br>";
	echo"<select name='haarlaenge' size='1'>";
$abfrage = "SELECT * FROM haartypen";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   echo "<option style='width:17ex;' value='$row->Bezeichnung'>$row->Bezeichnung </option>";
   }	
	echo"</select> &nbsp;&nbsp;&nbsp;&nbsp;";
 
$abfrage = "SELECT * FROM dienstleistungen GROUP BY Dienstleistung";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   echo "<input type='checkbox' name='$row->Dienstleistung'> $row->Dienstleistung </input>&nbsp;&nbsp;&nbsp;";
   }
		
?>
<br><br>
<input type="submit" value="Update" class="loginbuttons">
</form>
</body>
</html>