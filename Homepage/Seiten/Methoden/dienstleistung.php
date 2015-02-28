<html>
<body>
<form action="Tag.php" method="get">
 <?php
  $db=mysql_connect("localhost", "root", "");
  mysql_select_db("phd");
  mysql_set_charset("utf8",$db);
  include_once("../../PHD_DBA/DB_CON.php");
  $db=new db_con("conf/db.php",true);
	$db->connect("root");


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