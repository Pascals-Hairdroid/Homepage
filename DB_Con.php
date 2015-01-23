<?php
include_once("conf/db_const.php");
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
	
	function terminEintragen($beginn, $dienstleistung, $mitarbeiterId, $kundeId, $arbeitsplatzId, $foto){
		return $this->call(DB_PC_TERMIN_EINTRAGEN, $beginn.",".$dienstleistung.",".$mitarbeiterId.",".$kundeId.",".$arbeitsplatzId.",".$foto);
	}
	
	function getFreieTermine($von, $bis){
		if($von <= $bis)
			return $this->call(DB_PC_FREIE_TERMINE, $von." , ".$bis);
		else
			throw new Exception("Von-Wert darf nicht größer sein als Bis-Wert!");
	}
	
	function kundeEintragen($email, $vorname, $nachname, $telNr, $freischaltung, $foto){
		return $this->query("INSERT INTO ".DB_TB_KUNDEN." (".DB_F_KUNDEN_EMAIL.", ".DB_F_KUNDEN_VORNAME.", ".DB_F_KUNDEN_NACHNAME.", ".DB_F_KUNDEN_TELNR.", ".DB_F_KUNDEN_FREISCHALTUNG.", ".DB_F_KUNDEN_FOTO.") VALUES (\"".$email."\", \"".$vorname."\", \"".$nachname."\", \"".$telNr."\", \"".$freischaltung."\", \"".$foto."\")");
	}
	
	function mitarbeiterEintragen($svnr, $vorname, $nachname, $admin){
		return $this->query("INSERT INTO ".DB_TB_MITARBEITER." (".DB_F_MITARBEITER_SVNR.", ".DB_F_MITARBEITER_VORNAME.", ".DB_F_MITARBEITER_NACHNAME.", ".DB_F_MITARBEITER_ADMIN.") VALUES (\"".$svnr."\", \"".$vorname."\", \"".$nachname."\", \"".$admin."\")");
	}
	
	function skillEintragen($id, $beschreibung){
		return $this->query("INSERT INTO ".DB_TB_SKILLS." (".DB_F_SKILLS_ID.", ".DB_F_SKILLS_BESCHREIBUNG.") VALUES (\"".$id."\", \"".$beschreibung."\")");
	}
	
	function skillZuweisen($skillId, $mitarbeiterSvnr){
		return $this->query("INSERT INTO ".DB_TB_MITARBEITER_SKILLS." (".DB_F_SKILLS_ID.", ".DB_F_SKILLS_BESCHREIBUNG.") VALUES (\"".$skillId."\", \"".$mitarbeiterSvnr."\")");
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