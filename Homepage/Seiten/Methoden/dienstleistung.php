<html>
<body>
<form action="zeittabelle.php" method="get" target="iframe">
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
  echo"<select name='dienstleistung' size='2'>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == Null)
  	echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getKuerzel()." </option>";
  }
  echo  "</select>";
  
  //F�rben/Str�hnen/T�nung
  echo"<select name='dienstleistung2' size='3'>";
  foreach ($db->getAllDienstleistung() as $dienstleistung)
  {
  	if ($dienstleistung->getGruppierung() == 1)
  	echo "<option style='width:17ex;'value='".$dienstleistung->getKuerzel()."'>".$dienstleistung->getKuerzel()." </option>";
  }
  echo  "</select>";
  
?>
<br><br>
<input type="submit" value="Update" class="loginbuttons">
</form>
</body>
</html>