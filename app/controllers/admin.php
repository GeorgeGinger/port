<?php

class Admin extends Controller {

	public function index() {
	
		$User = $this->load_model("User");
		
		// prihlasit se muze pouze admin
		$user_data = $User->check_login(true,["admin"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}
		
		
		$data["page_title"] = "Admin";
		$this->view("admin/index", $data);
	}
	
	public function users($user_type = "customer") {
	
		$User = $this->load_model("User");
	
		User::$user_type = $user_type;
	
		$user_data = $User->check_login(true,["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["type_active"] = "users";
		$data["table_row"]   = $User->make_table();
		$data["page_title"]  = "Admin - ".$user_type;

		$this->view("admin/users", $data);
	}

	public function players($user_type = "player") {
	
		$user = $this->load_model("user");
		$players = $this->load_model("player_admin");

		Players::$user_type = $user_type;

		$user_data = $user->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["type_active"] = "players";
		$data["table_row"]   = $players->make_table();
		$data["page_title"]  = "Admin - ".$user_type;

		$this->view("admin/players", $data);
	}

	public function settings($type = "") {
		
		$User = $this->load_model("User");
		$settings = new Settings_global;
		
		$user_data = $User->check_login(true,["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		if(array_key_exists("save_social", $_POST)) {
			// show($_POST);
			foreach($_POST as $key => $value) {

				if(strstr($key, "_link")) {
					if(!strstr($value, "https://")) {
						$value = "https://".$value;
					}
				}

				$settings->update($key, ["setting_value" => $value], 'setting');
			}
			header("Location: ".ROOT."admin/settings/socials");
			die;
			
		}
		
		$data["table_row"]   = $settings->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - socials";
		$this->view("admin/socials", $data);
	}


	public function shop_menu($type = "") {
		
		$User 		= $this->load_model("User");
		$shop_menu  = $this->load_model("shop_menu");
		$styles		= $this->load_model("styles");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}
		

		$data["styles"] 	 = $styles->findAll();
		$data["table_rows"]  = $shop_menu->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - Shop_menu";

		// show($data);
		$this->view("admin/shop_menu", $data);
	}

	public function main_menu($type = "") {
		
		$User 		= $this->load_model("User");
		$main_menu  = $this->load_model("main_menu");
		$styles		= $this->load_model("styles");
		
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}
		

		$data["styles"] 	 = $styles->findAll();
		$data["table_rows"]  = $main_menu->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - main_menu";

		// show($data);
		$this->view("admin/main_menu", $data);
	}


	public function messages($type = "") {
		
		$User = $this->load_model("User");
		$messages = $this->load_model("messages");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}


		$messages = $messages->findAll();
		$table_setup = [
			'name' => 'name',
			'date' => 'date',
			'email' => 'email',
			'subject' => 'subject',
			'message' => 'message',
			'title_table' => "messages",
			// 'anchor' => [
			// 	"column_name" => "...",
			// 	"a_name" => "profile"
			// 	]
			];


		$data["table_rows"] = make_table($messages, $table_setup, "na_sirku");

		
		$data["type_active"] = "messages";
		$data["page_title"]  = "Admin - Messages";

		// show($data);
		$this->view("admin/messages", $data);
	}

	public function blogs() {
		
		$User  = $this->load_model("User");
		$blogs = $this->load_model("blogs");
		$image_class = $this->load_model("image");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["table_rows"] = $blogs->make_table();
		$data["type_active"] = "blogs";

		$data["page_title"] = "Admin - Blogs";
		$this->view("admin/blogs", $data);
	}

	public function dashboard() {
		$users = $this->load_model("user");
		$product = $this->load_model("product");
		$category = $this->load_model("category");
		$brands = $this->load_model("brands");
		$payments = $this->load_model("payments");
		$orders = $this->load_model("order");

		$user_data = $users->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$all_payments = $payments->findAll();
		$total_payment = $payments->total_payment();
		$number_of_orders = $orders->findAll();
		$number_of_customers = $users->where(["rank"=>"customer"]);

		// var_dump($number_of_orders);
		// var_dump(is_array($number_of_orders) ? $number_of_orders : []);

		$data["number_of_customers"] = count(is_array($number_of_customers) ? $number_of_customers : []);
		$data["number_of_orders"] = count(is_array($number_of_orders) ? $number_of_orders : []);
		$data["number_payments"] = count(is_array($all_payments) ? $all_payments : []);
		$data["total_payment"] = $total_payment ? $total_payment : 0;

		$data["page_title"] = "Admin - Dashboard";
		$this->view("admin/dashboard", $data);
	}
	
}

