<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html> 
<html>
	<head>
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
    $('#login-trigger').click(function() {
        $(this).next('#login-content').slideToggle();
        $(this).toggleClass('active');                    
        
        if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
        })
});
		</script>
	</head>
	<body>
<?php
include("Anmeldung/registration.php");
include("Anmeldung/login.php");
if(isset($_POST["submit2"])){
$skillarray = array();
$ausstattungsarray=array();
foreach($db->getAllSkill() as $int)
	{
		if(isset ($_POST[$int->getID()]))
			$int = new Skill($int->getID(),$int->getBeschreibung());
		$skillarray[]=$int;
	}
foreach($db->getAllArbeitsplatzausstattung() as $int)
	{
		if(isset ($_POST[$int->getID()]))
			$int = new Arbeitsplatzausstattung($int->getID(), $int->getName());
		$ausstattungsarray[]=$int;
	}
	$haartyp2=$db->getHaartyp($_POST['laenge']);

	$dienstleistung = new Dienstleistung($_POST['kuerzl'],$haartyp2 , $_POST['name'], $_POST['einheiten'], $_POST['pause'], $skillarray, $ausstattungsarray, $_POST['group']);
	$db->dienstleistungEintragen($dienstleistung);
}
	?>
<div id="container">
<div id="streifen"></div>
<div id="main">
<div id="Loginbox" class="hide">
					<nav>
						<ul>
						<?php
						if(!isset($_SESSION['username'])){
							echo"<li id='login'>";
								echo"<a id='login-trigger' href='#'>Login <span>&#x25BC;</span></a>";
								echo"<div id='login-content'>";
									echo"<form method='post' action=''>";
										echo"<fieldset id='inputs'>";
											echo"<input id='username' type='text' name='username' placeholder='Username' required>";   
											echo"<input id='password' type='password' name='passwort' placeholder='Passwort' required>";
										echo"</fieldset>";
										echo"<fieldset id='actions'>";
											echo"<input type='submit' name ='submit' id='submit' value='Log in'>";
											echo"<label><a href='forgotPassword.php'> Forgot Password </a></label>";
										echo"</fieldset>";
									echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Anmeldung/endSession.php'>Logout</span></a>";
									echo"<div id='login-content'>";	
								}
									?>
								</div>                     
							</li>
							<?php
							if(isset($_SESSION['username'])){
							echo"<li "; 
							if($_SESSION['admin']==false)
							echo"id='signup'";
							else
							echo"id='element'";	
							echo"><a href='Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='Verwaltung/Verwaltungsmain.php'>Adminbereich</a></li>";
							}
													
							}
							else{
								echo"<li id='signup'>";
								echo"<a href='registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>
						</ul>
					</nav>
			</div>
			<div id="head">
			<?php
					include ("HTML/header.html");
					
				?>
			</div>
			<div id="menu">
    <ul>
      <li class="topmenu">
        <a href="../index.php">Friseurstudio</a>
        <ul>
          <li class="submenu"><a href="studio.php">Das Studio</a></li>
          <li class="submenu"><a href="team.php">Unser Team</a></li>
          <li class="submenu"><a href="dienstleistung.php">Dienstleistungen</a></li>
          <li class="submenu"><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a></li>
          <li class="submenu"><a href="kontakt.php">Kontakt</a></li>
        </ul>
      </li>
      <li class="topmenu">
        <a href="terminvergabe.php">Termine</a>        
      </li>
      <li class="topmenu">
        <a href="Angebote.php">Angebote</a>
      </li>
	 <li class="topmenu">
       <a href="#"> Produkte</a>
         <ul>
        <?php 
       	$produktkategorie=$db->getAllProduktkategorie();
       	
       	
        	foreach ($produktkategorie as $prod){
		
          echo" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>";
         }
         ?>
        </ul>
      </li>
	  <li class="topmenu">
        <a href="Galerie.php">Galerie</a>
      </li>
    </ul>
  </div>
			<div id="wrapper">
				<div id="textArea">
				
					<table border="0">
						<form method="post" action="">
							<tr><td>K&uuml;rzel</td><td><input type="text" name="kuerzl" required="required"/></td></tr>
							<tr><td>Dienstleistungsname</td><td><input type="text" name="name" required="required"/></td></tr>
							<tr><td>Haarl&auml;nge</td>
							<td>
							<?php 
								echo"<select name='laenge' size='1'>";
	 							echo "<option style='width:17ex;'value='Null'> Keine Auswahl </option>";
  								foreach ($db->getAllHaartyp() as $haartyp)
  									echo "<option style='width:17ex;'value='".$haartyp->getKuerzel()."'>".$haartyp->getBezeichnung()." </option>";					
							?>
							</select></td></tr>
							<tr><td>Ben&ouml;tigte Einheiten</td><td><input type="text" name="einheiten" required="required"/></td></tr>
							<tr><td>Pauseneinheiten</td><td><input type="text>" name="pause" required="required"/></td></tr>
							<tr><td>Gruppe</td><td><input type="text>" name="group" required="required"/></td></tr>
							<tr><td>Skills:</td></tr><tr>
							<?php 
							$i=0;
							foreach($db->getAllSkill() as $skills)
							{
								
								$i++;
								
								echo "<td><input type='checkbox' name='".$skills->getID()."'>".$skills->getBeschreibung()." </input></td>";
								
								if ($i % 3 === 0) echo "</tr><tr>";
							}
							
							
							?>
							</tr>
							<tr><td>Arbeitsplatzausstattung:</td></tr><tr>	
							<?php 	
							$i=0;
							foreach($db->getAllArbeitsplatzausstattung() as $ausstattung)
							{
								
								$i++;
								
								echo "<td><input type='checkbox' name='".$ausstattung->getID()."'>".$ausstattung->getName()." </input></td>";
								
								if ($i % 3 === 0) echo "</tr><tr>";
							}
							
							
							?>
							<tr><td><input type="submit" value ="absenden" name="submit2"></td>
							
						</form>
					</table>
					<?php
						if(isset($ausgabe))
							echo $ausgabe;
						?>
					</div>
				
			</div>
			<div id="footer" align="center">
				<?php
					include("HTML/footer.html");
					
				?>
			</div>
</div></div>
	</body>
</html>