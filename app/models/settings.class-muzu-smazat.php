<?php

class Settings
{
	use Model;
	protected $table = 'settings';
	protected $allowedColumns = [
		'setting',
		'setting_value',
		
	];

	private $error = "";

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["setting"] = trim($data->setting);
		$arr["setting_value"] = trim($data->setting_value);
		
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ+ 0-9._\-,]+$/", $arr["setting"])) {
			$_SESSION["error"] = "Please enter a valid setting php <br>" .$arr['setting'];
		}

		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ+ 0-9._\-,]+$/", $arr["setting_value"])) {
			$_SESSION["error"] = "Please enter a valid setting_value php <br>" .$arr['setting_value'];
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}


	public function make_table():string  {
	
		$limit = 20;
		$offset = Page::get_offset($limit);
		$this->limit = $limit;
		$this->offset = $offset;

		$table_setup = [
			'setting' => 'Setting',
			'title_table' => "socials",
			"input" => [
				"column_name" => "Value",
				"name_input" => "setting",
				"value_input" => "setting_value"
			],
			"delete" => "delete",
			];
		$rows = $this->findAll();

		if(is_array($rows)) {
		
				$table_string = '<table class="js_table table table-striped table-advance table-hover">
				<h4><i class="fa fa-angle-right"></i> '.ucfirst($table_setup["title_table"]).' <button type="button" class="btn btn-primary btn-xs"
						onclick="show_add_new({event:event, \'button_type\':\'add_row\'})"><i class="fa fa-plus"></i> Add New'.ucfirst($table_setup["title_table"]).'</button></h4><thead>';
		
				$table_string .= '<tr>';
				foreach ($table_setup as $key_setup => $value) {
					if($key_setup == "anchor") {
						$table_string .= '<th>'.ucfirst($value["column_name"]).'</th>';
					}else if($key_setup == "title_table") {
		
					 }else if($key_setup == "input") {
						$table_string .= '<th>'.ucfirst($value["column_name"]).'</th>';
					 }else {
						$table_string .= '<th>'.ucfirst($value).'</th>';
					}
				}
				$table_string .= '</tr></thead>
					<tbody id="table_body">';
		
					foreach ($rows as $row) {
		
						$table_string .= '<tr style="position: relative;">';
						$row_key = array_keys(get_object_vars($row));
						foreach($table_setup as $key => $column) {
		
							if(in_array($key, $row_key)) {
								$table_string .='<td class="js_td'.$row->id.'">'.$row->$key.'</td>';
							} else if($key == "anchor") {
								$table_string .='<td class="js_td'.$row->id.'"><a href="'.ROOT.'profile/'.$row->user_url.'">'.$column["a_name"].'</a></td>';	
							} else if($key == "input") {
								$table_string .='<td class="js_td'.$row->id.'"><input type="text" class="form-control" name="'.$row->{$column["name_input"]}.'" value="'.$row->{$column["value_input"]}.'" id=""></td>';	
							} else if($key == "delete") {
								$table_string .='<td class="js_td'.$row->id.'">	<button onclick="delete_row({id:'.$row->id.'})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></td>';	
							}
						}
						// $table_string .= '<th><i class="fa fa-arrow-down"></i><div class="js_order_details details hide"><div class="close">close</div>'.$this->make_table_details($row->id).'</div></th></tr>';
						$table_string .= '</tr>';
					}
		
					$table_string .= '</tbody>
					</table>';
		
			return $table_string;
			}
			return false;
		}

}

