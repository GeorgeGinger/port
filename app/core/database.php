<?php

trait Database {

	public static $con;

	private function connect()
	{
		// jeste nezadame nazev databaze protoze ho nezname
		$string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME. ";charset=utf8mb4";
		$con = new PDO($string, DBUSER, DBPASS);
		return $con;
	}

	public static function newInstance() {	

		return new self();
	}

	public function query($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
		$check = $stm->execute($data);
		if ($check) {
			$result = $stm->fetchALL(PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				return $result;
			}
			return true;
		}

		return false;

	}

	public function get_row($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
		$check = $stm->execute($data);
		if ($check) {
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				return $result[0];
			}
		}

		return false;

	}
}
