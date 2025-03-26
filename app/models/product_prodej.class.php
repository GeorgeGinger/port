<?php

class Product_prodej
{
	use Model;
	
	public $table = 'products RIGHT JOIN sklad ON products.id=product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad';

	protected $allowedColumns = [
		'cenaProdej',
		'dph_prodej',
		'sklad_id_sklad',
	];
	
	public function validate($data) {

		// var_dump($data);
		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce validate footer_menu \$data must be a type of object, model Footer_menu";
			return;
		}

		$arr["cenaProdej"] = $data->cenaProdej;
		$arr["dph_prodej"] = $data->dph_prodej;
		$arr["sklad_id_sklad"] = $data->sklad_id_sklad;
		$arr["id"] = $data->id;
		
		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function getOne($data) {
		// show($data);
		return $this->query("SELECT *, products.id AS id, sklad.id AS id_sklad, product_prodej.id AS id_product_prodej FROM $this->table WHERE products.id=:id", $data)[0];
	}

	public function edit($data) {
		// $data["product.id"] = $data["id"];
		unset($data["sklad_id_sklad"]);
		// show($data);
		$this->table = "product_prodej";
		$check["update"] =$this->update($data["id"], $data, "id");
	}

	public function delete($id, $id_column = 'id') {
		$this->table = "product_prodej";
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		$this->table = "product_prodej";
		$this->insert($data);
	}

	public function every_where($data, $data_not = [])
	{
		$this->order_column = "products.id";

		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		// $query = "SELECT * FROM $this->table WHERE ";
		$query = "SELECT *, products.id AS id, sklad.id AS id_sklad, product_prodej.id AS id_product_prodej FROM products RIGHT JOIN sklad ON products.id=product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad WHERE ";

		foreach ($keys as $key) {
			$query .= $key . " LIKE :" . $key . " && ";
		}
		foreach ($keys_not as $key) {
			$query .= $key . " != : " . $key . " && ";
		}

		//odriznuti koncoveho &&
		$query = trim($query, " && ");

		//:id znamena ze id je promenna za kterou se doplni data v execute
		$query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
		// show($query);
		//spojeni obou poli
		$data = array_merge($data, $data_not);

		return $this->query($query, $data);
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
		
		$query = "SELECT *, products.id AS id, sklad.id AS id_sklad, product_prodej.id AS id_product_prodej FROM $this->table";

		// if(count($params) > 0 || isset($brand)) {
			// show($params);
		// 	$query .= " WHERE";
		// }

		// show($params);

		if(isset($prodInCat_id)) {

			$query .= " WHERE products.id IN ('".implode("','",$prodInCat_id)."') AND";
			
		}elseif(count($params) > 0) {
			$query .= " WHERE";
		}

		if(isset($params["description"])) {

			$query .= " description LIKE :description AND";
		}

		if(isset($params["year"])) {
			
			$query .= " YEAR (date) = :year AND";
		}

		if(isset($params["min_quantity"]) && isset($params["max_quantity"])) {
			
			$query .= " pocet_prodejnych_kusu BETWEEN :min_quantity AND :max_quantity AND";
		}

		if(isset($params["min_price"]) && isset($params["max_price"])) {
			
			$query .= " cenaProdej BETWEEN :min_price AND :max_price AND";
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

	public function randFind() {
		return $this->query("SELECT *, products.id AS id, sklad.id AS id_sklad, product_prodej.id AS id_product_prodej FROM products RIGHT JOIN sklad ON products.id=product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad ORDER BY RAND() ");
	}

	public function make_table($table_setup = [
		'title_table' => "Product_prodej",
		'description' => "Description",
		'brand' => "brand",
		'all_cat' => "category",
		'add_new' => "",
		"cenaNakup" => "cenaNakup",
		"cenaProdej" => "Cena Prodej",
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
		]) {

		$this->table = 'products RIGHT JOIN sklad ON products.id=product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad';
		// $rows = $this->query("SELECT *, products.id AS id, sklad.id AS id_sklad, product_prodej.id AS id_product_prodej FROM $this->table ORDER BY product_prodej.id ASC");
		$rows = $this->query("SELECT *, products.id AS id_product, sklad.id AS id_sklad, product_prodej.id AS id FROM $this->table ORDER BY product_prodej.id ASC");
// show($rows);
		if(is_array($rows)) {
			foreach($rows as $key=>$row) {
				// show($row);
						$rows[$key]->description = $row->description;
						$rows[$key]->image = $row->image;
						$rows[$key]->brand = $this->query("SELECT brand FROM brands WHERE id=:id",["id" => $row->brand])[0]->brand;
// show($rows[$key]->brand;
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