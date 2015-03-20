<html>
<body>
<form action="methoden/zeittabelle.php" method="get" target="iframe">
 <?php
  include_once("../include_DBA.php");
  $db=new db_con("conf/db.php",true);

  
  echo"<select name='mitarbeiter' size='1'>";
  foreach ($db->getAllMitarbeiter() as $mitarbeiter)
  	echo "<option style='width:17ex;'value='".$mitarbeiter->getNachname()."'>".$mitarbeiter->getNachname().",".$mitarbeiter->getVorname()." </option>";
  echo "</select>"; 

	

  echo"<select name='haarlaenge' size='1'>";
  foreach ($db->getAllHaartyp() as $haartyp)
  	echo "<option style='width:17ex;'value='".$haartyp->getBezeichnung()."'>".$haartyp->getBezeichnung()." </option>";
  echo "</select>";
  
  
  //Damen/Herrenservice auswahl
  echo"<select name='dienstleistung' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray = array();
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == Null && !in_array($dienstleistung->getKuerzel(),$kuerzelArray))
  		echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>";
  		$kuerzelArray[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  
  //Färben/Strähnen/Tönung
  echo"<select name='dienstleistung2' size='1' style='display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px;'>";
  $kuerzelArray2 = array();
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == 1 && !in_array($dienstleistung->getKuerzel(),$kuerzelArray2))
  	echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getName()." </option>";
  	$kuerzelArray2[] = $dienstleistung->getKuerzel();
  }
  echo  "</select>";
  
  echo "<input type='week' name='week' style='' value=";
  echo date("o");
  echo "-W";
  echo date("W");			
  echo ">";
  
?>
<br><br>
<input type="submit" value="Update" class="loginbuttons">
</form>
</body>
</html>