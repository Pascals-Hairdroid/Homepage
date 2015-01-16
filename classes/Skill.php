<?php 
class Skill {
	private $id;
	private $beschreibung;
	
	function __construct($id, $beschreibung){
		$this->setId($id);
		$this->setBeschreibung($beschreibung);
	}
	
	function setId($id){
		if(is_int($id))
			$this->id = $id;
		else 
			throw new Exception("Id ungültig!");
	}
	
	function setBeschreibung($beschreibung){
		if(is_string($beschreibung))
			$this->beschreibung = $beschreibung;
		else
			throw new Exception("Beschriebung ungültig!");
	}
}
?>