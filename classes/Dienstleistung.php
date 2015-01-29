<?php
include_once 'Skill.php';
include_once 'Arbeitsplatzausstattung.php';
include_once 'Haartyp.php';
class Dienstleistung{
	private $kuerzel;
	private $haartyp;
	private $name;
	private $benoetigteEinheiten;
	private $pausenEinheiten;
	private $skills = array();
	private $arbeitsplatzausstattungen = array();
	private $gruppierung;
	
	function __construct($kuerzel, Haartyp $haartyp, $name, $benoetigteEinheiten, $pausenEinheiten, array $skills, array $arbeitsplatzausstattungen, $gruppierung){
		$this->setKuerzel($kuerzel);
		$this->setName($name);
		$this->setBenoetigteEinheiten($benoetigteEinheiten);
		$this->setPausenEinheiten($pausenEinheiten);
		$this->setSkills($skills);
		$this->setArbeitsplatzausstattungen($arbeitsplatzausstattungen);
		$this->setGruppierung($gruppierung);
		$this->setHaartyp($haartyp);
	}
	
	function setKuerzel($kuerzel){
		if(is_string($kuerzel))
			$this->kuerzel = $kuerzel;
		else
			throw new Exception("Kuerzel ungültig!");
	}
	
	function setHaartyp(Haartyp $haartyp){
		$this->haartyp = $haartyp;
	}
	
	function setName($name){
		if(is_string($name))
			$this->name = $name;
		else
			throw new Exception("Name ungültig!");
	}
	
	function setBenoetigteEinheiten($benoetigteEinheiten){
		if(is_int($benoetigteEinheiten))
			$this->benoetigteEinheiten = $benoetigteEinheiten;
		else
			throw new Exception("Benoetigte Einheiten ungültig!");
	}
	
	function setPausenEinheiten($pausenEinheiten){
		if(is_int($pausenEinheiten))
			$this->pausenEinheiten = $pausenEinheiten;
		else
			throw new Exception("Pausen Einheiten ungültig!");
	}
	
	function setSkills(array $skills){
		foreach($skills as $skill)
		if(!($skill instanceof Skill))
			throw new Exception("Skill ungültig!");
	}
	
	function setArbeitsplatzausstattungen(array $arbeitsplatzausstattungen){
		foreach($arbeitsplatzausstattungen as $arbeitsplatzausstattung)
		if(!($arbeitsplatzausstattung instanceof Arbeitsplatzausstattung))
			throw new Exception("Arbeitsplatzausstattung ungültig!");
	}
	
	function setGruppierung($gruppierung){
		if(is_int($gruppierung))
			$this->gruppierung = $gruppierung;
		else
			throw new Exception("Gruppierung ungültig!");
	}
}
?>