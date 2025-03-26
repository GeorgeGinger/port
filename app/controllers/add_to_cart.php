<?php

// pridavani, odebirani a mazani produktu z kosiku

class Add_to_cart extends Controller {

	private $redirect_to = "";

	public function index($id = "" ) {

		$this->set_redirect();
		
		$id = esc($id);
		// $product = $this->load_model("product");
		$product = $this->load_model("product_prodej");
		// $product_row = $product->first(["id"=>$id]);
		$product_row = $product->getOne(["id"=>$id]);

		// show($product_row);

		if($product_row) {

			if(isset($_SESSION["cart"])){

				// pridani mozstvi produktu v kosiku
				// vytvori pole ze sloupce id
				$ids = array_column($_SESSION["cart"], "id");
				if(in_array($product_row->id, $ids)) {
					$key = array_search($product_row->id, $ids);

						$_SESSION["cart"][$key]["qty"] ++; 
					
				}else {
					// pridani dalsiho produktu do kosiku s jinym id
					$arr["id"] = $product_row->id;
					$arr["qty"] = 1;
					$_SESSION["cart"][] = $arr; 

				}

			}else {
				// zalozeni kosiku a vlozeni prvniho produktu
				$arr = array();
				$arr["id"] = $product_row->id;
				$arr["qty"] = 1;
				$_SESSION["cart"][] = $arr; 

			}
			
		}

		// unset($_SESSION["cart"]);
		// show($_SESSION["cart"]);
		$this->redirect();
	}

	public function add($id = "") {

		$this->set_redirect();
		$id = esc($id);
		if(isset($_SESSION["cart"])) {
			foreach ($_SESSION["cart"] as $key => $value) {
				# code...
				if($value["id"] == $id) {
					$_SESSION["cart"][$key]["qty"] ++;
					break;
				}
			}
		}
		$this->redirect();
	} 
	public function subtract($id = "") {

		$this->set_redirect();
		$id = esc($id);
		if(isset($_SESSION["cart"])) {
			foreach ($_SESSION["cart"] as $key => $value) {
				# code...
				if($value["id"] == $id) {
					$_SESSION["cart"][$key]["qty"] --;
					if($_SESSION["cart"][$key]["qty"] <= 0) {
						unset($_SESSION["cart"][$key]);
						// precisleni pole aby byly klice postupne
						$_SESSION["cart"] = array_values($_SESSION["cart"]);
					}
					break;
				}
			}
		}
		$this->redirect();
	} 
	public function delete($id = "") {

		$this->set_redirect();

		$id = esc($id);
		if(isset($_SESSION["cart"])) {
			foreach ($_SESSION["cart"] as $key => $value) {
				# code...
				if($value["id"] == $id) {
				unset($_SESSION["cart"][$key]);
				// precisleni pole aby byly klice postupne
				$_SESSION["cart"] = array_values($_SESSION["cart"]);
				// show($_SESSION["cart"]);
					break;
				}
			}
		}
		$this->redirect();
	} 

	private function redirect() {
		header("Location: ".$this->redirect_to);
		die;
	}

	private function set_redirect() {

		// show($_SERVER["HTTP_REFERER"]);
		if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != "") {

			$this->redirect_to = $_SERVER["HTTP_REFERER"];
			
		}else {
			$this->redirect_to = ROOT."shop";
		}

		

	}
}
