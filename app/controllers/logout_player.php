<?php

class Logout_player extends Controller {

	public function index() {
	
		$players = $this->load_model("players");
		$players->logout();
	}
	
}
