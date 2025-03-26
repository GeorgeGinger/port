<?php

class Homeshop extends Controller {

	protected $class_name = "Homeshop";

	public function index() {

		$User 				 = $this->load_model("User");
		$image_class		 = $this->load_model("image");
		// $product	 		 = $this->load_model("product");
		$product 	 = $this->load_model("product_prodej");
		$sliders			 = $this->load_model("sliders");
		$product_category	 = $this->load_model("product_category");

		// data pro category tab
		$categories = $this->load_model("category");

		// promenna v Model.php
		$categories->order_column = "views";
		
		$data["segment_data"] = $this->get_segment_data($product_category, $categories, $image_class);

		// pagination variables
		$limit = 20;
		$offset = Page::get_offset($limit);
		$product->limit = $limit;
		$product->offset = $offset;

		$data["sliders_row"] = $sliders->findAll();
	
		// kontrola pripojeneho uzivatele
		$user_data = $User->check_login();
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		// pocitani kliknuti na kategorii a ulozeni poctu do db
		if(isset($_GET["category"]) && $_GET["category"] != "") {
			$find_cat = addslashes($_GET["category"]);

			$views = $categories->first(["id" => $find_cat])->views;
			$views++;
			$categories->update($find_cat,["views" => $views]);
		}

		// pokrocile vyhledavani v sidebar menu
		$products = $product->advance_search();

		// show($products);

		// ulozenym obrazkum produktu vytvori nahledy
		if(is_array($products) && count($products) > 0) {
			foreach($products as $key => $value) {
				$products[$key]->image = $image_class->get_thumb_post($products[$key]->image, 200, 200);
			}
		}

		// zmena ulozenych obrazku ve slideru
		if(is_array($data["sliders_row"]) && count($data["sliders_row"]) > 0) {
			foreach($data["sliders_row"] as $key => $value) {
				$data["sliders_row"][$key]->image = $image_class->get_thumb_post($data["sliders_row"][$key]->image, 484, 441);
			}
		}

		// nacteni prvnku z databaze nahodne serazenych
		// $products_carusel = $product->query("SELECT * FROM products ORDER BY RAND() ");
		$products_carusel = $product->randFind();

		// zmena velikosti obrazku pro recommended items zatim se moc neprojevuje 
		if(is_array($products_carusel) && count($products_carusel) > 0) {
			foreach($products_carusel as $key => $product_value) {
				
				$products_carusel[$key]->image = $image_class->get_thumb_post($products_carusel[$key]->image, 255, 127);
			}
		}

		// vytvoreni pole poli se tremi hodnotami pro RECOMMENDED ITEMS
		if(is_array($products_carusel)) {
			$j = -1;
			for($i=0;$i<count($products_carusel); $i++) {
				if(($i)%3 == 0) {
					$j++; 
				}
				$product_carusel[$j][] = $products_carusel[$i];
			}
			$data["product_carusel"] = $product_carusel;
			// show($product_carusel);
		}
		
		
		// show($categories->find(0));

		$data["categories"]  = $categories->sidebar_string($categories->find(0),$this->class_name);
		$data["products"] 	 = $products;
		$data["show_search"] = true;
		$data["page_title"]  = "Homeshop";
		
		$this->view("index", $data);
	}

	// aby nebylo mozne pristoupit k fci pres url nastavime ji jako private
	private function get_segment_data($product_category, $categories, $image_class) {
	
		$categories = $categories->findAll();

		$result = array();
		$mycats = array();
		$num = 0;
		foreach($categories as $cat) {
			
			$mycats[] = $cat;

			$id = $cat->id;
			$products_in_cat = $product_category->query("SELECT * FROM categories RIGHT JOIN product_category ON categories.id=product_category.category_id RIGHT JOIN sklad ON product_category.product_id=sklad.product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad WHERE category_id=:category_id AND categories.disabled = 1",["category_id" => $id]);
			// $products_in_cat = $product_category->query("SELECT * FROM product_category WHERE category_id=:category_id",["category_id" => $id]);
			// show($products_in_cat);
			if(is_array($products_in_cat) && count($products_in_cat) > 0) {

				// crop images
			
					foreach($products_in_cat as $key => $value) {
						$prod = $product_category->query("SELECT * FROM products WHERE id=:id",["id"=>$value->product_id]);
						// show($prod);
							$products_in_cat[$key]->image = $image_class->get_thumb_post($prod[0]->image, 484, 441);
							$products_in_cat[$key]->id = $prod[0]->id;
							$products_in_cat[$key]->description = $prod[0]->description;
							$products_in_cat[$key]->slag = $prod[0]->slag;
						
					}
				

				$result[$cat->category]["prod"] = $products_in_cat;
				// zvlastni znaky se nahradi nicim, id elementu
				$result[$cat->category]["id_item"] = preg_replace("/\W+/","_", $cat->category);

				$num++;
				if($num > 20) {
					break;
				}
			}
		}

		// show($result);

		return $result;
		}
}

