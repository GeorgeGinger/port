<?php
include_once "../app/models/players.class.php";

class Player_admin extends Players
{

	use Model;
	
	static $user_type = "";

	public function make_table($table_setup = [
		'title_table' => "players",
		'name' => "name",
			'login_date' => 'date',
			'death_date' => 'death_date',
			'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled",
					"bt_title_dis" => "killed",
					"bt_title_en" => "lived",
					"type" => "button",
				],
			],
		'action_1' => [
			"column_name" => "action",
			"type"=> [
				"edit",
				"delete",
			]
		]
		]) {
			
			$this->order_column = "player_order";

			$user_type = Players::$user_type;

			$rows = [];
			$rows = $this->where(["rank" => $user_type]);

			$table_string = make_table($rows, $table_setup);

		
		return $table_string;

	}

}