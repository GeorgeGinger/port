<?php

class Shop extends Controller {

	protected $class_name = "Shop";

	public function index() {

		$User 		 = $this->load_model("User");
		$image_class = $this->load_model("image");
		$product 	 = $this->load_model("product");
		$categories  = $this->load_model("category");
		
		// pagination variables
		$limit = 20;
		$offset = Page::get_offset($limit);
		$product->limit = $limit;
		$product->offset = $offset;

		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		if(isset($_GET["find"])) {
			$find = addslashes($_GET["find"]);
			$products = $product->every_where(["description" =>"%".$find."%"]);
		}else if(isset($_GET["category"]) && $_GET["category"] != "") {
			$find_cat = addslashes($_GET["category"]);

			$views = $categories->first(["id" => $find_cat])->views;
			$views++;
			$categories->update($find_cat,["views" => $views]);
		}

		$products = $product->advance_search();

		if(is_array($products) && count($products) > 0) {
			foreach($products as $key => $value) {
				$products[$key]->image = $image_class->get_thumb_post($products[$key]->image);
			}
		}

		$data["categories"] = $categories->sidebar_string($categories->find(0),$this->class_name);

		$data["products"] = $products;

		$data["show_search"] = true;

		$data["page_title"] = "Shop";
		$this->view("shop", $data);
	}

	
}
