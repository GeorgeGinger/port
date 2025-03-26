<?php

// $rows by melo byt pole objektu
function make_table($rows, array $table_setup, string $table_typ ="na_sirku" ):string  {

	// ukazka
	// $table_setup = [
	// 	'title_table' => $user_type,
	// 	'add_new' => "",
	// 	'name' => 'name',
	// 	'date' => 'date',
	// 	'email' => 'email',
	// 	'anchor_1' => [
	// 		"column_name" => "...",
	// 		"a_name" => "profile",
	// jmeno odkazu bude stejna jako hodnota v db ve sloupci napr. user_name 
	// 		"a_name_dyn" => "user_name",
	// 		"target" => "_blank",
	// 		"url_0" => ROOT,
	// 		"url_1" => "profile/",
	// 		"url_2" => "user_url",
	// 		"url_3" => ""
	// 	],
	// 'disabled' => [
	// 			[
	// 				"col_name" => "status",
	// 				"db_col" => "disabled"
	// 			],
	// 		],
	// 	'action_1' => [
	// 		"column_name" => "action",
	// 		"type"=> [
	// 			"edit",
	// 			"delete",
	// 		]
	// 	]
	// ];
	
	// show($rows);

	$table_string = '<h4><i class="fa fa-angle-right"></i> '.ucfirst(isset($table_setup["title_table"]) ? $table_setup["title_table"] : ""); 
	
		if(array_key_exists("add_new", $table_setup)) {
			$table_string .=' <button type="button" class="btn btn-primary btn-xs" onclick="show_add_new({event:event, \'button_type\':\'add_row\'})"><i class="fa fa-plus"></i> Add New '.ucfirst(isset($table_setup["title_table"]) ? $table_setup["title_table"] : "").'</button>';
		}
			$table_string .='</h4>';

if(is_array($rows)) {
	if($table_typ == "na_sirku") {

			$table_string .= '<table class="js_table table table-striped table-advance table-hover"'; 
			$table_string .='<thead>';

			$table_string .= '<tr>';

		foreach ($table_setup as $key_setup => $value) {
			if(explode("_",$key_setup)[0] == "anchor") {
				$table_string .= '<th>'.ucfirst($value["column_name"]).'</th>';

			}else if($key_setup == "title_table") {

			}else if($key_setup == "add_new") {

			}else if(explode("_",$key_setup)[0] == "input") {
				$table_string .= '<th>'.ucfirst($value["column_name"]).'</th>';

			}else if(explode("_",$key_setup)[0] == "action") {
				$table_string .= '<th>'.ucfirst($value["column_name"]).'</th>';

			}else if($key_setup == "image") {
				foreach($value as $img) {
					$table_string .= '<th>'.$img.'</th>';
				}
			}else if($key_setup == "disabled") {
				foreach($value as $dis) {
					$table_string .= '<th>'.$dis["col_name"].'</th>';
				}
			}else {
				$table_string .= '<th>'.ucfirst($value).'</th>';
			}
			
		}
				$table_string .= '</tr></thead>';
			if(array_key_exists("show_details", $table_setup)) {
				$table_string .= '<tbody id="table_body" onclick="show_dateils(event)" style="cursor: pointer;">';
			} else {
				$table_string .= '<tbody id="table_body">';
			}

			foreach ($rows as $row) {

				$info = [];
				$info["button_type"] = "edit";
					foreach ($row as $key1 => $value1) {
					$info[$key1] = $value1;
				}
				$info = json_encode($info);

				
				$table_string .= '<tr style="position: relative;">';

				if(is_object($row)) {
					$row_key = array_keys(get_object_vars($row));
				}

				foreach($table_setup as $key => $column) {

					// kontrola zda jsou slopce v table setup i v databazi
					if(in_array($key, $row_key)) {
						// key v table_setup se shoduje s soupcem v databazi
						//hodnoty z databaze
						if($key == "disabled") {
							foreach($column as $value1) {
								$success_danger = $row->{$value1["db_col"]} ? "label-success" : "label-danger";
								$enable_disable = $row->{$value1["db_col"]} ? "enable" : "disable";
								$table_string .='<td><button onclick="change_status_row({id:'.$row->id.',disabled:'.$row->{$value1["db_col"]}.'})" class="btn btn-primary btn-xs"><span class="label '.$success_danger.' label-mini">'.$enable_disable.'</span></button></td>';
							}
						}else if($key == "image"){
							foreach($column as $img) {
								$table_string .='<td><span class=""><img src="' . ROOT . $row->$img . '" style="width:50px; height:50px;"></span></td>';
							}
						}else if($key == "all_cat") {
							// zobrazuje vsechny polozky v poli do jednoho policka, napr. vsechny kategotie productu
							// show($row);
							$table_string .='<td class="">';
							foreach($row->$key as $value) {
								$table_string .= $value.", ";
							}
							$table_string .='</td>';
						}
						else {
							$table_string .='<td class="">'.$row->$key.'</td>';
						}
					} else if(explode("_",$key)[0] == "anchor") {
						// url_0 ROOT
						// url_1 controler
						// url_2 fce controleru
						// url_3 get, nebo parametry fce controlleru

						if($column["url_2"] == "") {
							$url_2 = "";
						
						} else {

							if(in_array($column["url_2"], $row_key)){
								$url_2 = $row->{$column["url_2"]};

							}else {
								$url_2 = $column["url_2"];
							}

							if($column["url_3"] == "") {
								$url_3 = "";
							
							} else {
	
								if(in_array($column["url_3"], $row_key)){
									$url_3 = $row->{$column["url_3"]};
		
								}else {
									$url_3 = $column["url_3"];
									
								}
							}
						}

						if(array_key_exists("a_name", $column)) {
							$table_string .='<td class=""><a href="'.$column["url_0"].$column["url_1"].$url_2.$url_3.'" target="'.$column["target"].'">'.$column["a_name"].'</a></td>';	
						}else if(array_key_exists("a_name_dyn", $column)) {
							$table_string .='<td class=""><a href="'.$column["url_0"].$column["url_1"].$url_2.$url_3.'" target="'.$column["target"].'">'.$row->{$column["a_name_dyn"]}.'</a></td>';	
						}

					} else if(explode("_",$key)[0] == "input") {
						$table_string .='<td class=""><input type="text" class="form-control" name="'.$row->{$column["name_input"]}.'" value="'.$row->{$column["value_input"]}.'" id=""></td>';	

					} else if(explode("_",$key)[0] == "action") {
						$table_string .='<td>';
							foreach($column["type"] as $action) {
								if($action == "edit") {
									$table_string .='<button info=\'' . $info . '\' onclick="edit_row(event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
								} else if ($action == "delete") {
									$table_string .='<button info=\'' . $info . '\' onclick="delete_row({id:' . $row->id . '})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
								}
							}
									$table_string .='</td>';	
					} else if ($key == "status") {
						$table_string .= '<td class="">'.is_payd($row).'</td>';
					} 
				}
				$table_string .= '</tr>';
			}

			$table_string .= '</tbody>
			</table>';

	// pukud je rows pole hodnot
	}else if($table_typ == "na_vysku") {

		$table_string .= '<table class="js_table table table-striped table-advance table-hover"'; 
		$table_string .='<thead>';

		$table_string .= '<tr>';

	foreach ($table_setup as $key_setup => $value) {
		if(in_array($key_setup, array_keys($rows))) {
			$table_string .= '<tr>';
			$table_string .= '<td>'.$value.'</td>';
			$table_string .= '<td>'.$rows[$key_setup].'</td>';
			$table_string .= '</tr>';
		}
	}
			$table_string .= '</thead></table>';
		
}

	return $table_string;
	}

	$table_string .= '<div>
		<h2 style="text-align: center">No items.</h2>
		</div>';

	return $table_string;
}
