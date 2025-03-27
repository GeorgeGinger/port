<?php

class Rules extends Controller {

	protected $class_name = "Rules";

	public function index() {


		$User = $this->load_model("User");
		$players = $this->load_model("players");

		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$palyer_data = $players->check_login();
		if(is_object($palyer_data)) {
			$data["player_data"] = $palyer_data;
		}



		$data["page_title"] = "Rules";

		$this->view("rules", $data);
	}

}
