<?php
class Product
{
	use Model;
	// use Product_category;
	protected $table = 'products';

	protected $allowedColumns = [
		'user_url',
		'description',
		'brand',
		'image',
		'image2',
		'image3',
		'image4',
		'date',
		'slag',
	];

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}
		
		$arr["description"] = ucwords(trim($data->description));
		$arr["category"] = $data->category;
		$arr["brand"] = ucwords(trim($data->brand));
		$arr["date"] = date("Y-m-d H:i:s");
		$arr["user_url"] = $_SESSION["user_url"];
		$arr["slag"] = str_to_url($data->description);
		$arr["id"] = $data->id;

		if (!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", trim($arr["description"]))) {
			$_SESSION["error"] .= "Please enter a valid description for this product<br>";
		}

		if (!is_array($arr["category"])) {
			$_SESSION["error"] .= "Please enter a valid description for this category<br>";
		}

		if (!is_numeric($arr["brand"])) {
			$_SESSION["error"] .= "Please enter a none numeric brand <br>";
		}

		if($this->first(["slag"=>$arr["slag"]])) {
			$arr["slag"] .= "-".rand(0,9999); 
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function delete_img($filename) {

		$check["filename"] = $filename;
		
					if(file_exists($filename)) {
						if (unlink($filename)) {
							$check["info"] = "The file $filename was deleted successfully!";
						} else {
							$check["info"] = "There was an error deleting the file $filename.";
						}
					}

					if(file_exists($filename."_post_thumb.jpg")) {
						if (unlink($filename."_post_thumb.jpg")) {
							$check["info_thumb"] = "The file ".$filename."_post_thumb.jpg was deleted successfully!";
						} else {
							$check["info_thumb"] = "There was an error deleting the file ".$filename."_post_thumb.jpg.";
						}
					}

					return $check;
	}

	public function delete($id, $id_column = 'id') {

		$check = [];

		if($id_column == "id") {

			$rowToDelete = $this->first(["id"=>$id]);

			$check["rowToDelete"] = $rowToDelete;

			foreach($rowToDelete as $key=>$value) {
				if(str_contains($key, "image") && $value != "") {
	
					$check["delete_prod"][$key] = $this->delete_img($value);
		
				}
			}
		}

		$check["delete_product_cat"] = $this->query("DELETE FROM product_category WHERE product_id=:product_id ",["product_id"=>$id]);

		$check["delete_product"] = $this->delete_model($id, $id_column);
		return $check;
	}

	public function save_img($files, $image_class) {

		$allowed[] = "image/jpeg";
		// $allowed[] = "image/png";
		// $allowed[] = "image/gif";
		// $allowed[] = "application/pdf";

		// velikost souboru v magabites
		$size = 10;
		$size = ($size * 1024 * 1024);

		$folder = "uploads/product/";

		$data = [];

		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}
		// check for files
		if(isset($files))
		// show($files);
		foreach ($files as $key => $img_row) {
			if ($img_row["error"] == 0 && in_array($img_row['type'], $allowed)) {
				if ($img_row['size'] < $size) {
					$destination = $folder . $image_class->generate_filename(60)."_product_".$img_row["name"];
					move_uploaded_file($img_row["tmp_name"], $destination);
					$data[$key] = $destination;

					$image_class->resize_image($destination,$destination,320,320);
				} else {
					$_SESSION["error"] .= $key . " Is bigger than required size br>";
				}
			}
		}

		return $data;
	}

	public function add_row($data, $files = null, $image_class = null)
	{
		if($files != null) {
			$data['image'] = "";
			$data['image2'] = "";
			$data['image3'] = "";
			$data['image4'] = "";

			$img_data = $this->save_img($files, $image_class);

			if(is_array($img_data) && count($img_data) > 0) 
				$data =  array_merge($data, $img_data);
		}
		
		
		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check["product"] = $this->insert($data);

			$product_id = $this->first(["description"=>$data["description"]])->id;

			// show($product_id);

			foreach($data["category"] as $value) {
				// show($value);
				$check["product_category"] = $this->query("INSERT INTO product_category (product_id, category_id) values (:product_id, :category_id)", ["product_id"=>$product_id, "category_id"=>$value]);
			}

			if ($check["product"]) {
		

				return true;
			}
		}

		return false;
	}

	public function edit($data, $files = null, $image_class = null)
	{

		// show("edit");
		// show($data);

		if($files != null) {

			// nacteni radku ktery chci updatovat
			$rowToUpdate = $this->first(["id"=>$data["id"]]);

			// kontrolni vypis
			$check["rowToUpdate"] = $rowToUpdate;

			// projdu klíce nalezeneho radku
			foreach($rowToUpdate as $key=>$value) {
				// pokud najdu klic onsahujici image
				if(str_contains($key, "image")) {

					// pokud je tento klic v poli files vymazu soubor jehoz cesta je ve value abych ho mohl nahradit souborem ve files
					if(array_key_exists($key, $files)) {
						$check["delete_img"][$key] = $this->delete_img($value);

					}
					
				}
			}

			// ulozim soubory ktere jsou ve files
			$img_data = $this->save_img($files, $image_class);
			if(is_array($img_data) && count($img_data) > 0)
				$data =  array_merge($data, $img_data);
		}
		
		// echo json_encode($properties);

		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check["update"] =$this->update($data["id"], $data);

			$this->query("DELETE FROM product_category WHERE product_id=:product_id ",["product_id"=>$data["id"]]);

			foreach($data["category"] as $value) {
				// show($value);
				$this->query("INSERT INTO product_category (product_id, category_id) values (:product_id, :category_id)", ["product_id"=>$data["id"], "category_id"=>$value]);
			}

			if ($check) {

				return true;
			}
		}

		return false;
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
		'title_table' => "Products",
		'add_new' => "",
		// 'description' => 'product',
		'anchor_1' => [
			"column_name" => "naskladnit",
			// "a_name" => "description",
			"a_name_dyn" => "description",
			"target" => "",
			"url_0" => ROOT,
			"url_1" => "admin/",
			"url_2" => "naskladnit/",
			"url_3" => "id"
		],
		'all_cat' => 'category',
		'one_brand' => 'brand',
		'slag' => 'slag',
		'date' => 'date',
		"image" => [
			'image',
			'image2',
			'image3',
			'image4'
			],
		'action_1' => [
			"column_name" => "action",
			"type"=> [
				"edit",
				"delete",
			]
		],
	]) {

		$limit = 20;
		$offset = Page::get_offset($limit);
		$this->limit = $limit;
		$this->offset = $offset;

		$rows = [];
		$rows = $this->advance_search();
		$product_cats = [];

		if(is_array($rows)) {
			// nalezeni podle id
			foreach ($rows as $key => $row) {
				$product_cats = [];
				// nalezeni vsech category_id productu
				$all_cat_of_product = $this->query("SELECT category_id FROM product_category WHERE product_id=:product_id", ["product_id" => $row->id]);
				// show($all_cat_of_product);
				

				if(is_array(($all_cat_of_product))) {
					// nalezeni jmen kategorii podle id
					foreach($all_cat_of_product as $value) {
						
						$rows[$key]->all_cat_id[] = $value->category_id;
						// pole vsech kategorii produktu
						// vyhodilo chybu pokud se vybere uvodni prazdna kategorie v selectu
						if($value->category_id) {
							// show($value->category_id);
							$product_cats[] = $this->query("SELECT category FROM categories WHERE id=:id LIMIT 1", ["id" => $value->category_id])[0]->category;	
						}
					}
					// show($product_cats);
				}
					$one_brand_arr = $this->query("SELECT brand FROM brands WHERE id=:id", ["id" => $row->brand]);
					// pokud neni kategorie zadana 
					$all_cat = count($product_cats)>0 ? $product_cats : ["undefined"];
					$one_brand = is_object($one_brand_arr[0]) ? $one_brand_arr[0]->brand : "";
					$rows[$key]->all_cat = $all_cat;
					$rows[$key]->one_brand = $one_brand;
				
			}
				// show($rows);
		}

		return make_table($rows, $table_setup);
		
	}
}