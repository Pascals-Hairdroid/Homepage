<?php

$db=mysql_connect("localhost", "root", "");
mysql_select_db("phd");
mysql_set_charset("utf8",$db);

	$email =$_POST['username'];
	$vn =$_POST['vn'];
	$nn =$_POST['nn'];
	$telnr =$_POST['telnr'];
	$passwort = md5($_POST['pw']);
		
	if($email !=null &&$vn !=null &&$nn !=null &&$telnr !=null &&$passwort !=null){
		
	$einlesen=mysql_query("SELECT * FROM `kunden` WHERE EMail='".$email."'");
	if(mysql_num_rows($einlesen)==1)
	{
	header('Location:../registration.php?n=1');
	}
	else{
	$eintragen = mysql_query("INSERT INTO `kunden` (`EMail`, `Vorname`, `Nachname`, `TelNr`, `Freischaltung`, `Foto`, `Passwort`) VALUES ('$email', '$vn', '$nn', '$telnr', '0', NULL, '$passwort')");
	
	Header('Location:../../index.php');
	}
	}
	else
		Header('Location:../registration.php');
?>