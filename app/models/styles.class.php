<?php

class Styles
{
	use Model;
	
	protected $table = 'styles';

	protected $allowedColumns = [
		'name',
		
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["name"] = ucwords(trim($data->category));
		
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["name"])) {
			$_SESSION["error"] = "Please enter a valid style name php <br>" .$arr['name'];
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function edit($data) {
		$check["update"] =$this->update($data["id"], $data);
	}

	public function delete($id, $id_column = 'id') {
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		show($data);
		$this->insert($data);
	}

	public function make_table($table_setup = [
			'title_table' => "Categories",
			'add_new' => "",
			'name' => 'name',
		]) {

			$limit = 20;
			$offset = Page::get_offset($limit);
			$this->limit = $limit;
			$this->offset = $offset;

		$rows = $this->findAll();
		
		// nalezeni jemen kategorii podle id
		if(is_array($rows)) {
			if(is_array($rows)) {
				foreach ($rows as $key => $row) {
					$one_cat_obj = $this->first(["id" => $row->parent]);
					$one_cat = is_object($one_cat_obj) ? $one_cat_obj->category : "";
					$rows[$key]->one_cat = $one_cat;
				}
			}
		}
		
		return make_table($rows, $table_setup);
	}
}