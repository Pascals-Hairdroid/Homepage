<?php 
session_start();
if(!isset($_SESSION['username'])) 
   { 
   header('Location: ../anmelden.php?f=1');
   exit; 
   } 
else
{
	if($_SESSION['admin']==false){
		header('Location: ../anmelden.php');
	exit;	
	}
}	
?> 