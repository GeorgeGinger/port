<?php

class Login extends Controller {

	public function index() {

	
		$data["page_title"] = "Login";

		$user = $this->load_model("user");
		
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$user->login($_POST);
		}else {
			
			$user_data = $user->check_login();

			if(is_object($user_data)) {
				$data["user_data"] = $user_data;
			}
		}

		$this->view("login", $data);
	}
	
}
