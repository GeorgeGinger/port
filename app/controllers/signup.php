<?php

class Signup extends Controller {

	public function index() {
		
		
		$data["page_title"] = "Signup";


		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$user = $this->load_model("user");
			$POST = $_POST;
			$POST["data_type"] = "add_row";
			$user->signup($POST);
		}
		$this->view("signup", $data);
	}
	
}
