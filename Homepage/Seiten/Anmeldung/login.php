<?php
	$verbindung = mysql_connect ("localhost","root", "")
	or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");

	mysql_select_db("phd")
	or die ("Die Datenbank existiert nicht.");

	include ("../DBA/DB_Con.php");
	
	$db= new DB_Con();
	if(username != )
	$userdb="Select "
	$passdb=
	

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['username'];
      $passwort = $_POST['passwort'];

	$dbUser= $db-getKunde($username)
	  
	  
      // Benutzername und Passwort werden überprüft
      if ($username == $userdb && $passwort == $passdb) {
       $_SESSION['angemeldet'] = true;

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
?>