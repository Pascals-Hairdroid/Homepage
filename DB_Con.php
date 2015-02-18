<?php
include_once("conf/db_const.php");
include_once("classes/Arbeitsplatz.php");
include_once("classes/Arbeitsplatzausstattung.php");
include_once("classes/Dienstleistung.php");
include_once("classes/Dienstzeit.php");
include_once("classes/Haartyp.php");
include_once("classes/Interesse.php");
include_once("classes/Kunde.php");
include_once("classes/Mitarbeiter.php");
include_once("classes/Produkt.php");
include_once("classes/Skill.php");
include_once("classes/Termin.php");
include_once("classes/Urlaub.php");
include_once("classes/Werbung.php");
include_once("classes/Wochentag.php");


class DB_Con {
	private $db_ADDRESS;
	private $db_SCHEMA_NAME;
	// User
	private $db_USER_NAME;
	private $db_USER_PASSWORD;
	// Admin
	private $db_ADMIN_NAME;
	private $db_ADMIN_PASSWORD;
	
	private $authKunde_Id;
	
	private $con;
	
	
	function __construct($conf_file, $admin){
		// include config
		$this->changeConfig($conf_file);
		$this->connect($admin);
	}
	
	
	function changeConfig($conf_file){ // throws Exception
		// include config
		include $conf_file;
		// check validity
		if(isset($cDB_ADDRESS) && 
		isset($cDB_SCHEMA_NAME) && 
		isset($cDB_USER_NAME) && 
		isset($cDB_USER_PASSWORD) && 
		isset($cDB_ADMIN_NAME) && 
		isset($cDB_ADMIN_PASSWORD)){
			// set config
			$this->db_ADDRESS = $cDB_ADDRESS;
			$this->db_SCHEMA_NAME = $cDB_SCHEMA_NAME;
			// User
			$this->db_USER_NAME = $cDB_USER_NAME;
			$this->db_USER_PASSWORD = $cDB_USER_PASSWORD;
			// Admin
			$this->db_ADMIN_NAME = $cDB_ADMIN_NAME;
			$this->db_ADMIN_PASSWORD = $cDB_ADMIN_PASSWORD;
		}
		else throw new Exception("Ungültige Konfigurationsdatei!");
	}
	
	function connect($admin){
		try{
			$this->con = mysqli_connect($this->db_ADDRESS,
				$admin?$this->db_ADMIN_NAME:$this->db_USER_NAME,
				$admin?$this->db_ADMIN_PASSWORD:$this->db_USER_PASSWORD,
				$this->db_SCHEMA_NAME);
			$this->authKunde_Id = null;
		}
		catch (Exception $e){
			throw new Exception("Verbindung zu Datenbank konne nicht hergestellt werden! Fehlermessage: {".$e->getMessage()."}");
		}
	}
	
	
	function terminEintragen($beginn, $dienstleistungId, $mitarbeiterId, $kundeId, $arbeitsplatzId, $foto){
		return $this->call(DB_PC_TERMIN_EINTRAGEN, $beginn.",".$dienstleistungId.",".$mitarbeiterId.",".$kundeId.",".$arbeitsplatzId.",".$foto);
	}
	
	
	function getFreieTermine(DateTime $von, DateTime $bis){
		if($von->format("U") <= $bis->format("U"))
			return  $this->call(DB_PC_FREIE_TERMINE, $von." , ".$bis);
		else
			throw new Exception("Von-Wert darf nicht größer sein als Bis-Wert!");
	}
	
	
	function kundeEintragen(Kunde $kunde){
		return $this->query("INSERT INTO ".DB_TB_KUNDEN." (".DB_F_KUNDEN_EMAIL.", ".DB_F_KUNDEN_VORNAME.", ".DB_F_KUNDEN_NACHNAME.", ".DB_F_KUNDEN_TELNR.", ".DB_F_KUNDEN_FREISCHALTUNG.", ".DB_F_KUNDEN_FOTO.") VALUES (\"".$kunde->getEmail()."\", \"".$kunde->getVorname()."\", \"".$kunde->getNachname()."\", \"".$kunde->getTelNr()."\", \"".$kunde->getFreischaltung()."\", \"".$kunde->getFoto()."\")");
	}

	function skillZuweisen(Skill $skill, Mitarbeiter $mitarbeiter){
		return $this->query("INSERT INTO ".DB_TB_MITARBEITER_SKILLS." (".DB_F_MITARBEITER_SKILLS_PK_SKILLS.", ".DB_F_MITARBEITER_SKILLS_PK_MITARBEITER.") VALUES (\"".$skill->getId()."\", \"".$mitarbeiter->getSvnr()."\")");
	}
	
	function skillEintragen(Skill $skill){
		return $this->query("INSERT INTO ".DB_TB_SKILLS." (".DB_F_SKILLS_ID.", ".DB_F_SKILLS_BESCHREIBUNG.") VALUES (\"".$skill->getId()."\", \"".$skill->getBeschreibung()."\")");
	}
	
	function mitarbeiterEintragen(Mitarbeiter $mitarbeiter){
		$main = $this->query("INSERT INTO ".DB_TB_MITARBEITER." (".DB_F_MITARBEITER_SVNR.", ".DB_F_MITARBEITER_VORNAME.", ".DB_F_MITARBEITER_NACHNAME.", ".DB_F_MITARBEITER_ADMIN.") VALUES (\"".$mitarbeiter->getSvnr()."\", \"".$mitarbeiter->getVorname()."\", \"".$mitarbeiter->getNachname()."\", \"".$mitarbeiter->getAdmin()."\")");
		foreach ($mitarbeiter->getSkills() as $skill){
			if($skill instanceof Skill)
				$this->skillZuweisen($skill, $mitarbeiter);
		} 
	}
	
	
	function authentifiziereKunde($kundeId){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_KUNDEN, DB_F_KUNDEN_FREISCHALTUNG, DB_F_KUNDEN_ID." = ".$kundeId));
		if(isset($row[0]))
			if($row[0]){
				$this->authKunde_Id = $kundeId;
				return true;
			}
			else
				throw new Exception("User ".$kundeId." nicht freigeschalten!");
		else
			throw new Exception("User ".$kundenId." nicht gefunden!");
	}
	
	
	function getWochentag($kuerzel){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_WOCHENTAGE, "*", DB_F_WOCHENTAGE_PK_KUERZEL." = \"".$kuerzel."\""));
		
		return new Wochentag($row->{DB_F_WOCHENTAGE_PK_KUERZEL},$row->{DB_F_WOCHENTAGE_BEZEICHNUNG});
	}
	
	function getInteresse($id){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_INTERESSEN, "*", DB_F_INTERESSEN_PK_ID." = \"".$id."\""));
		
		return new Interesse($row->{DB_F_INTERESSEN_PK_ID}, $row->{DB_F_INTERESSEN_BEZEICHNUNG});
	}
	
	function getProdukt($id){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_PRODUKTE, "*", DB_F_PRODUKTE_PK_ID." = \"".$id."\""));
		
		return new Produkt($row->{DB_F_PRODUKTE_PK_ID}, $row->{DB_F_PRODUKTE_NAME}, $row->{DB_F_PRODUKTE_HERSTELLER}, $row->{DB_F_PRODUKTE_BESCHREIBUNG}, $row->{DB_F_PRODUKTE_PREIS}, $row->{DB_F_PRODUKTE_BESTAND});
	}
	
	function getHaartyp($kuerzel){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_HAARTYPEN, "*", DB_F_HAARTYPEN_PK_KUERZEL." = \"".$kuerzel."\""));
		
		return new Haartyp($row->{DB_F_HAARTYPEN_PK_KUERZEL}, $row->{DB_F_HAARTYPEN_BEZEICHNUNG});
	}
	
	function getArbeitsplatzausstattung($id){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_ARBEITSPLATZAUSSTATTUNGEN, "*", DB_F_ARBEITSPLATZAUSSTATTUNGEN_PK_ID." = \"".$id."\""));
		
		return new Arbeitsplatzausstattung($row->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_PK_ID}, $row->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_NAME});
	}

	function getSkill($id){
		$row = mysqli_fetch_row($this->selectQuery(DB_TB_SKILLS, "*", DB_F_SKILLS_PK_ID." = \"".$id."\""));
		
		return new Skill($row->{DB_F_SKILLS_PK_ID}, $row->{DB_F_SKILLS_BESCHREIBUNG});
	}
	
	
	function getArbeitsplatz($nummer){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_ARBEITSPLATZRESSOURCEN, "*", DB_F_ARBEITSPLATZRESSOURCEN_PK_NUMMER." = \"".$nummer."\""));
		
		$abf = $this->selectQuery(DB_VIEW_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN, "*", DB_F_ARBEITSPLATZRESSOURCEN_ARBEITSPLATZAUSSTATTUNGEN_PK_ARBEITSPLATZRESSOURCEN." = \"".$nummer."\"");
		$ausstattungen = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($ausstattungen, new Arbeitsplatzausstattung($row->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_PK_ID}, $ausstattung->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_NAME}));
		}
		
		return new Arbeitsplatz($nummer, $main->{DB_F_ARBEITSPLATZRESSOURCEN_NAME}, $ausstattung);
	}
	
	function getDienstleistung($kuerzel,Haartyp $haartyp){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_DIENSTLEISTUNGEN, "*", DB_F_DIENSTLEISTUNGEN_PK_KUERZEL." = \"".$kuerzel."\" AND ".DB_F_DIENSTLEISTUNGEN_PK_HAARTYP." = \"".$haartyp->getKuerzel()."\""));
		
		$abf = $this->selectQuery(DB_VIEW_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN, "*", DB_F_DIENSTLEISTUNGEN_ARBEITSPLATZAUSSTATTUNGEN_PK_DIENSTLEISTUNGEN." = \"".$kuerzel."\"");
		$ausstattungen = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($ausstattungen, new Arbeitsplatzausstattung($row->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_PK_ID}, $ausstattung->{DB_F_ARBEITSPLATZAUSSTATTUNGEN_NAME}));
		}
		
		$abf = $this->selectQuery(DB_VIEW_DIENSTLEISTUNGEN_SKILLS, "*", DB_F_DIENSTLEISTUNGEN_SKILLS_PK_DIENSTLEISTUNGEN." = \"".$kuerzel."\"");
		$skills = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($skills, new Skill($row->{DB_F_SKILLS_PK_ID}, $row->{DB_F_SKILLS_BESCHREIBUNG}));
		}
		
		return new Dienstleistung($kuerzel, $haartyp, $main->{DB_F_DIENSTLEISTUNGEN_NAME}, $main->{DB_F_DIENSTLEISTUNGEN_BENOETIGTEEINHEITEN}, $main->{DB_F_DIENSTLEISTUNGEN_PAUSENEINHEITEN}, $skills, $ausstattungen, $main->{DB_F_DIENSTLEISTUNGEN_GRUPPIERUNG});
	}
	
	function getDienstzeit(Mitarbeiter $mitarbeiter, Wochentag $wochentag){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_DIENSTZEITEN, "*", DB_F_DIENSTZEITEN_PK_MITARBEITER." = \"".$mitarbeiter->getSvnr()."\" AND ".DB_F_DIENSTZEITEN_PK_WOCHENTAGE." = \"".$wochentag->getKuerzel()."\""));
		return new Dienstzeit($wochentag, new DateTime($main->{DB_F_DIENSTZEITEN_BEGINN}), new DateTime($main->{DB_F_DIENSTZEITEN_ENDE}));
	}
	
	function getKunde($email){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_KUNDEN, "*", DB_F_KUNDEN_PK_EMAIL." = \"".$email."\""));
		
		$abf = $this->selectQuery(DB_VIEW_KUNDEN_INTERESSEN, "*", DB_F_KUNDEN_INTERESSEN_PK_KUNDEN." = \"".$email."\"");
		$interessen = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($interessen, new Interesse($row->{DB_F_INTERESSEN_PK_ID}, $row->{DB_F_INTERESSEN_BEZEICHNUNG}));
		}
		
		return new Kunde($email, $main->{DB_F_KUNDEN_VORNAME}, $main->{DB_F_KUNDEN_NACHNAME}, $main->{DB_F_KUNDEN_TELNR}, $main->{DB_F_KUNDEN_FREISCHALTUNG}, $main->{DB_F_KUNDEN_FOTO}, $interessen);
	}
	
	function getMitarbeiter($svnr){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_MITARBEITER, "*", DB_F_MITARBEITER_PK_SVNR." = \"".$svnr."\""));
		
		$abf = $this->selectQuery(DB_VIEW_MITARBEITER_SKILLS, "*", DB_F_MITARBEITER_SKILLS_PK_MITARBEITER." = \"".$svnr."\"");
		$skills = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($skills, new Skill($row->{DB_F_SKILLS_PK_ID}, $row->{DB_F_SKILLS_BESCHREIBUNG}));
		}
		
		$abf = $this->selectQuery(DB_TB_URLAUBE, "*", DB_F_URLAUBE_PK_MITARBEITER." = \"".$svnr."\"");
		$urlaube = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($urlaube, new Urlaub($row->{DB_F_URLAUBE_PK_BEGINN}, $row->{DB_F_URLAUBE_ENDE}));
		}
		
		return new Mitarbeiter($svnr, $main->{DB_F_MITARBEITER_VORNAME}, $main->{DB_F_MITARBEITER_NACHNAME}, $skills, $main->{DB_F_MITARBEITER_ADMIN}, $urlaube);
	}
	
	function getWerbung($nummer){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_WERBUNG, "*", DB_F_WERBUNG_PK_NUMMER." = \"".$nummer."\""));
		
		$abf = $this->selectQuery(DB_VIEW_WERBUNG_INTERESSEN, "*", DB_F_WERBUNG_INTERESSEN_PK_WERBUNG." = \"".$nummer."\"");
		$interessen = array();
		while ($row = mysqli_fetch_row($abf)){
			array_push($interessen, new Interesse($row->{DB_F_INTERESSEN_PK_ID}, $row->{DB_F_INTERESSEN_BEZEICHNUNG}));
		}
		
		return new Werbung($nummer, $interessen);
	}
	
	function getTermin(DateTime $zeitstempel, Mitarbeiter $mitarbeiter){
		$main = mysqli_fetch_row($this->selectQuery(DB_TB_ZEITTABELLE, "*", DB_F_ZEITTABELLE_PK_ZEITSTEMPEL." = \"".$zeitstempel->format("Y-m-d H:i:s")."\" AND ".DB_F_ZEITTABELLE_PK_MITARBEITER." = \"".$mitarbeiter->getSvnr()."\"")); 
		
		return new Termin($zeitstempel, $mitarbeiter, $this->getArbeitsplatz($main->{DB_F_ZEITTABELLE_ARBEITSPLATZ}), $this->getKunde($main->{DB_F_ZEITTABELLE_KUNDE}), $main->{DB_F_ZEITTABELLE_FRISURWUNSCH}, $this->getDienstleistung($main->{DB_F_ZEITTABELLE_DIENSTLEISTUNG}, $this->getHaartyp($main->{DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP})));
	}
	
	
	
	function call($name, $params){
		return $this->query("CALL ".$name."(".$params.");");
	}
	
	function selectQuery($name, $fields, $where_clause){
		return $this->query("SELECT * FROM ".$name." WHERE ".$where_clause.";");
	}
	
	function selectQueryField($name, $fields){
		return $this->query("SELECT ".$fields." FROM ".$name);
	}
	
	function selectQueryTable($name){
		return $this->selectQuery($name, "*");
	}
	
	function query($query_string){
		if(isset($this->con))
			return mysqli_query($this->con, $query_string);
		else
			throw new Exception("Keine Verbindung zur Datenbank!");
	}
	
	function __destruct(){
		if($this->con instanceof mysqli)
			mysqli_close($this->con);
	}
}
?>