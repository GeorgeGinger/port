<?php

class Sklad
{
	use Model;
	
	public $table = 'sklad';

	protected $allowedColumns = [
		'cenaNakup',
		'dph_sklad',
		'skladem',
		'product_id',
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce validate footer_menu \$data must be a type of object, model Footer_menu";
			return;
		}

		$arr["cenaNakup"] = $data->cenaNakup;
		$arr["dph_sklad"] = $data->dph_sklad;
		$arr["skladem"] = $data->skladem;
		// $arr["pocet_prodejnych_kusu"] = $data->pocet_prodejnych_kusu;
		$arr["id"] = $data->id;
		

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function edit($data) {
		show($data);
		$check["update"] =$this->update($data["id"], $data, "id");
	}

	public function delete($id, $id_column = 'id') {
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		// show($data);
		$this->insert($data);
	}

	// vyhleda produkty podle zadanych parametru
	public function advance_search() {

		$limit = 20;
		$offset = Page::get_offset($limit);
		$this->limit = $limit;
		$this->offset = $offset;

		$params = [];

		if(isset($_GET["category"]) && trim($_GET["category"]) != "") {
				$category = trim($_GET["category"]);
				$prodInCat = $this->query("SELECT * FROM product_category WHERE category_id=:category_id",["category_id" => $category]);
			
				foreach($prodInCat as $value) {
					$prodInCat_id[] = $value->product_id; 
				}
			}

		if(isset($_GET["find"])) {
			$find = addslashes($_GET["find"]);
			return $this->every_where(["description" =>"%".$find."%"]);
		}

		if(isset($_GET["search_submit"])) {

			// show($_GET);

			if(isset($_GET["description"]) && trim($_GET["description"]) != "") {
			$params["description"] = "%".trim($_GET["description"])."%";
			}

			if(isset($_GET["year"]) && $_GET["year"] != "--Any Year--") {
				$params["year"]	= trim($_GET["year"]);
			}

			if(isset($_GET["min_quantity"]) && isset($_GET["max_quantity"]) && $_GET["min_quantity"] < $_GET["max_quantity"]){
				$params["min_quantity"] = (int)trim($_GET["min_quantity"]);
				$params["max_quantity"]	= (int)trim($_GET["max_quantity"]);

			}

			if(isset($_GET["min_price"]) && isset($_GET["max_price"]) && $_GET["min_price"] < $_GET["max_price"]){
				$params["min_price"] = (int)trim($_GET["min_price"]);
				$params["max_price"] = (int)trim($_GET["max_price"]);

			}

			if(isset($_GET["brand"]) && is_array($_GET["brand"])) {
				$brand = $_GET["brand"];
			}
			
		}
		
		$query = "SELECT * FROM products";

		if(count($params) > 0 || isset($brand)) {
			$query .= " WHERE";
		}

		if(isset($params["description"])) {

			$query .= " description LIKE :description AND";
		}

		if(isset($prodInCat_id)) {

			$query .= " WHERE id IN ('".implode("','",$prodInCat_id)."') AND";
			
		}

		if(isset($params["year"])) {
			
			$query .= " YEAR (date) = :year AND";
		}

		if(isset($params["min_quantity"]) && isset($params["max_quantity"])) {
			
			$query .= " quantity BETWEEN :min_quantity AND :max_quantity AND";
		}

		if(isset($params["min_price"]) && isset($params["max_price"])) {
			
			$query .= " price BETWEEN :min_price AND :max_price AND";
		}

		if(isset($brand)) {
			
				$query .= " brand IN ('".implode("','",$brand)."') AND";
			
		}

		$query = trim($query);
		$query = trim($query,"AND");
		$query = trim($query);

		$query .= " ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
		
		// show($query);
		// show($params);
		

		return $this->query($query, $params);
	}

	public function make_table($table_setup = [
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
		'brand' => "brand",
		'all_cat' => "category",
		'add_new' => "",
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
		]) {

		$rows = $this->findAll();
		$rows = $this->query("SELECT * FROM $this->table  ORDER BY id ASC");

		if(is_array($rows)) {
			foreach($rows as $key=>$row) {
				$product = $this->query("SELECT description, brand, image FROM products WHERE id=:id",["id" => $row->product_id]);
				$rows[$key]->description = $product[0]->description;
				$rows[$key]->image = $product[0]->image;
				
				$rows[$key]->brand =$this->query("SELECT brand FROM brands WHERE id=:id",["id" => $product[0]->brand])[0]->brand;

				$categories = $this->query("SELECT category_id FROM product_category WHERE product_id=:product_id",["product_id" => $row->product_id]);

				if(is_array($categories)) {
					foreach($categories as $category) {
						$rows[$key]->all_cat[] = $this->query("SELECT category FROM categories WHERE id=:id",["id" => $category->category_id])[0]->category;
					}
				}
				
			}
			// show($rows);
		}
		
		return make_table($rows, $table_setup);
	}

}