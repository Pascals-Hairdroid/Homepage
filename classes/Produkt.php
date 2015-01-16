<?php 
class Produkt{
	private $id;
	private $name;
	private $hersteller;
	private $beschreibung;
	private $preis;
	private $bestand;
	
	
	function __construct($id, $name, $hersteller, $beschreibung, $preis, $bestand){
		$this->setId($id);
		$this->setName($name);
		$this->setHersteller($hersteller);
		$this->setBeschreibung($beschreibung);
		$this->setPreis($preis);
		$this->setBestand($bestand);
	}
	
	
	function setId($id){
		if(is_int($id))
			$this->id = $id;
		else
			throw new Exception("Id ungültig!");
	}
	
	function setName($name){
		if(is_string($name))
			$this->name = $name;
		else
			throw new Exception("Name ungültig!");
	}
	
	function setHersteller($hersteller){
		if(is_string($hersteller))
			$this->hersteller = $hersteller;
		else
			throw new Exception("Hersteller ungültig!");
	}
	
	function setBeschreibung($beschreibung){
		if(is_string($beschreibung))
			$this->beschreibung = $beschreibung;
		else
			throw new Exception("Beschreibung ungültig!");
	}
	
	function setPreis($preis){
		if(is_double($preis))
			$this->preis = $preis;
		else
			throw new Exception("Preis ungültig!");
	}
	
	
	function setBestand($bestand){
		if(is_int($bestand))
			$this->bestand = $bestand;
		else
			throw new Exception("Bestand ungültig!");
	}
	
}
?>