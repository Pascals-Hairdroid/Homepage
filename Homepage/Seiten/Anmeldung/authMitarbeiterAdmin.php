<?php 
session_start();
if(!isset($_SESSION['username'])) 
   { 
   echo "Bitte erst <a href='../anmelden.php'>einloggen</a>";
   header('Location: ../anmelden');
   } 
else
{
	if($_SESSION['mAdmin']==false or $_SESSION['admin']==false){
		echo "Sie haben keine Berechtigung auf diese Seite zu gelangen!";
	header('Location: Verwaltungsmain.php?f=1');	
	}
}	
?> 