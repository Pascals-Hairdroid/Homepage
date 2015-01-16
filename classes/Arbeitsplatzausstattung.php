<?php 
class Arbeitsplatzausstattung{
	private $id;
	private $name;
	
	function __construct($id, $name){
		$this->setId($id);
		$this->setName($name);
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
}
?>