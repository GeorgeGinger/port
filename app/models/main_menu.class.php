<?php

class Main_menu
{
	use Model;
	
	public $table = 'main_menu';

	protected $allowedColumns = [
		'style_id',
		'shelf',
		'shelf_order',
		'type',
		'class',
		'url',
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["shelf"] = ucwords(trim($data->shelf));
		$arr["style_id"] = $data->style_id;
		$arr["shelf_order"] = $data->shelf_order;
		$arr["type"] = $data->type;
		$arr["class"] = $data->class;
		$arr["url"] = $data->url;
		$arr["id"] = $data->id;
		
		if(!preg_match("/^[a-zA-ZěščřžýáíéůúĚŠČŘŽÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["shelf"])) {
			$_SESSION["error"] = "Please enter a valid shelf name php <br>" .$arr['shelf'];
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
		$this->insert($data);
	}

	public function make_table($table_setup = [
		'title_table' => "Main menu item",
		'add_new' => "",
		"one_style" => "style",
		'shelf' => 'shelf',
		'shelf_order' => 'order',
		'type' => 'type',
		'class' => 'icon_class',
		'url' => 'url',
		'action_1' => [
			"column_name" => "action",
			"type"=> [
				"edit",
				"delete",
				]
			],
		]) {

		$rows = $this->query("SELECT * FROM $this->table  ORDER BY style_id,shelf_order ASC");

		if(is_array($rows)) {
			foreach ($rows as $key => $row) {
				$one_style_arr = $this->query("SELECT style FROM styles WHERE id=:style_id",["style_id" => $row->style_id]);
				$one_style = is_array($one_style_arr) ? $one_style_arr[0]->style : "";
				$rows[$key]->one_style = $one_style;
			}
		}

		return make_table($rows, $table_setup);
	}

}