<?php 
session_start();
if(!isset($_SESSION['username'])) 
   { 
   echo "Bitte erst <a href='anmelden.php'>einloggen</a>";
   exit; 
   } 
?> 