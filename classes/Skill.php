<?php 
class Skill {
	private $id;
	private $beschreibung;
	
	function __construct($id, $beschreibung){
		$this->id = $id;
		$this->beschreibung = $beschreibung;
	}
}
?>