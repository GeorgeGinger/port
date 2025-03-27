<?php

class Admin_player extends Controller {

	public function index() {
	
		$users = $this->load_model("user");
		$players = $this->load_model("players");
		
		// prihlasit se muze pouze admin_player
		$user_data = $users->check_login(true);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;

			// prihlasit se muze pouze admin_player
			$player_data = $players->check_login(true, ["admin"]);
			if(is_object($player_data)) {
				$data["player_data"] = $player_data;
			}
		}
		
		
		
		$data["page_title"] = "Admin";
		$this->view("admin_player/index", $data);
	}

	public function players($user_type = "player") {
	
		$users = $this->load_model("user");
		$players = $this->load_model("players");

		Players::$user_type = $user_type;

		// prihlasit se muze pouze admin_player
		$user_data = $users->check_login(true);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;

			// prihlasit se muze pouze admin_player
			$player_data = $players->check_login(true, ["admin"]);
			if(is_object($player_data)) {
				$data["player_data"] = $player_data;
			}
		}
		
		$data["type_active"] = "players";
		$data["table_row"]   = $players->make_table();
		$data["page_title"]  = "Admin - ".$user_type;

		$this->view("admin_player/players", $data);
	}
}

