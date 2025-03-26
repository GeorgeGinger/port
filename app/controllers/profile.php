<?php

class Profile extends Controller {

	public function index($user_url = null) {
	
		$User = $this->load_model("User");
		$orders = $this->load_model("order");

		$user_data = $User->check_login(true);

		if($user_url != null) {
			$profile_data = $User->get_user($user_url);

			if(is_object($profile_data)) {
				$data["profile_data"] = $profile_data;
			}else {
				$data["profile_data"] = null;
			}

		}else if(is_object($user_data)) {
			$data["profile_data"] = $user_data;
		}

		// show($user_url);
		// show($data["profile_data"]);
		// show($user_data);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

			if(isset($data["profile_data"]) && is_object($data["profile_data"])) {
				
				$query = "SELECT *, orders.id AS id_order FROM orders WHERE user_url=:user_url";
				$rows = $orders->query($query, ["user_url" => $data["profile_data"]->user_url]);
			}else if($user_url == null){
				$query = "SELECT *, orders.id AS id_order FROM orders WHERE sessionid=:sessionid";
				$rows = $orders->query($query, ["sessionid" => session_id()]);
			}else {
				$rows = null;
			}

		//volba sloupu ve vygenerovane tabulce klice jsem stejne jako klice v $rows hodnoty jsou nadpisy sloupcu v tabulce 
		$table_setup = [
			'id_order' => 'order no.',
			'date' => 'date',
			'total' => 'total',
			'street' => 'steet',
			'city' => 'city',
			'country' => 'country',
			// 'zip' => 'zip',
			// 'tax' => 'tax',
			'status' => 'status',
			
			];


		$data["table_row"] = $orders->make_table($rows, $table_setup);


		$data["page_title"] = "Profile";
		$this->view("profile", $data);
	}
	
}
