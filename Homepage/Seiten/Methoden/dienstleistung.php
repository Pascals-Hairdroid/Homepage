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
<form action="Methoden/zeittabelle.php" method="get" target="iframe">
 <?php
  include_once("../include_DBA.php");
  $db=new db_con("conf/db.php",true);

  
  //Damen/Herrenservice auswahl
  echo "Service: ";
  echo"<select name='dienstleistung' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray = array();
  echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == Null && !in_array($dienstleistung->getKuerzel(),$kuerzelArray))
  		echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>";
  	$kuerzelArray[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  
  //Schneiden?
  
  echo "&nbsp;&nbsp;<input type='checkbox' name='schneiden' checked> Schneiden &nbsp;&nbsp;";
  
  
  //Haartyp
  echo "&nbsp;Haartyp: ";
  echo"<select name='haarlaenge' size='1'>";
  echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  foreach ($db->getAllHaartyp() as $haartyp)
  	echo "<option style='width:17ex;'value='".$haartyp->getBezeichnung()."'>".$haartyp->getBezeichnung()." </option>";
  echo "</select>";
  
  
  //Färben/Strähnen/Tönung
  echo "&nbsp;Coloration: ";
  echo"<select name='dienstleistung2' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray2 = array();
  echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == 1 && !in_array($dienstleistung->getKuerzel(),$kuerzelArray2))
  	echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>";
  	$kuerzelArray2[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  include 'getBrowser.php';
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
<br><br>
<input type="submit" value="Update" class="loginbuttons">

<!-- <p> Termin eintragen: </p> -->
<!-- <input type="submit" name="eintragen" value="klicked" class="loginbuttons"> -->
  		
</form>
</body>
</html>
