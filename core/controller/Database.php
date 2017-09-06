<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="meow";$this->pass="Nn9k56l3Q!~X";$this->host="mysql5.gear.host";$this->ddbb="meow";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
