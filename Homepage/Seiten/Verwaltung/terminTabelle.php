<?php session_start();
include_once("../../include_DBA.php");
$db=new db_con("conf/db.php",true, "utf8");

date_default_timezone_set('Europe/Vienna');

$kunde=isset($_GET["kunde"])?$_GET["kunde"]:"";
$mitarbeiter=isset($_GET["mitarbeiter"])?$_GET["mitarbeiter"]:"";

$woche=isset($_GET["woche"])?$_GET["woche"]:(date('Y')."-W".date('W'));

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
		
	$tag = substr($woche, 3, 2);;
	$monat = substr($woche, 0, 2);
	$jahr = substr($woche, 6, 4);
	$tag2 = new DateTime();
	$tag2->setDate($jahr, $monat, $tag);
	$week =  $tag2->format('W');
	if ($tag2->format('l') == 'Sunday')
	{
		$week = $week+1;
	}
	$ddaw = date( "d.m.Y", strtotime($jahr."W".$week."2") ); // Dienstag der ausgewählten Woche
	echo "<br>";
}

$ddaw= new DateTime($ddaw);
$ddaw->modify('+660 minutes');

// echo $ddaw->format("d.m.Y H:i");

$leer = array();
// var_dump($mitarbeiter, $kunde);

$kunde=isset($_GET["kunde"])?$_GET["kunde"]:"";
list ($vorname, $nachname) = split(' ', $_GET["kunde"]);
$kundenemail = $db->getEmailPerName($vorname, $nachname);

$objMitaarbeiter = $db->getMitarbeiter($mitarbeiter);
// var_dump($objMitaarbeiter);
if (isset($_GET["mitarbeiter"]) && $mitarbeiter != "")
	$termine = $db->getTermineZeitstempelMitarbeiter($objMitaarbeiter, $ddaw);
// var_dump($mitarbeiter);


list ($vorname, $nachname) = split(' ', $_GET["kunde"]);

$kundenemail = $db->getEmailPerName($vorname, $nachname);
//  		var_dump($kundenemail);
if ($kundenemail != "NULL" && isset($_GET["kunde"]) && $kundenemail != NULL)
	$kunde2 = implode($kundenemail);

// var_dump($kunde2);

if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
	$termine = $db->getTermineZeitstempelVonKunde($kunde2, $ddaw);

// 	var_dump("Termine: ",$termine);



// foreach($termine as $termin)
// {
// 	echo '<br>'.$termin[Zeitstempel]->format('d.m.Y H:i');
	
// }

$alltermine = array();
$z=0;
$i=0;
$eintermin = array();
// while (z < 10)
// {
// // 	while ()
// 	$z++;
// }



echo "<table border='0'>";
echo "<tr>";
echo "<th> &nbsp; Zeit &nbsp; </th>";
if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
	echo "<th> &nbsp; Mitarbeiter &nbsp; </th>";
else
	echo "<th> &nbsp; Kunde &nbsp; </th>";
echo "<th> &nbsp; &nbsp; Dienstleistung &nbsp; </th>";
echo "<th> &nbsp; Haartyp &nbsp; </th>";
echo "<th> &nbsp; Arbeitsplatz &nbsp; </th>";
echo "<th>  </th>";
echo "</tr>";


while ($z < count($termine))
{
	if ($z == 0)
	{
// 		var_dump('VARDUMP',$termine[$z][Zeitstempel], 'VARDUMPENDE');
		echo "<tr>";
		echo "<form action='terminLoeschen.php' method='GET'>";
		echo "<input type'text' name='id' value='".$z."' hidden>";
		echo "<input type'text' name='wann' value='".$termine[$z][Zeitstempel]->format('d.m.Y H:i')."' hidden>";
		echo "<input type'text' name='platz' value='".$termine[$z][ArbeitsplatzNr]."' hidden>";
			if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
				echo "<input type'text' name='kunde' value='".$termine[$z][Kunden_EMail]."' hidden>";
			else 
				echo "<input type'text' name='mitarbeiter' value='".$termine[$z][Mitarbeiter]."' hidden>";
		echo  "<td style='text-align:center;'> &nbsp;".$termine[$z][Zeitstempel]->format('d.m.Y H:i')."&nbsp;  </td>";
		if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
			echo  "<td style='text-align:center;'> ".$termine[$z][Mitarbeiter]." </td>";
		else
			echo  "<td style='text-align:center;'> ".$termine[$z][Kunden_EMail]." </td>";
		echo  "<td style='text-align:center;'> ".$termine[$z][Dienstleistungen_Kuerzel]." </td>";
		echo  "<td style='text-align:center;'> ".$termine[$z][Dienstleistungen_Haartypen_Kuerzel]." </td>";
		echo  "<td style='text-align:center;'> ".$termine[$z][ArbeitsplatzNr]." </td>";
		echo  "<td style='text-align:center;'> <input type='submit' value='L&ouml;schen'> </td>";
		echo "</form>";
		echo "</tr>";
		$z++;
	}
	if ($z > 0)
	{
		if ($termine[$z-1][Zeitstempel]->modify('+15 minutes') == $termine[$z][Zeitstempel]&& $termine[$z][Kunden_EMail] == $termine[$z-1][Kunden_EMail] && $termine[$z][ArbeitsplatzNr] == $termine[$z-1][ArbeitsplatzNr] )
		{
			$z++;
		}
		else 
		{
// 			var_dump($z, count($termine));
			echo "<tr>";
			echo "<form action='terminLoeschen.php' method='GET'>";
			echo "<input type'text' name='id' value='".$z."' hidden>";
			echo "<input type'text' name='wann' value='".$termine[$z][Zeitstempel]->format('d.m.Y H:i')."' hidden>";
			echo "<input type'text' name='platz' value='".$termine[$z][ArbeitsplatzNr]."' hidden>";
			if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
				echo "<input type'text' name='kunde' value='".$termine[$z][Kunden_EMail]."' hidden>";
			else 
				echo "<input type'text' name='mitarbeiter' value='".$termine[$z][Mitarbeiter]."' hidden>";
			echo  "<td style='text-align:center;'> &nbsp;".$termine[$z][Zeitstempel]->format('d.m.Y H:i')."&nbsp;  </td>";
			if (isset($_GET["kunde"]) && $kunde != "" && $kunde != "Null" && $kunde != NULL)
				echo  "<td style='text-align:center;'> ".$termine[$z][Mitarbeiter]." </td>";
			else
 				echo  "<td style='text-align:center;'> ".$termine[$z][Kunden_EMail]." </td>";
			echo  "<td style='text-align:center;'> ".$termine[$z][Dienstleistungen_Kuerzel]." </td>";
			echo  "<td style='text-align:center;'> ".$termine[$z][Dienstleistungen_Haartypen_Kuerzel]." </td>";
			echo  "<td style='text-align:center;'> ".$termine[$z][ArbeitsplatzNr]." </td>";
			echo  "<td style='text-align:center;'> <input type='submit' value='L&ouml;schen'> </td>";
			echo "</form>";
			echo "</tr>";
			$z++;
		}
	}
}
echo "</table>";

// echo $z;

?>