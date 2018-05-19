<?php
require("Bundle.php");
Class User
{
	public function create($uname, $upass)
	{
		$user = R::dispense("users");
		$user->username = $uname;
		$user->password = password_hash($upass);
		$user->literacy = 00.00;
		if(!$this::userExists($uname)){
			if(!R::store($user))
			{
				throw new Exception("Redbean store failure.");
			}
		} else {
			throw new Exception("User does not exist.");
		}

	}

	public function login($uname, $upass)
	{
		if($this::userExists($uname))
		{
			$user = R::load("users", $this::unameToId($uname));
			if(password_verify($upass, $user->password))
			{
				return true;
			} else {
				throw new Exception("Incorrect username or password.");
			}
		}
	}

	public function getUserInfo($uname)
	{
		if($this::userExists($uname))
		{
			$info = R::load("users", $this::unameToId($uname))
		}
	} 

	public static function userExists($uname)
	{
		$rowCount = R::exec("SELECT COUNT(*) FROM users WHERE username = :uname", [":uname"=>$uname]);
		$rowCount > 0 ? return true : return false;
	}

	public static function unameToId($uname)
	{
		if($this::userExists($uname))
		{
			$id = R::exec("SELECT id FROM users WHERE username = :uname", [":uname"=>$uname]);
			return $id
		} else {
			throw new Exception("User does not exist.");
		}
	}


}
?>