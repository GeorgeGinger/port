<?php

class Messages
{
	use Model;
	
	protected $table = 'messages';

	protected $allowedColumns = [
		'name',
		'email',
		'subject',
		'message',
		'date',
	];

	public $error = array();
	
	public function validate($data) {

		$_SESSION["error"] = "";

		$this->error = [];

		if (is_array($data)) {
		 $data = (object) $data;
		}

		
		if(!is_object($data)) {
			$this->error = "fce edit product \$data must be a type of array or object";
			return;
		}


		$arr["name"] = ucwords(trim($data->name));
		$arr["email"] = trim($data->email);
		$arr["subject"] = trim($data->subject);
		$arr["message"] = trim($data->message);
		$arr["date"] = $data->date;
		
		
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["name"])) {
			$this->error[] = "Please enter a valid name php " .$arr['name'];
		}
		if(!filter_var($arr["email"], FILTER_VALIDATE_EMAIL)) {
			$this->error[] = "Please enter a valid email php " .$arr['email'];
		}
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["subject"])) {
			$this->error[] = "Please enter a valid subject php " .$arr['subject'];
		}
		if(empty($arr["message"])) {
			$this->error[] = "Please enter a valid massage php " .$arr['massage'];
		}

		if(count($this->error) == 0) {

			return $arr;
		}
		
		return false;
	}
	
	public function get_all() {
		return $this->findAll();
	}

	public function delete($id, $id_column = 'id') {
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function make_table() {

		$rows = $this->findAll();

		$table_string = "";
		if(is_array($rows)) {
			foreach ($rows as $row) {

				$info = [];
				$info["button_type"] = "edit";
				foreach ($row as $key => $value) {
					$info[$key] = $value;
				}

				$info = json_encode($info);
				
				$success_danger = $row->disabled ? "label-success" : "label-danger";
				$enable_disable = $row->disabled ? "enable" : "disable";

				$one_cat_obj = $this->first(["id" => $row->parent]);
				$one_cat = is_object($one_cat_obj) ? $one_cat_obj->category : "";
				
				
				$table_string .= '<tr>
								<td><a href="basic_table.html#">'.$row->category.'</a></td>
								<td><a href="basic_table.html#">'.$one_cat.'</a></td>
								<td><button onclick="change_status_row({id:'.$row->id.',disabled:'.$row->disabled.'})" class="btn btn-primary btn-xs"><span class="label '.$success_danger.' label-mini">'.$enable_disable.'</span></button></td>
								<td>
									<button info=\'' . $info . '\' onclick="edit_row(event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
									<button onclick="delete_row({id:'.$row->id.'})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
								</td>
							</tr>';
			}
			return $table_string;
		}
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