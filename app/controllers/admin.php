<?php

class Admin extends Controller {

	public function index() {
	
		$User = $this->load_model("User");
		
		// prihlasit se muze pouze admin
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["messages"] = $this->messages_info();
		
		$data["page_title"] = "Admin";
		$this->view("admin/index", $data);
	}
	
	protected function messages_info() {
		$messages = $this->load_model("messages");

		$result = $messages->query("SELECT * FROM messages ORDER BY date desc LIMIT 5");
		// $result = $messages->findAll();

		if(is_array($result) && count($result) > 0) {
			return $result;
		}

		return false;
	}

	public function categories() {
	
		$User	  = $this->load_model("User");
		$category = $this->load_model("category");

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "categories";
		$data["categories"]  = $category->findAll();
		$data["table_rows"]  = $category->make_table();
		$data["page_title"]  = "Admin";

		$this->view("admin/categories", $data);
	}

	public function brands() {
	
		$User 	= $this->load_model("User");
		$brands = $this->load_model("brands");

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "brands";
		$data["table_rows"]  = $brands->make_table();
		$data["page_title"]	 = "Admin";

		$this->view("admin/brands", $data);
	}
	
	public function products() {
		
		$User 		= $this->load_model("User");
		$product 	= $this->load_model("product");
		$category	= $this->load_model("category");
		$brands 	= $this->load_model("brands");

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "products";
		$data["show_search"] = true;
		$data["table_rows"]  = $product->make_table();
		$data["categories"]  = $category->findAll();
		$data["brands"]		 = $brands->findAll();
		$data["page_title"]  = "Product";

		$this->view("admin/products", $data);
	}


	public function naskladnit($id) {

		$User 		= $this->load_model("User");
		$sklad 		= $this->load_model("sklad");
		$products 	= $this->load_model("product");
		$product_category	= $this->load_model("product_category");
		$categories	= $this->load_model("category");
		$brands 	= $this->load_model("brands");

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$product = $products->first(["id"=>$id]);
		$data["product"] = $product;

		foreach($product as $key=>$value) {
			$_GET[$key] = $value;
		}

		// show($_GET);

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "sklad";
		$data["show_search"] = true;
		$data["table_rows"]  = $sklad->make_table();

		// nalezeni jmen kategorii pro dane id productu
		$product_category_arr = $product_category->getAll(["product_id"=>$id]);
		foreach($product_category_arr as $value) {
			$data["categories"][] = $categories->first(["id"=>$value->category_id])->category;
		}
		
		$data["brand"] = $brands->first(["id"=>$product->brand]);

		// show($data["brand"]);
		
		$data["page_title"]  = "Sklad";

		$this->view("admin/sklad", $data);
	}

	public function doProdeje($id) {

		$User 		= $this->load_model("User");
		$sklad 		= $this->load_model("sklad");
		$products 	= $this->load_model("product");
		$product_prodej 	= $this->load_model("product_prodej");
		$product_category	= $this->load_model("product_category");
		$categories	= $this->load_model("category");
		$brands 	= $this->load_model("brands");

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$product_skladem = $sklad->first(["id"=>$id]);
		$data["product_skladem"] = $product_skladem;
		
		$product = $products->first(["id"=>$product_skladem->product_id]);
		$data["product"] = $product;

		foreach($product as $key=>$value) {
			$_GET[$key] = $value;
		}

		// show($_GET);

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "product_prodej";
		$data["show_search"] = true;
		$data["table_rows"]  = $product_prodej->make_table();

		// nalezeni jmen kategorii pro dane id productu
		$product_category_arr = $product_category->getAll(["product_id"=>$product_skladem->product_id]);
		foreach($product_category_arr as $value) {
			$data["categories"][] = $categories->first(["id"=>$value->category_id])->category;
		}
		
		$data["brand"] = $brands->first(["id"=>$product->brand]);

		// show($data["brand"]);
		
		$data["page_title"]  = "product_prodej";

		$this->view("admin/product_prodej", $data);
	}

	public function sklad() {
		
		$User 		= $this->load_model("User");
		$sklad 		= $this->load_model("sklad");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$table_setup = [
			'anchor_1' => [
				"column_name" => "do prodeje",
				// "a_name" => "description",
				"a_name_dyn" => "description",
				"target" => "",
				"url_0" => ROOT,
				"url_1" => "admin/",
				"url_2" => "doProdeje/",
				"url_3" => "id"
			],
			'title_table' => "Sklad",
			// 'add_new' => "",
			'brand' => "brand",
			'all_cat' => "category",
			"cenaNakup" => "cenaNakup",
			'dph_sklad' => 'dph_sklad',
			'skladem' => 'skladem',
			"image" => [
				'image',
			],
			'action_1' => [
				"column_name" => "action",
				"type"=> [
					"edit",
					"delete",
					]
				],
			];

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "sklad";
		$data["show_search"] = true;
		$data["table_rows"]  = $sklad->make_table($table_setup);
		$data["page_title"]  = "Sklad";

		$this->view("admin/sklad", $data);
	}

	public function product_prodej() {
		
		$User 			= $this->load_model("User");
		$product_prodej = $this->load_model("product_prodej");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$table_setup = [
			'title_table' => "Sklad",
			'description' => "Description",
			'brand' => "brand",
			'all_cat' => "category",
			"cenaNakup" => "Cena_Nakup",
			"cenaProdej" => "Cena_Prodej",
			'dph_prodej' => 'dph_prodej',
			'skladem' => 'skladem',
			'pocet_prodejnych_kusu' => 'pocet_prodejnych_kusu',
			"image" => [
				'image',
				],
			'action_1' => [
				"column_name" => "action",
				"type"=> [
					"edit",
					"delete",
					]
				],
			];

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "product_prodej";
		$data["show_search"] = true;
		$data["table_rows"]  = $product_prodej->make_table($table_setup);
		$data["page_title"]  = "Product_prodej";

		$this->view("admin/product_prodej", $data);
	}

	public function orders() {
		
		$User = $this->load_model("User");
		$orders = $this->load_model("order");

		// pagination
		$limit = 20;
		$offset = Page::get_offset($limit);
		$limit = $limit;
		$offset = $offset;


		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		if(isset($_SESSION["user_url"])) {
			
			$query = "SELECT *, country, city, orders.id AS id_order FROM orders JOIN users ON users.user_url=orders.user_url LIMIT $limit OFFSET $offset" ;
			$rows = $orders->query($query);
			
		}else {

			$query = "SELECT *, country, city, orders.id AS id_order FROM orders JOIN users ON users.user_url=orders.user_url LIMIT $limit OFFSET $offset";
			$rows = $orders->query($query);
		}

	//volba sloupcu ve vygenerovane tabulce klice jsem stejne jako klice v $rows hodnoty jsou nadpisy sloupcu v tabulce 
	$table_setup = [
		'title_table' => "Orders",
		'id_order' => 'order no.',
		'date' => 'date',
		'total' => 'total',
		'name' => 'name',
		'street' => 'street',
		'city' => 'city',
		'country' => 'country',
		'zip' => 'zip',
		'tax' => 'tax',
		'status'=>'status',
		'anchor' => [
			"column_name" => "...",
			"a_name" => "profile",
		],
		];

		// problem protoze tu je tabulka v tabulce
	// $table_setup = [
	// 	'title_table' => "Orders",
	// 	'id_order' => 'order no.',
	// 	'date' => 'date',
	// 	'total' => 'total',
	// 	'name' => 'name',
	// 	'delivery_adress' => 'delivery_adress',
	// 	'city_name' => 'city',
	// 	'country_name' => 'country',
	// 	'zip' => 'zip',
	// 	'tax' => 'tax',
	// 	'status'=>'status',
	// 	'anchor_1' => [
	// 		"column_name" => "...",
	// 		"a_name" => "profile",
	// 		"url_0" => ROOT,
	// 		"url_1" => "profile/",
	// 		"url_2" => "",
	// 		"url_3" => ""
	// 	],
	// 	];

		$data["messages"] 	 = $this->messages_info();
		$data["table_rows"]  = $orders->make_table($rows, $table_setup);
		$data["type_active"] = "orders";
		$data["page_title"]  = "Admin - products";
		$this->view("admin/orders", $data);
	}

	public function users($user_type = "customer") {
	
		$User = $this->load_model("User");
	
		User::$user_type = $user_type;

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["messages"] 	 = $this->messages_info();
		$data["type_active"] = "users";
		$data["table_row"]   = $User->make_table();
		$data["page_title"]  = "Admin - ".$user_type;

		$this->view("admin/users", $data);
	}

	public function settings($type = "") {
		
		$User = $this->load_model("User");
		$settings = new Settings_global;
		
		$user_data = $User->check_login(true, ["admin"]);

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
		
		$data["messages"] 	 = $this->messages_info();
		$data["table_row"]   = $settings->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - socials";
		$this->view("admin/socials", $data);
	}

	public function slider_add($type = "") {
		
		$User = $this->load_model("User");
		$sliders = $this->load_model("sliders");
		
		// kontrola prihlaseneho uzivatele
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		if(array_key_exists("save_sliders", $_POST)) {
			// show($_POST);
			foreach($_POST as $key => $value) {

				$sliders->update($key, ["setting_value" => $value], 'setting');
			}
			header("Location: ".ROOT."admin/settings/socials");
			die;
			
		}
		
		$data["messages"] 	 = $this->messages_info();
		$data["table_rows"]  = $sliders->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - Slider";

		// show($data);
		$this->view("admin/sliders", $data);
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
		$data["messages"]    = $this->messages_info();
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
		$data["messages"]    = $this->messages_info();
		$data["table_rows"]  = $main_menu->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - main_menu";

		// show($data);
		$this->view("admin/main_menu", $data);
	}

	public function footer_menu($type = "") {
		
		$User 		 = $this->load_model("User");
		$footer_menu = $this->load_model("footer_menu");
		$styles		 = $this->load_model("styles");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}
		

		$data["styles"]   	 = $styles->findAll();
		$data["messages"] 	 = $this->messages_info();
		$data["table_rows"]  = $footer_menu->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - footer_menu";

		// show($data);
		$this->view("admin/footer_menu", $data);
	}

	public function sauna_text($type = "") {
		
		$User 		 = $this->load_model("User");
		$sauna_text = $this->load_model("sauna_text");
		$styles		 = $this->load_model("styles");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}
		

		$data["styles"]   	 = $styles->findAll();
		$data["messages"] 	 = $this->messages_info();
		$data["table_rows"]  = $sauna_text->make_table();
		$data["type_active"] = "settings";
		$data["page_title"]  = "Admin - sauna_text";

		// show($data);
		$this->view("admin/sauna_text", $data);
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


		$data["messages"] 	= $this->messages_info();
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

		$data["messages"] = $this->messages_info();
		$data["table_rows"] = $blogs->make_table();
		$data["type_active"] = "blogs";

		$data["page_title"] = "Admin - Blogs";
		$this->view("admin/blogs", $data);
	}

	public function vzkazy() {
		
		$User  = $this->load_model("User");
		$vzkazy = $this->load_model("vzkazy");
		$image_class = $this->load_model("image");
		
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["last_vzkaz"] = ((int) $vzkazy->lastOne()+1);
		$data["messages"] = $this->messages_info();
		$data["table_rows"] = $vzkazy->make_table();
		$data["type_active"] = "vzkazy";

		$data["page_title"] = "Admin - vzkazy";
		$this->view("admin/vzkazy", $data);
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

		$data["messages"] = $this->messages_info();
		$data["number_of_customers"] = count(is_array($number_of_customers) ? $number_of_customers : []);
		$data["number_of_orders"] = count(is_array($number_of_orders) ? $number_of_orders : []);
		$data["number_payments"] = count(is_array($all_payments) ? $all_payments : []);
		$data["total_payment"] = $total_payment ? $total_payment : 0;

		$data["page_title"] = "Admin - Dashboard";
		$this->view("admin/dashboard", $data);
	}
	
}

