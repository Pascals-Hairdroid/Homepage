<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
      <title>PASCALS HAIRSTYLE</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='../css/hide.css'>";
?>
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
		include("Anmeldung/login.php");
		if(isset($_POST['submit'])){
			$passwort = md5($_POST['passwort']);
			$username=$_POST['username'];
			$weiterleitung=login($username,$passwort);
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
					if(isset($_GET['web']))include ("HTML/headerNoLink.html");
			else include ("HTML/header.html");
				?>
			</div>
			<div id="menu" class="hide">
    <ul>
      <li class="topmenu">
        <a href="../index.php" >Friseurstudio</a>
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
		
          echo umlaute_encode(" <li class='submenu'><a href='Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>");
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
					
		<br>
			<h2>ADRESSDATEN</h2>
			<p>
				PASCALS HAIRSTYLE<br> 
				Hairstyle Kagranerplatz GMBH<br>
				Wagramerstrasse 154 a<br> 
				1220 Wien
			</p>
			<br>
			<h2>KONTAKTDATEN</h2>
			<p>
				Telefon: +43676 92 38 217<br> 
				E-Mail: office@pascals.at<br>
				Internet: http://www.pascals.at<br>
			</p>
			<br>
			<h2>RECHTLICHE INFORMATIONEN</h2>
			<p>
		
				<h3>Inhaber</h3>
				<p>Herr Pascal Petritsch </p>
				<h3>Rechtsform</h3>
				<p>Gesellschaft mit beschr&auml;nkter Haftung</p>
				<h3>Berufsbezeichung</h3>
				<p>Friseur, &Ouml;sterreich</p>
				<h3>Umsatzsteuer ID</h3>
				<p>ATU67500028</p><br>
			</p>
			<br>
			<p>
			<h1 style="color:black;">HAFTUNGSAUSSCHLUSS</h1>
			<br> 
			<h2>1. Inhalt des Onlineangebotes</h2>
			<p>
			Der Autor &uuml;bernimmt keinerlei Gew&auml;hr f&uuml;r die Aktualit&auml;t, Korrektheit,
			Vollst&auml;ndigkeit oder Qualit&auml;t der bereitgestellten Informationen.
			Haftungsanspr&uuml;che gegen den Autor, welche sich auf Sch&auml;den
			materieller oder ideeller Art beziehen, die durch die Nutzung oder
			Nichtnutzung der dargebotenen Informationen bzw. durch die Nutzung
			fehlerhafter und unvollst&auml;ndiger Informationen verursacht wurden,
			sind grunds&auml;tzlich ausgeschlossen, sofern seitens des Autors kein
			nachweislich vors&auml;tzliches oder grob fahrl&auml;ssiges Verschulden
			vorliegt. Alle Angebote sind freibleibend und unverbindlich. Der
			Autor beh&auml;lt es sich ausdr&uuml;cklich vor, Teile der Seiten oder das
			gesamte Angebot ohne gesonderte Ank&uuml;ndigung zu ver&auml;ndern, zu
			erg&auml;nzen, zu l&ouml;schen oder die Ver&ouml;ffentlichung zeitweise oder
			endg&uuml;ltig einzustellen.</p>
			<br><br>
			<h2>2. Verweise und Links</h2>
			<p>
			Bei direkten oder indirekten Verweisen auf fremde Webseiten
			("Hyperlinks"), die au&szlig;erhalb des Verantwortungsbereiches des Autors
			liegen, w&uuml;rde eine Haftungsverpflichtung ausschlie&szlig;lich in dem Fall
			in Kraft treten, in dem der Autor von den Inhalten Kenntnis hat und
			es ihm technisch m&ouml;glich und zumutbar w&auml;re, die Nutzung im Falle
			rechtswidriger Inhalte zu verhindern. Der Autor erkl&auml;rt hiermit
			ausdr&uuml;cklich, dass zum Zeitpunkt der Linksetzung keine illegalen
			Inhalte auf den zu verlinkenden Seiten erkennbar waren. Auf die
			aktuelle und zuk&uuml;nftige Gestaltung, die Inhalte oder die
			Urheberschaft der verlinkten/verkn&uuml;pften Seiten hat der Autor
			keinerlei Einfluss. Deshalb distanziert er sich hiermit ausdr&uuml;cklich
			von allen Inhalten aller verlinkten /verkn&uuml;pften Seiten, die nach der
			Linksetzung ver&auml;ndert wurden. Diese Feststellung gilt f&uuml;r alle
			innerhalb des eigenen Internetangebotes gesetzten Links und Verweise
			sowie f&uuml;r Fremdeintr&auml;ge in vom Autor eingerichteten G&auml;steb&uuml;chern,
			Diskussionsforen, Linkverzeichnissen, Mailinglisten und in allen
			anderen Formen von Datenbanken, auf deren Inhalt externe
			Schreibzugriffe m&ouml;glich sind. F&uuml;r illegale, fehlerhafte oder
			unvollst&auml;ndige Inhalte und insbesondere f&uuml;r Sch&auml;den, die aus der
			Nutzung oder Nichtnutzung solcherart dargebotener Informationen
			entstehen, haftet allein der Anbieter der Seite, auf welche verwiesen
			wurde, nicht derjenige, der &uuml;ber Links auf die jeweilige
			Ver&ouml;ffentlichung lediglich verweist.</p>
			<br><br>
			<h2>3. Urheber- und Kennzeichenrecht</h2>
			<p>Der Autor ist bestrebt, in allen Publikationen die Urheberrechte der
			verwendeten Bilder, Grafiken, Tondokumente, Videosequenzen und Texte
			zu beachten, von ihm selbst erstellte Bilder, Grafiken, Tondokumente,
			Videosequenzen und Texte zu nutzen oder auf lizenzfreie Grafiken,
			Tondokumente, Videosequenzen und Texte zur&uuml;ckzugreifen. Alle
			innerhalb des Internetangebotes genannten und ggf. durch Dritte
			gesch&uuml;tzten Marken- und Warenzeichen unterliegen uneingeschr&auml;nkt den
			Bestimmungen des jeweils g&uuml;ltigen Kennzeichenrechts und den
			Besitzrechten der jeweiligen eingetragenen Eigent&uuml;mer. Allein
			aufgrund der blo&szlig;en Nennung ist nicht der Schluss zu ziehen, dass
			Markenzeichen nicht durch Rechte Dritter gesch&uuml;tzt sind! Das
			Copyright f&uuml;r ver&ouml;ffentlichte, vom Autor selbst erstellte Objekte
			bleibt allein beim Autor der Seiten. Eine Vervielf&auml;ltigung oder
			Verwendung solcher Grafiken, Tondokumente, Videosequenzen und Texte
			in anderen elektronischen oder gedruckten Publikationen ist ohne
			ausdr&uuml;ckliche Zustimmung des Autors nicht gestattet.</p>
			<br><br>
			<h2>4. Datenschutz</h2>
			<p>
			Sofern innerhalb des Internetangebotes die M&ouml;glichkeit zur Eingabe
			pers&ouml;nlicher oder gesch&auml;ftlicher Daten (Emailadressen, Namen,
			Anschriften) besteht, so erfolgt die Preisgabe dieser Daten seitens
			des Nutzers auf ausdr&uuml;cklich freiwilliger Basis. Die Inanspruchnahme
			und Bezahlung aller angebotenen Dienste ist - soweit technisch
			m&ouml;glich und zumutbar - auch ohne Angabe solcher Daten bzw. unter
			Angabe anonymisierter Daten oder eines Pseudonyms gestattet. Die
			Nutzung der im Rahmen des Impressums oder vergleichbarer Angaben
			ver&ouml;ffentlichten Kontaktdaten wie Postanschriften, Telefon- und
			Faxnummern sowie Emailadressen durch Dritte zur &uuml;bersendung von nicht
			ausdr&uuml;cklich angeforderten Informationen ist nicht gestattet.
			Rechtliche Schritte gegen die Versender von sogenannten Spam-Mails
			bei Verst&ouml;ssen gegen dieses Verbot sind ausdr&uuml;cklich vorbehalten.</p>
			<br><br>
			<h2>5. Rechtswirksamkeit dieses Haftungsausschlusses</h2>
			<p>Dieser Haftungsausschluss ist als Teil des Internetangebotes zu
			betrachten, von dem aus auf diese Seite verwiesen wurde. Sofern Teile
			oder einzelne Formulierungen dieses Textes der geltenden Rechtslage
			nicht, nicht mehr oder nicht vollst&auml;ndig entsprechen sollten, bleiben
			die &uuml;brigen Teile des Dokumentes in ihrem Inhalt und ihrer G&uuml;ltigkeit
			davon unber&uuml;hrt.</p>
			
			
	
			</div>
			<div id="footer" align = "center" class="hide">
				<?php
					include("HTML/footer.html");
				?>
			</div>
		</div>
	</body>
</html>
