<?php

class Category
{
	use Model;
	
	protected $table = 'categories';

	protected $allowedColumns = [
		'category',
		'disabled',
		'parent',
		'views',
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}

		$arr["category"] = ucwords(trim($data->category));
		$arr["parent"] = ucwords(trim($data->parent));
		$arr["id"] = $data->id;
		
		if(!preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", $arr["category"])) {
			$_SESSION["error"] = "Please enter a valid category name php <br>" .$arr['category'];
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

	public function find($id) {

			$cat0 = $this->where(["parent" => $id]);

			if(is_array($cat0) && count($cat0)) {
				
				foreach($cat0 as $key=>$val) {

					$use_cat = $this->query("SELECT * FROM product_category WHERE category_id=:category_id", ["category_id" => $val->id]);
					
					if(is_array($use_cat)) {
						$cat_pod = $this->find($val->id);
						if(is_array($cat_pod) && count($cat_pod) > 0) {
							$cat0[$key]->pod = $cat_pod;
						}
					}else {
						unset($cat0[$key]);
					}
			}
		}
		
		return $cat0;
	}

	public function make_table($table_setup = [
			'title_table' => "Categories",
			'add_new' => "",
			'category' => 'categoy',
			'one_cat' => 'parent',
			'nofProduct' => 'n.of Product',
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
		// show($rows);
		
		// nalezeni jemen kategorii podle id
		if(is_array($rows)) {
			foreach ($rows as $key => $row) {
				$one_cat_obj = $this->first(["id" => $row->parent]);
				// pokud dana kategorie neobsahuje nedkategorii
				$one_cat = is_object($one_cat_obj) ? $one_cat_obj->category : "0";
				$rows[$key]->one_cat = $one_cat;

				// pocitani produktu v kategoriich
				$rows[$key]->nofProduct = $this->query("SELECT COUNT(*) AS nofproduct FROM product_category RIGHT JOIN sklad ON product_category.product_id=sklad.product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad WHERE category_id=:id",["id"=>$row->id])[0]->nofproduct;
			}
		}
		
		return make_table($rows, $table_setup);
		
	}

	// vytvoreni sidebar menu pomoci rekurzivni fce
	// class_name predavam kvuli odkazum
	public function sidebar_string($arr, $class_name, $side_string = "") {

		if(is_array($arr) && count($arr) > 0) {
			
			foreach($arr as $key => $val) {

				if(!isset($val->pod) && $val->parent == 0) {
					// katogorie bez podkategoii
					$side_string .= $this->one_cat($val, $class_name);
					continue;
				}

				if (isset($val->pod)) {
					$side_string .= $this->start_plus($val, $class_name);
					// vypis podkategorii
					$side_string = $this->sidebar_string($val->pod, $class_name, $side_string);
					$side_string .= $this->end_plus();
				}

				if(!isset($val->pod) && $val->parent > 0) {
					$side_string .= $this->one_cat($val, $class_name);
						
					if(isset($arr[$key+1])) {
						// mezi polozkamy v jedne kategorii
						$side_string .= '</li><li>';
					}
				}
			}
		}
		return $side_string;
	}

	public function start_plus($val, $class_name) {
		$str = $val->category;
		$nad = $str;
		// pouzito pri odlisovani elementu
		$str = "id".rand(0, 10000);

		// $start_plus = '<div class="panel-group category-products" id="accordian'.$str.'">
		$start_plus = '
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian'.$str.'" href="#'.$str.'">
								<span class="badge pull-right"><i class="fa fa-plus"></i></span>
								'.$nad.'
							</a>
						</h4>
					</div>
					<div id="'.$str.'" class="panel-collapse collapse">
						<div class="panel-body" style="padding: 0px">
							<ul>
								<li>';
		return $start_plus;
	}

	public function end_plus() {
		$end_plus = '</li>
					</ul>
						</div><!--/panel body-->
					</div><!--/panel collapse-->
				</div><!--/panel defaut-->';

			// </div><!--/panel group-->';
		return $end_plus;
	}

	public function one_cat($val, $class_name) {
		$str = $val->category;
		// show($class_name);
		if($class_name != "Home" && $class_name != "Shop") {
			$class_name = "shop";
		}

		$one_cat = '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="'.ROOT.$class_name.'/category/'.str_to_url($str).'?category='.$val->id.'">'.$str.'</a></h4>
								</div>
							</div>';
		return $one_cat;
	}

}