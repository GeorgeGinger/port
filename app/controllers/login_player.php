<?php

class Login_player extends Controller {

	public function index() {
	
		$data["page_title"] = "Login Player";

		$players = $this->load_model("players");
		$user = $this->load_model("user");

		$user_data = $user->check_login(true);
		
			if(is_object($user_data)) {
				$data["user_data"] = $user_data;
			}

		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$players->login($_POST);
		}else {

			$player_data = $players->check_login();

			if(is_object($player_data)) {
				$data["player_data"] = $player_data;
			}
		}


		$this->view("login_player", $data);
	}
	
}
