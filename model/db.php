<?php


class DB {
	const IP = "127.0.0.1:3306";
	const USERNAME = "mysql";
	const PASSWORD = "mysql";
	const DBNAME = "test-artjoker";
	public $mysqli;
	function __construct() { //Вызывается при создании объекта класса.
		$this->mysqli = new mysqli(self::IP, self::USERNAME, self::PASSWORD, self::DBNAME);
		if ($this->mysqli->connect_errno) {
			exit("Не удалось подключиться к MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error);
		}
	}
}
?>