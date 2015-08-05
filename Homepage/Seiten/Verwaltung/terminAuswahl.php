<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/epoch_styles.css" />
<script type="text/javascript" src="../javascript/epoch_classes.js"></script>
<script type="text/javascript">
	var bas_cal,dp_cal,ms_cal;      
window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('calender'));
};
</script>

<!-- skripts für autovervollständigungsfeld -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script>
		$(document).ready(function(){
		$('#autocomplete').autocomplete({
		source: "../Methoden/autocomplete.php",
		});
		});
	</script>   
</head>
<body>
<form action="../Methoden/zeittabelle.php" method="get" id="dienstleistungFrom" target="iframe">
 <br/>
 <br/>
 
 <?php

  include_once("../../include_DBA.php");
  $db=new db_con("conf/db.php",true);
  
  if (isset($_SESSION['svnr'])){
//   	echo $_SESSION['mAdmin'];
  	}
  
  include '../Methoden/getBrowser.php';

  echo "<table border='0'>";
  echo "<tr> <td>";
  echo "Kunde: ";
  echo "</td>";
  echo "<td colspan='2'>";
  echo "<input type='text' id='autocomplete' name='kunde' required>";
  echo "</td> </tr>";
  
  echo "<tr>";
  echo "<td>";
  echo "Mitarbeiter: ";
  echo "</td>";
  echo "<td colspan='2'>";
  echo"<select name='haarlaenge' size='1' required>";
  echo "<option style='width:17ex;'value=''> Keine Auswahl </option>";
  foreach ($db->getAllMitarbeiter() as $mitarbeiter)
  	echo umlaute_encode("<option style='width:17ex;'value='".$mitarbeiter->getSvnr()."'>".$mitarbeiter->getVorname()." ".$mitarbeiter->getNachname()." </option>");
  echo "</select>";
  echo "</td>";
  echo "</tr>";
  
  echo "</table>";
  
  
  if ($binfo == 'Google Chrome' or $binfo == 'Apple Safari' or $binfo == 'Opera')
  {
  	echo "<input type='week' name='woche' value=";
  	echo date("o");
  	echo "-W";
  	echo date("W");
  	echo ">";
  }
  else
  {
  	echo "<input name='woche' id='calender' type='text' value=";
  	echo date("m");
  	echo "/";
  	echo date("d");
  	echo "/";
  	echo date("o");
  	echo ">";
  }
  ?>
 </form>
 </body>
 </html>