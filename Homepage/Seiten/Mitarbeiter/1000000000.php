<?php
$db=mysql_connect("localhost", "root", "");
mysql_select_db("phd");
mysql_set_charset("utf8",$db);



$svnr= basename(__file__,".php");
if(file_exists("../Bilder/Mitarbeiter/".$svnr.".jpg"))
{$image=basename("../Bilder/Mitarbeiter/".$svnr.".jpg");}
else
	$image="no.jpg";

echo "<img class='bild' src='../Bilder/Mitarbeiter/".$image."'>";

$abfrage = "SELECT * FROM mitarbeiter WHERE SVNr = $svnr";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   echo"<p class='Name'>". $row->Vorname." ".$row->Nachname."</p>";
   echo"<p class='Motto'>". $row->Motto."</p>";
   }


?>