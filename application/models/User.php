<?php
class User extends ActiveRecord\ActiveRecord\Model
{
	var $password = FALSE;
	
	function before_save()
	{
		if($this->password)
			$this->pass = $this->pass($this->password);
	}
	
	private function hash_password($password)
	{
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$hash = hash('sha256', $salt . $password);
		
		return $salt . $hash;
	}
	
	private function validate_password($password)
	{
		$salt = substr($this->pass, 0, 64);
		$hash = substr($this->pass, 64, 64);
		
		$password_hash = hash('sha256', $salt . $password);
		
		return $password_hash == $hash;
	}
	
	public static function login($username, $password)
	{
		
	}
}
?>