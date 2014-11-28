<?php

class DB_Con {
	private $db_address;
	private $db_user_name;
	private $db_user_password;
	private $db_admin_name;
	private $db_admin_password;
	
	function __construct($conf_file){
		// include config
		include_once $conf_file;
		$this->db_address = $DB_ADDRESS;
		$this->db_admin_name = $DB_ADMIN_NAME;
		$this->db_admin_password = $DB_ADMIN_PASSWORD;
		$this->db_user_name = $DB_USER_NAME;
		$this->db_user_password = $DB_USER_PASSWORD;
	}
	
	
	
}
?>