<?php

class Home extends Controller {

	protected $class_name = "Home";

	public function index() {

		$User 				 = $this->load_model("User");
		$players = $this->load_model('players');
		$players_list = $this->load_model('players_list');
		$game = new Game_core;

		// kontrola pripojeneho uzivatele
		$user_data = $User->check_login();
		
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
			$data["players_list_tab"] = $players_list->make_table();
		}

		// if(array_key_exists("player_name", $_COOKIE)) {
		// 	$_SESSION["player_name"] = $_COOKIE["player_name"];
		// }

		$player_data = $players->check_login();
		if(is_object($player_data)) {
			$data["player_data"] = $player_data;
			$data['table_row'] = $game->make_table();
		}

		
		
		// $data["show_search"] = true;

		$data["page_title"] = "Home";
		$this->view("index", $data);
	}
}

