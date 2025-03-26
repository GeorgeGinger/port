<?php

class Order_details
{
	use Model;
	protected $table = 'order_details';

	protected $allowedColumns = [
		'order_id',
		'qty',
		'description',
		'amount',
		'total',
		'product_id'
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["category"] = ucwords(trim($data->category));
		$arr["parent"] = ucwords(trim($data->parent));
		
		if(!preg_match("/^[a-zA-ZěščřžýáíéůúĚŠČŘŽÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["category"])) {
			$_SESSION["error"] = "Please enter a valid category name php <br>" .$arr['category'];
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function save($products, $last_order_id) {

		// show($products);
		// show($last_order_id);

		foreach($products as $value) {
			$data['order_id'] = $last_order_id;
			$data['qty'] = $value->qty;
			$data['description'] = $value->description;
			$data['amount'] = $value->cenaProdej;
			$data['total'] = $value->item_total_price;
			$data['product_id'] = $value->id;
			$this->insert($data);
		}

		
	}

	// jeste nefunguje
	public function mak_table($table_setup = [
		'title_table' => "Categories",
		'add_new' => "",
		'category' => 'categoy',
		'one_cat' => 'parent',
		'disabled' => 'status',
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
	
	// nalezeni jemen kategorii podle id
	foreach ($rows as $key => $row) {
	$one_cat_obj = $this->first(["id" => $row->parent]);
		$one_cat = is_object($one_cat_obj) ? $one_cat_obj->category : "";
		$rows[$key]->one_cat = $one_cat;
	}

	return make_table($rows, $table_setup);
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
}