<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	$verbindung = mysql_connect ("localhost","root", "")
	or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

	mysql_select_db("phd")
	or die ("Die Datenbank existiert nicht.");

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['username'];
      $passwort = md5($_POST['passwort']);

	//Abfrage ob Mitarbeiter oder Kunde
	IF(preg_match('~[0-9]+~',$username) && $passwort !=null && $username !=null )
	{
	if (mysql_result(mysql_query("SELECT COUNT(*) FROM `mitarbeiter` WHERE SVNr='".$username."'&& Passwort='".$passwort."'"),0)==0)
	{
	header('Location:../anmelden.php');
	}
	$ausgabe=mysql_query("SELECT * FROM mitarbeiter WHERE SVNr='".$username."' && Passwort='".$passwort."'");
	$row=mysql_fetch_object($ausgabe);	  
	$userdb= $row->SVNr;
	$name= $row->Vorname;
	$passdb= $row->Passwort;
		

      // Benutzername und Passwort werden überprüft
      if ($username == $userdb && $passwort == $passdb) {
       $_SESSION['angemeldet'] = true;
       $_SESSION['admin'] = true;
       $_SESSION['username'] = $name;

       // Weiterleitung zur geschützten Startseite
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location:../index.php');
       exit;
       }
	   
	   }
	elseif($username != null && $passwort != null){
	if (mysql_result(mysql_query("SELECT COUNT(*) FROM `kunden` WHERE EMail='".$username."' && Passwort='".$passwort."'"),0)==0)
	{
	header('Location:../anmelden.php');
	}
	

	$ausgabe=mysql_query("SELECT * FROM kunden WHERE EMail='".$username."'");
	$row=mysql_fetch_object($ausgabe);	  
	$userdb= $row->EMail;
	$name= $row->Vorname;
	$passdb= $row->Passwort;
	
	
	  // Benutzername und Passwort werden überprüft
      if ($username == $userdb && $passwort == $passdb) {
       $_SESSION['angemeldet'] = true;
       $_SESSION['admin'] = false;
	   
	   $_SESSION['username'] = $name;
	   

       // Weiterleitung zur geschützten Startseite
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location:../index.php');
       exit;
       }
	
	}
	else{
		echo"<meta http-equiv='refresh' content='0; url=../anmelden.php' />";
	}
	   
      }
?>
</body>
</html>