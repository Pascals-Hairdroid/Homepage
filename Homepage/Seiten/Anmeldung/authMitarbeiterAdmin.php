<?php 
session_start();
if(!isset($_SESSION['username'])) 
   { 
   header('Location: ../anmelden');
   } 
else
{
	if($_SESSION['mAdmin']==false or $_SESSION['admin']==false){
	header('Location: Verwaltungsmain.php?f=1');	
	}
}	
?> 