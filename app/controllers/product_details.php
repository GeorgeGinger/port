<?php

class Product_details extends Controller {

	protected $class_name = "Product_details";

	public function index($slag) {
	
		$slag = esc($slag);

		$User 				 = $this->load_model("User");
		$image_class 		 = $this->load_model("image");
		$product 			 = $this->load_model("product");
		$product_category	 = $this->load_model("product_category");
		$categories 		 = $this->load_model("category");

		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		
		$data["segment_data"] = $this->get_segment_data($product_category, $categories, $image_class);


		// nacteni prvnku z databaze nahodne serazenych
		$products_carusel = $product->query("SELECT * FROM products ORDER BY RAND() ");

		// zmena velikosti obrazku pro recommended items zatim se moc neprojevuje 
		if(is_array($products_carusel) && count($products_carusel) > 0) {
			foreach($products_carusel as $key => $product_value) {
				
				$products_carusel[$key]->image = $image_class->get_thumb_post($products_carusel[$key]->image, 255, 127);
			}
		}

		// vytvoreni pole poli se tremi hodnotami pro RECOMMENDED ITEMS
		$j = -1;
		for($i=0;$i<count($products_carusel); $i++) {
			if(($i)%3 == 0) {
				$j++; 
			}
			$product_carusel[$j][] = $products_carusel[$i];
		}

		$data["product_carusel"] = $product_carusel;

		// volba kategorie v sidebaru
		$data["categories"] = $categories->sidebar_string($categories->find(0),$this->class_name);

		$data["product"] = $product->first(["slag"=>$slag]);

		$data["page_title"] = "Product datails";

		if($data["product"]) {
			$this->view("product_details", $data);
		}else {
			$this->view("404", $data);
		}
		
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
				$products_in_cat = $product_category->query("SELECT * FROM product_category WHERE category_id=:category_id",["category_id" => $id]);
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
