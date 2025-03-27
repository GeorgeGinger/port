<?php

class Signup_player extends Controller {

	public function index() {
		
		
		$data["page_title"] = "Signup Player";

		$user = $this->load_model("user");
		$user_data = $user->check_login(true);

			if(is_object($user_data)) {
				$data["user_data"] = $user_data;
			}

		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$players = $this->load_model("players");
			$POST = $_POST;
			$POST["data_type"] = "add_row";
			$players->signup($POST);

		}
		$this->view("signup_player", $data);
	}
	
}
