<?php

// zmena mnozstvi produktu v kosiku pokud vyplnuji hodnotu v inputu abych nemusel mackat odeslat

class Ajax_cart extends Controller {

	public function index() {
	
	
	}

	public function edit_quantity($data = "") {

		$obj = json_decode($data);
		$obj->data_type = "edit_quantity";

		// id upravovaneho produktu
		$id = esc($obj->id);
		$quantity = esc($obj->quantity);
		// kontrola jestli je zalozen kosik
		if(isset($_SESSION["cart"])) {
			foreach ($_SESSION["cart"] as $key => $value) {
				# code...
				if($value["id"] == $id) {
					if ($quantity <= 0 ) {
						unset($_SESSION["cart"][$key]);
					} else {
						$_SESSION["cart"][$key]["qty"]  = (int)$quantity;
					}
					break;
				}
			}
		}


		echo json_encode($obj);

	}

}