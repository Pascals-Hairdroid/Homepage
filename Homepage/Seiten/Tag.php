<html>
<body>
<form action="uberprufen">
<table border="0">
<?php
	$verbindung = mysql_connect ("localhost","root", "")
	or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

	mysql_select_db("phd")
	or die ("Die Datenbank existiert nicht.");
	
	include("DB_Con.php");
	
	
$Beginn = "SELECT Beginn FROM Dienstzeiten Where Mitarbeiter_SvNR =;
?>
<input type="submit" value="weiter">

</form>




</body>
</html>