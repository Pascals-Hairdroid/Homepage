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
</head>
<body>
<form action="Methoden/zeittabelle.php" method="get" id="dienstleistungFrom" target="iframe">
 <br/>
 <br/>
 
 <?php

  include_once("../include_DBA.php");
  $db=new db_con("conf/db.php",true);
  
  include 'getBrowser.php';

  echo "<table border='0'>";
  //Damen/Herrenservice auswahl
  echo "<tr> <td>";
  echo "Service: ";
  echo "</td>";
  echo "<td>";
  echo"<select name='dienstleistung' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray = array();
  echo "<option style='width:17ex;'value=''> Keine Auswahl </option>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == Null && !in_array($dienstleistung->getKuerzel(),$kuerzelArray))
  		echo umlaute_encode("<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>");
  	$kuerzelArray[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  echo "</td>";
  //Schneiden?
  echo "<td colspan='2'>";
  echo "<input type='checkbox' name='schneiden' value='asdf' checked> Schneiden";
  echo "</td>";
  echo "</tr>";
  
  //Haartyp
  echo "<tr>";
  echo "<td>";
  echo "Haartyp: ";
  echo "</td>";
  echo "<td colspan='2'>";
  echo"<select name='haarlaenge' size='1'>";
  echo "<option style='width:17ex;'value=''> Keine Auswahl </option>";
  foreach ($db->getAllHaartyp() as $haartyp)
  	echo umlaute_encode("<option style='width:17ex;'value='".$haartyp->getKuerzel()."'>".$haartyp->getBezeichnung()." </option>");
  echo "</select>";
  echo "</td>";
  echo "</tr>";
  
  //Färben/Strähnen/Tönung
  echo "<tr>";
  echo "<td>";
   echo "Coloration: ";
  echo "</td>";
  echo "<td colspan='2'>";
  echo"<select name='dienstleistung2' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray2 = array();
  echo "<option style='width:17ex;'value=''> Keine Auswahl </option>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == 1 && !in_array($dienstleistung->getKuerzel(),$kuerzelArray2))
  	echo umlaute_encode("<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>");
  	$kuerzelArray2[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  echo "</td>";
  echo "</tr>";
  echo "</table>";
  echo "\x20\x20\x20";
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
  echo "\x20\x20\x20";
?>

<input type="submit" value="Update" class="loginbuttons">

<!-- <p> Termin eintragen: </p> -->
<!-- <input type="submit" name="eintragen" value="klicked" class="loginbuttons"> -->
  		
</form>
</body>
</html>
