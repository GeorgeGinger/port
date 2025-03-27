<?php

class Game_core
{

	use Model;
	protected $table = 'players';
	// protoze jsou v tabulce users vsechny typy uzivatelu
	static $user_type;

	private $error = "";

	public function validate($data) {

		$_SESSION["error"] = "";

		$data = (object) $data;

		$arr = [];

		if(!is_object($data)) {
			$_SESSION["error"] .= "user validate \$data must be a type of array or object";
			return;
		}
		
		if(isset($data->data_type) && $data->data_type == "change_status_player") {
			$arr["id"] = $data->data->id;
			$arr["disabled"] = $data->data->disabled;
			$arr["death_date"] = date("Y-m-d H:i:s");
		
			return $arr;
		}

		$_SESSION["error"] = $this->error;

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function edit($data) {

		$valid_data = $this->validate($data);
		// $valid_data = $this->validate($data);
		// Players::$user_type = $this->getOne(["id"=>$valid_data["id"]])->rank;
		$check["update"] =$this->update($valid_data["id"], $valid_data);
	}

	public function toKill($data) {

		$valid_data = $this->validate($data);

		$player_id = $this->first(["player_url" => $_SESSION["player_url"]])->id;

		// show($id_killer);
		// show($valid_data);

		$this->addScore($player_id);
		
	
		$check["update"] = $this->update($valid_data["id"], $valid_data);
	}

	function addScore($player_id) {
		$score = $this->query("SELECT * FROM score WHERE player_id=:player_id", ["player_id" => $player_id]);
	

		if(is_array($score)){

			$score[0]->score ++;
			$this->query("UPDATE score SET score.score=:score WHERE player_id=:player_id", ["player_id" => $player_id, "score" => $score[0]->score]);
		}else {
			$this->query("INSERT INTO score (score, player_id) VALUES (:score, :player_id)", ["score" => 1, "player_id" => $player_id]);
		}
	}

	function zamichat() {
		// zamíchá poradi hracu a restartuje hru
		$this->resetGame();

		$order = [];
		$players = $this->where(["user_url" => $_SESSION["user_url"]]);
		if(is_array($players)) {
			foreach($players as $key=>$value) {
				$order[] = $key;
			}

			shuffle($order);
			foreach($players as $key=>$value) {
				$this->update($value->name, ["player_order"=>$order[$key]], "name");
			}
		}
	}

	function resetGame() {

		$this->deleteScore();

		$players = $this->where(["user_url" => $_SESSION["user_url"]]);

		foreach($players as $key=>$value) {
			$arr["disabled"] = 1;
			$arr["login_date"] = date("Y-m-d H:i:s");
			$arr["death_date"] = null;
			$this->update($value->player_url, $arr, "player_url");
		}
	}
	
	function deleteScore() {
		// delete score of all players after click on zamichat
		$players = $this->where(["user_url" => $_SESSION["user_url"]]);
		
		foreach($players as $key=>$value) {
			$this->query("DELETE FROM score WHERE player_id=:player_id", ["player_id" => $value->id]);
		}
	}

	function get_victim() {
		// fce preda object s udaji o obeti nactene z databaze
		// nascteni hracu dane hry
		if(!array_key_exists("player_url", $_SESSION)) {
			return false;
		}

		// nalezne vsechny zive hrace
		$killer = $this->query("SELECT * FROM players WHERE user_url=:user_url AND player_url=:player_url AND disabled=1", ["user_url" => $_SESSION["user_url"], "player_url" => $_SESSION["player_url"]]);

		if(is_array($killer)) {
			$players = $this->query("SELECT * FROM players WHERE user_url=:user_url AND disabled=1 ORDER BY player_order", ["user_url" => $_SESSION["user_url"]]);

			// z nasledujiciho po prihlasenem udela obet 
			if(is_array($players)) {
				foreach($players as $key=>$value) {
					if($value->player_url == $_SESSION["player_url"]) {
						$victimKey = $key + 1;
						if($victimKey >= count($players)) {
							$victimKey = 0;
						}
					}
				}

			return $players[$victimKey];
		}
		}
	
		
		return false;
	}

	public function make_table($table_setup = [
		'title_table' => "killer",
		'name' => 'name',
		'score' => 'Your score'
		]) {


			if(!isset($_SESSION["user_url"]) || !isset($_SESSION["player_url"])) {
				return '<h2 style="text-align: center">Who are you?</h2>';
			} 
			

		$limit = 20;
		$offset = Page::get_offset($limit);
		$this->limit = $limit;
		$this->offset = $offset;

		$this->order_column = "player_order";
		
		$rows = $this->where(["user_url" => $_SESSION["user_url"], "player_url"=> $_SESSION["player_url"]]);
		if(is_array($rows)) {
			if($rows[0]->disabled != 1) {
				$table_setup = [
					'title_table' => "you are death",
					'name' => 'Name',
					'score' => "Your score",
					'death' => "Death order" 
				];
				
			//nacte vsechny hrače danné hry
			$this->order_type = "asc";
			$this->order_column = "death_date";
				$players = $this->where(["user_url" => $_SESSION["user_url"]],["death_date" => ""]);
				foreach($players as $key => $player) {
					if($player->player_url == $_SESSION["player_url"]) {
						$rows[0]->death = $key+1;
					}
				} 

			}else if($rows[0]->player_url == $this->get_victim()->player_url) {
				$table_setup = [
					'title_table' => "you are win",
					'name' => 'Name',
					'score' => "Your score",
				];
	
			}
		$score = $this->query("SELECT score FROM score WHERE player_id=:player_id", ["player_id" => $rows[0]->id]);
				if(is_array($score)) {
					$rows[0]->score = $score[0]->score;
				}else {
					$rows[0]->score = 0;
				}
				
			
		}

		$table_string = make_table($rows, $table_setup);
	
		// table vitim
		$table_setup = [
			'title_table' => "victim",
			'name' => 'name',
			'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled",
					"bt_title_dis" => "killed",
					"bt_title_en" => "to kill",
					"type" => "button"
				],
			],
		];

		$this->order_type = "asc";
		$this->order_column = "player_order";
		
		$rows = [];

		if($this->get_victim()) {
			$rows[] = $this->get_victim();
			$table_string .= make_table($rows, $table_setup);
		}

		// table of all players

		$table_setup = [
			'title_table' => "players",
			'login_date' => 'date',
			'live_time' => 'live_time',
			'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled",
					"bt_title_dis" => "killed",
					"bt_title_en" => "lived",
				],
			],
		];
			
		$this->order_type = "asc";
		$this->order_column = "player_order";

		$rows = [];
		$rows = $this->where(["user_url" => $_SESSION["user_url"]]);
		foreach($rows as $key=>$value) {
			if($value->disabled == 0) {
				$login_date = new DateTime($value->login_date);
				$death_date = new DateTime($value->death_date);
				$interval = $death_date->diff($login_date);
				$rows[$key]->live_time = $interval->format("%d days, %H:%I:%S");
			}else {
				$login_date = new DateTime($value->login_date);
				$death_date = new DateTime();
				$interval = $death_date->diff($login_date);
				$rows[$key]->live_time = $interval->format("%d days, %H:%I:%S");
			}
			
		}
		
			$table_string .= make_table($rows, $table_setup);

		
		return $table_string;

	}
}