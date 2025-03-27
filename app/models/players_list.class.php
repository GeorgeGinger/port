<?php
include_once "../app/models/players.class.php";

class Players_list extends Players
{

	use Model;
	
	static $user_type = "";

	public function make_table($table_setup = [
		'title_table' => "All players in the game",
		'name' => "name",
		'rank' => "rank",
		]) {
			
			$this->order_column = "id";

			$rows = [];
			$rows = $this->where(["user_url" => $_SESSION["user_url"]]);

			$table_string = make_table($rows, $table_setup);

		
		return $table_string;

	}

}