<?php

class Cart extends Controller {

	public function index() {
	
		$User = $this->load_model("User");
		$image_class = $this->load_model("image");
		// $product = $this->load_model("product");
		$product = $this->load_model("product_prodej");
		
		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["products"] = [];
		$data["subtotal_cart_price"] = 0;
		$data["total_cart_price"] = 0;
		$data["page_title"] = "Cart";

		$prod_ids = array();

		// vhledani produktu z kosiku v databazi a opetovne prohledani SESSION["cart"] kvuli prirazeni quantity
 		if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
			$prod_ids = array_column($_SESSION["cart"], "id");

				foreach($prod_ids as $prod_id) {

					$product_row = $product->getOne(["id"=>$prod_id]);

					if($product_row) {

						foreach($_SESSION["cart"] as $key => $prod) {

							if($prod_id == $prod["id"]) {
								
								$product_row->qty = $_SESSION["cart"][$key]["qty"]; 
								$product_row->image = $image_class->get_thumb_post($product_row->image);
								// celkova cena jednotlivych polozek
								$product_row->item_total_price = $product_row->cenaProdej * $product_row->qty;

								$data["products"][] = $product_row;
								break;
							}
							
						}
						// celkova cena kosiku
						$data["subtotal_cart_price"] += $product_row->item_total_price;
					}else {

						// // show("product nenalezen v db");
						// header("Location:".ROOT);
						// die;
					}
				}
		}
		
		// show($data["products"]);
		rsort($data["products"]);
		$data["total_cart_price"] = 0;
		
		$this->view("cart", $data);

	}
}
