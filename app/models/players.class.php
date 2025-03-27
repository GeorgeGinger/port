<?php

class Players
{

	use Model;
	protected $table = 'players';
	protected $allowedColumns = [
		'name',
		'password',
		'user_url',
		'player_url',
		'login_date',
		'death_date',
		'player_order',
		'disabled',
		'rank'
	];

	// protoze jsou v tabulce users vsechny typy uzivatelu
	static $user_type = "";

	private $error = "";

	public function validate($data) {

		$_SESSION["error"] = "";

		$data = (object) $data;

		if(!is_object($data)) {
			$_SESSION["error"] .= "user validate \$data must be a type of array or object";
			return;
		}
		
		if(isset($data->data_type) && $data->data_type == "change_status_player") {
			$arr["id"] = $data->data->id;
			$arr["disabled"] = $data->data->disabled;
			return $arr;
		}
		
		// show($data);

		$arr["name"] = trim($data->name);
		

		if(isset($data->rank)) {
			$arr["rank"] = trim($data->rank);
		}else {
			// prvni hrac ve hre bude admin
			$result = $this->where(["user_url"=>$_SESSION["user_url"]]);
			if(is_array($result)) {
				$arr["rank"] = "player";
			}else {
				$arr["rank"] = "admin";
			}
			
		}
		
		if(isset($data->data_type) && $data->data_type != "edit_row") {
			$arr["password"] = trim($data->password);
			$password2 = trim($data->password2);
		}

		if(isset($data->id)) {
			$arr["id"] = trim($data->id);
		}

		if (empty($arr["name"]) || !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["name"])) {

			$this->error .= "Please enter a valid name <br>";
		}

		if(isset($data->data_type) && $data->data_type != "edit_row") {

			if ($arr["password"] != $password2) {

				$this->error .= "Password do not match <br>";
			}

			if (strlen($arr["password"]) < 4) {

				$this->error .= "Password must be atleast 4 characters long <br>";
			}
		
			$arr["user_url"] = $_SESSION["user_url"];
			// check if email already exists
			$arr1["name"] = $arr["name"];
			$arr1["user_url"] = $arr["user_url"];
			$check = $this->where($arr1);

			if (is_array($check)) {
				$this->error .= "That name is already in use";
			}

			// check if player_url already exists pokud existuje vytvoříse jine a znova se zkontroluje

			$arr["player_url"] = $this->get_random_string_max(60);
		

			$loop_check = true;
			$arr2 = [];
			while ($loop_check) {
				$loop_check = false;

				$arr2["player_url"] = $arr["player_url"];

				$check = $this->where($arr2);

				if (is_array($check)) {
					$arr["player_url"] = $this->get_random_string_max(60);
					$loop_check = true;
				}
			}

		}

		$_SESSION["error"] = $this->error;

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function signup($data=[])
	{
			// save
			$valid_data = $this->validate($data);
			if($valid_data) {
				$valid_data["login_date"] = date("Y-m-d H:i:s");
				$valid_data["password"] = hash('sha1', $data["password"]);

				$result = $this->insert($valid_data);
				
				header("Location:" . ROOT . "login_player");
				die;
			}
	}

	public function edit($data) {

		$valid_data = $this->validate($data);
		Players::$user_type = $this->getOne(["id"=>$valid_data["id"]])->rank;
		$check["update"] =$this->update($valid_data["id"], $valid_data);
	}

	public function delete($id, $id_column = 'id') {

		// User::$user_type = $this->getOne([$id_column=>$id])->rank;
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function getOne($data) {
		return $this->first($data);
	}

	public function make_table($table_setup = [
		'title_table' => "players",
		'name' => "name",
			'login_date' => 'date',
			'death_date' => 'death_date',
			'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled",
					"bt_title_dis" => "killed",
					"bt_title_en" => "lived",
					"type" => "button",
				],
			],
		'action_1' => [
			"column_name" => "action",
			"type"=> [
				"edit",
				"delete",
			]
		]
		]) {
			
			$this->order_column = "player_order";

			$user_type = Players::$user_type;

			$rows = [];
			$rows = $this->where(["user_url" => $_SESSION["user_url"], "rank" => $user_type]);
			$table_string = make_table($rows, $table_setup);

		
		return $table_string;

	}

	private function get_random_string_max($length)
	{
		$array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$text = "";

		$length = rand(4, $length);

		for ($i = 0; $i < $length; $i++) {
			$random = rand(0, count($array) - 1);
			$text .= $array[$random];
		}

		return $text;
	}

	public function login($POST)
	{
		$data = array();

		// $db = Database::newInstance();

		$data["name"] = trim($POST["name"]);
		$data["password"] = trim($POST["password"]);
		

		if (empty($data["name"])) {
			$this->error .= "Please enter a valid name <br>";
		}

		if (strlen($data["password"]) < 4) {

			$this->error .= "Password must be atleast 4 characters long <br>";
		}

		if ($this->error == "") {
			// confirm

			$data["password"] = hash('sha1', $data["password"]);
			$data["user_url"] = $_SESSION["user_url"];

			//check if email already exists
			$result = $this->where($data);
// show($data);
			if (is_array($result)) {

				$_SESSION["player_url"] = $result[0]->player_url;
				if(isset($_SESSION["intended_url"])) {

					// presmerovani na misto odkud jsem prisel
					$url = $_SESSION["intended_url"];
					unset($_SESSION["intended_url"]);
					// show($url);

					header("Location: " .$url);
					die;
				} else {
					header("Location:" . ROOT . "game");
					die;
				}
				
			}

			$this->error .= "Wrong email or password <br>"; 
		}

		$_SESSION["error"] = $this->error;
	}

	public function check_login($redirect = false, $allowed = []) {
		if(isset($_SESSION["player_url"])) {
			$arr["player_url"] = $_SESSION["player_url"];
		
			$result = $this->where($arr);

			if(is_array($result)) {
				if(count($allowed) > 0){
					
					if(in_array($result[0]->rank, $allowed)){
						return $result[0];
					}

				} else {

					return $result[0];
				}
			}

		}

		if($redirect) {
			// show(FULL_URL.str_replace("url=", "", $_SERVER["QUERY_STRING"]));
			// pokud jsem se chtel dostat nekam kde musim byt prihlaseny ale nejsem budu presmerovan na login a ulozi se url ze ktere jsem prisel
			// abych se po rihlaseni mohl vratit na puvodni misto intended_url
		
			// $_SESSION["intended_url"] = FULL_URL.str_replace("url=", "", $_SERVER["QUERY_STRING"]);
			$_SESSION["intended_url"] = FULL_URL;
			// $_SESSION["intended_url"] = str_replace("url=", "", $_SERVER["QUERY_STRING"]);
			header("location: " .ROOT. "login_player");
			die;
		}

		return false;
	}

	public function logout() {

		if(isset($_SESSION["player_url"])) {
			unset($_SESSION["player_url"]);

			header("Location:" . ROOT . "Home");
			die;
		}
	}
}