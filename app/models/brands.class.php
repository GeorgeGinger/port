<?php

class Brands
{
	use Model;
	
	protected $table = 'brands';

	protected $allowedColumns = [
		'brand',
		'disabled',
		'views',
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["brand"] = ucwords(trim($data->brand));
		$arr["id"] = $data->id;
		
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["brand"])) {
			$_SESSION["error"] = "Please enter a valid brand name php <br>" .$arr['brand'];
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}
	
	// public function get_all() {
	// 	return $this->findAll();
	// }

	public function edit($data) {
		$check["update"] =$this->update($data["id"], $data);
	}

	public function delete($id, $id_column = 'id') {
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		$this->insert($data);
	}

	public function make_table($table_setup = [
			'title_table' => "Brands",
			'add_new' => "",
			'brand' => 'brand',
			'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled"
				],
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

			$rows = $this->findAll();
			
			return make_table($rows, $table_setup);
	}

	public function find($id) {
		$cat0 = $this->where(["parent" => $id]);

		if(is_array($cat0) && count($cat0)) {
			
			foreach($cat0 as $key=>$val) {
				$cat_pod = $this->find($val->id);
				if(is_array($cat_pod) && count($cat_pod) > 0) {
					$cat0[$key]->pod = $cat_pod;
				}
		}
		}
		
		return $cat0;
	}
}