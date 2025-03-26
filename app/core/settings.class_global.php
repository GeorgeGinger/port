<?php

class Settings_global
{
	use Model;

	protected $table = 'settings';
	protected $allowedColumns = [
		'setting',
		'setting_value',
		
	];
	
	// volani promenne v main controlleru
	public static $SETTINGS = null;

	private $error = "";	

	function __construct() {
		if(!self::$SETTINGS) {	
			self::$SETTINGS = $this->findAll();
		}
	}

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["setting"] = trim($data->setting);
		$arr["setting_value"] = trim($data->setting_value);
		
		if(!preg_match("/^[a-zA-ZěščřžýáíéůúĚŠČŘŽÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["setting"])) {
			$_SESSION["error"] = "Please enter a valid setting php <br>" .$arr['setting'];
		}

		if(!preg_match("/^[a-zA-ZěščřžýáíéůúĚŠČŘŽÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["setting_value"])) {
			$_SESSION["error"] = "Please enter a valid setting_value php <br>" .$arr['setting_value'];
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function delete($id, $id_column = 'id') {
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data) {
		// show($data);
		$this->insert($data);
	}

	public function make_table($table_setup = [
		'title_table' => "Socials",
		'add_new' => "",
		'setting' => 'Setting',
		"input" => [
				"column_name" => "Value",
				"name_input" => "setting",
				"value_input" => "setting_value"
			],
		'action_1' => [
			"column_name" => "action",
			"type"=> [
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

}

