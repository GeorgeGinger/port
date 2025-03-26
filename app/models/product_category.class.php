<?php
class Product_category
{
	use Model;
	protected $table = 'product_category';

	protected $allowedColumns = [
		'product_id',
		'category_id',
	];

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}
		
		$arr["product_id"] = ucwords(trim($data->product_id));
		$arr["category_id"] = ucwords(trim($data->category_id));
	
		if (!is_numeric($arr["product_id"])) {
			$_SESSION["error"] .= "Please enter a valid description for this product_id<br>";
		}

		if (!is_numeric($arr["category_id"])) {
			$_SESSION["error"] .= "Please enter a none numeric category_id <br>";
		}

		if($this->first(["slag"=>$arr["slag"]])) {
			$arr["slag"] .= "-".rand(0,9999); 
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function getAll($data, $data_not = []) {

		$this->order_column = "product_id";
		return $this->where($data, $data_not = []);
	}

	public function getOne($data, $data_not = []) {

		$this->order_column = "product_id";
		return $this->first($data, $data_not = []);
	}

	public function delete($id, $id_column = 'id') {

		$check = [];

		$check["databaze"] = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		$this->insert($data);
	}

}