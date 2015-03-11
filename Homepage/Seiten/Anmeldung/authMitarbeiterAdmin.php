<?php 
session_start();
if(!isset($_SESSION['username'])) 
   { 
   echo "Bitte erst <a href='anmelden.php'>einloggen</a>";
   exit; 
   } 
else
{
	if($_SESSION['madmin']==false and $_SESSION['admin']==false){
		echo "Sie haben keine Berechtigung auf diese Seite zu gelangen!";
	exit;	
	}
}	
?> 