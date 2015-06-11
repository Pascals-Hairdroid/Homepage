<?php session_start();
include("../include_DBA.php");
$db=new db_con("conf/db.php",true);?>
<!DOCTYPE html>
<html>
<head>

<title>PASCALS HAIRSTYLE</title>
<link rel='stylesheet' type='text/css' href='../css/css.css'>

<?php 
if(isset($_GET['web']))
	echo "<link rel='stylesheet' type='text/css' href='../css/hide.css'>";
?>


<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
		<div class="hide" id="streifen"></div>

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
							echo"<label><a href='Seiten/forgotPassword.php'> Forgot Password </a></label>";
							echo"</fieldset>";
							echo"</form>";
								}
								else{
									echo"<li id='login'>";
									echo"<a href='Seiten/Anmeldung/endSession.php'>Logout</span></a>";
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
							echo"><a href='Seiten/Profil.php'>Profil</a></li>";
							if($_SESSION['admin']==true){
							echo"<li id='signup'><a href='Seiten/Verwaltung/Verwaltungsmain.php'>Adminbereich</a></li>";
							}

							}
							else{
								echo"<li id='signup'>";
								echo"<a href='Seiten/registration.php'>Registrieren</a>";
								echo"</li>";
							}
							?>

			</ul>
			</nav>
		</div>
		<div id="head">
			<a href="#" style="color:black;"><h1>
				<?php
			if(isset($_GET['web']))include ("HTML/headerNoLink.html");
			else include ("HTML/header.html");
			?>
			</h1>
			<h2>Frisuren zum Wohlf&uuml;hlen</h2>
		</a></div>

		<div id="hmenu">
			<nav id="menu">
				<ul class="hide">
					<li><a href="index.php" class="selected">Friseurstudio</a>
						<ul>
							<li><a href="studio.php">Das Studio</a></li>
							<li><a href="team.php">Unser Team</a></li>
							<li><a href="dienstleistung.php">Dienstleistungen</a></li>
							<li><a href="offnungszeiten.php">&Ouml;ffnungszeiten</a></li>
							<li><a href="kontakt.php">Kontakt</a></li>
						</ul>
					</li>
					<li><a href="terminvergabe.php">Termine</a></li>
					<li><a href="Angebote.php">Angebote</a></li>
					<li class="topmenu"><a href="#"> Produkte</a>
						<ul>
							<?php 
							$produktkategorie=$db->getAllProduktkategorie();


							foreach ($produktkategorie as $prod){

          echo umlaute_encode(" <li class='submenu'><a href='Seiten/Produkte.php?Kat=".$prod->getKuerzel()."'>".$prod->getBezeichnung()."</a></li>");
         }
         ?>
						</ul>
					</li>
					<li><a href="Seiten/Galerie.php">Galerie</a></li>
					<li class="spacer"></li>
				</ul>
			</nav>
		</div>



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
				<p>Gesellschaft mit beschr�nkter Haftung</p>
				<h3>Berufsbezeichung</h3>
				<p>Friseur, �sterreich</p>
				<h3>Umsatzsteuer ID</h3>
				<p>12345678</p><br>
			</p>
			<br>
			<p>
			<h1 style="color:black;">HAFTUNGSAUSSCHLUSS</h1>
			<br> 
			<h2>1. Inhalt des Onlineangebotes</h2>
			<p>
			Der Autor �bernimmt keinerlei Gew�hr f�r die Aktualit�t, Korrektheit,
			Vollst�ndigkeit oder Qualit�t der bereitgestellten Informationen.
			Haftungsanspr�che gegen den Autor, welche sich auf Sch�den
			materieller oder ideeller Art beziehen, die durch die Nutzung oder
			Nichtnutzung der dargebotenen Informationen bzw. durch die Nutzung
			fehlerhafter und unvollst�ndiger Informationen verursacht wurden,
			sind grunds�tzlich ausgeschlossen, sofern seitens des Autors kein
			nachweislich vors�tzliches oder grob fahrl�ssiges Verschulden
			vorliegt. Alle Angebote sind freibleibend und unverbindlich. Der
			Autor beh�lt es sich ausdr�cklich vor, Teile der Seiten oder das
			gesamte Angebot ohne gesonderte Ank�ndigung zu ver�ndern, zu
			erg�nzen, zu l�schen oder die Ver�ffentlichung zeitweise oder
			endg�ltig einzustellen.</p>
			<br><br>
			<h2>2. Verweise und Links</h2>
			<p>
			Bei direkten oder indirekten Verweisen auf fremde Webseiten
			("Hyperlinks"), die au�erhalb des Verantwortungsbereiches des Autors
			liegen, w�rde eine Haftungsverpflichtung ausschlie�lich in dem Fall
			in Kraft treten, in dem der Autor von den Inhalten Kenntnis hat und
			es ihm technisch m�glich und zumutbar w�re, die Nutzung im Falle
			rechtswidriger Inhalte zu verhindern. Der Autor erkl�rt hiermit
			ausdr�cklich, dass zum Zeitpunkt der Linksetzung keine illegalen
			Inhalte auf den zu verlinkenden Seiten erkennbar waren. Auf die
			aktuelle und zuk�nftige Gestaltung, die Inhalte oder die
			Urheberschaft der verlinkten/verkn�pften Seiten hat der Autor
			keinerlei Einfluss. Deshalb distanziert er sich hiermit ausdr�cklich
			von allen Inhalten aller verlinkten /verkn�pften Seiten, die nach der
			Linksetzung ver�ndert wurden. Diese Feststellung gilt f�r alle
			innerhalb des eigenen Internetangebotes gesetzten Links und Verweise
			sowie f�r Fremdeintr�ge in vom Autor eingerichteten G�steb�chern,
			Diskussionsforen, Linkverzeichnissen, Mailinglisten und in allen
			anderen Formen von Datenbanken, auf deren Inhalt externe
			Schreibzugriffe m�glich sind. F�r illegale, fehlerhafte oder
			unvollst�ndige Inhalte und insbesondere f�r Sch�den, die aus der
			Nutzung oder Nichtnutzung solcherart dargebotener Informationen
			entstehen, haftet allein der Anbieter der Seite, auf welche verwiesen
			wurde, nicht derjenige, der �ber Links auf die jeweilige
			Ver�ffentlichung lediglich verweist.</p>
			<br><br>
			<h2>3. Urheber- und Kennzeichenrecht</h2>
			<p>Der Autor ist bestrebt, in allen Publikationen die Urheberrechte der
			verwendeten Bilder, Grafiken, Tondokumente, Videosequenzen und Texte
			zu beachten, von ihm selbst erstellte Bilder, Grafiken, Tondokumente,
			Videosequenzen und Texte zu nutzen oder auf lizenzfreie Grafiken,
			Tondokumente, Videosequenzen und Texte zur�ckzugreifen. Alle
			innerhalb des Internetangebotes genannten und ggf. durch Dritte
			gesch�tzten Marken- und Warenzeichen unterliegen uneingeschr�nkt den
			Bestimmungen des jeweils g�ltigen Kennzeichenrechts und den
			Besitzrechten der jeweiligen eingetragenen Eigent�mer. Allein
			aufgrund der blo�en Nennung ist nicht der Schluss zu ziehen, dass
			Markenzeichen nicht durch Rechte Dritter gesch�tzt sind! Das
			Copyright f�r ver�ffentlichte, vom Autor selbst erstellte Objekte
			bleibt allein beim Autor der Seiten. Eine Vervielf�ltigung oder
			Verwendung solcher Grafiken, Tondokumente, Videosequenzen und Texte
			in anderen elektronischen oder gedruckten Publikationen ist ohne
			ausdr�ckliche Zustimmung des Autors nicht gestattet.</p>
			<br><br>
			<h2>4. Datenschutz</h2>
			<p>
			Sofern innerhalb des Internetangebotes die M�glichkeit zur Eingabe
			pers�nlicher oder gesch�ftlicher Daten (Emailadressen, Namen,
			Anschriften) besteht, so erfolgt die Preisgabe dieser Daten seitens
			des Nutzers auf ausdr�cklich freiwilliger Basis. Die Inanspruchnahme
			und Bezahlung aller angebotenen Dienste ist - soweit technisch
			m�glich und zumutbar - auch ohne Angabe solcher Daten bzw. unter
			Angabe anonymisierter Daten oder eines Pseudonyms gestattet. Die
			Nutzung der im Rahmen des Impressums oder vergleichbarer Angaben
			ver�ffentlichten Kontaktdaten wie Postanschriften, Telefon- und
			Faxnummern sowie Emailadressen durch Dritte zur �bersendung von nicht
			ausdr�cklich angeforderten Informationen ist nicht gestattet.
			Rechtliche Schritte gegen die Versender von sogenannten Spam-Mails
			bei Verst�ssen gegen dieses Verbot sind ausdr�cklich vorbehalten.</p>
			<br><br>
			<h2>5. Rechtswirksamkeit dieses Haftungsausschlusses</h2>
			<p>Dieser Haftungsausschluss ist als Teil des Internetangebotes zu
			betrachten, von dem aus auf diese Seite verwiesen wurde. Sofern Teile
			oder einzelne Formulierungen dieses Textes der geltenden Rechtslage
			nicht, nicht mehr oder nicht vollst�ndig entsprechen sollten, bleiben
			die �brigen Teile des Dokumentes in ihrem Inhalt und ihrer G�ltigkeit
			davon unber�hrt.</p>
			
			
	</div>
	<div id="footer" align="center" class="hide">
			<?php
			include("HTML/footer.html");
			?>
		</div>
	</div>
	
</body>
</html>
