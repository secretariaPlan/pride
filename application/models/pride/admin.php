<?php

class Admin extends ActiveRecord\Model {
	
	static $table_name = "administrador";
	
	public function loginAdmin($rfc,$pass) {
		$admin = Admin::first(array("conditions" => array("rfc = ? AND password = ?",$rfc,$pass) ));
		if(isset($admin))return true;
		else return false;
	}
	
	
}

?>