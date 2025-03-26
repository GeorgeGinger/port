<?php

class Sliders
{
	use Model;
	
	protected $table = 'sliders';

	protected $allowedColumns = [
		'header',
		'header1',
		'text',
		'link',
		'image',
		'image1',
		'disabled',
	];

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}
		
		$arr["header"] = ucwords(trim($data->header));
		$arr["header1"] = ucwords(trim($data->header1));
		$arr["text"] = ucwords(trim($data->text));
		$arr["link"] = ucwords(trim($data->link));
		$arr["id"] = $data->id;

		if (empty($arr["header"]) && !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", trim($arr["header"]))) {
			$_SESSION["error"] .= "Please enter a valid header slider<br>";
		}

		if (empty($arr["header1"]) && !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", trim($arr["header1"]))) {
			$_SESSION["error"] .= "Please enter a valid header1slider<br>";
		}

		if (empty($arr["text"]) && !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", trim($arr["text"]))) {
			$_SESSION["error"] .= "Please enter a valid text<br>";
		}

		if (empty($arr["link"])) {
			$_SESSION["error"] .= "Please enter a valid text<br>";
		}

		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;
		}
		
		return false;
	}

	public function delete_img($filename) {

		$check["filename"] = $filename;
		
					if(file_exists($filename)) {
						if (unlink($filename)) {
							$check["info"] = "The file $filename was deleted successfully!";
						} else {
							$check["info"] = "There was an error deleting the file $filename.";
						}
					}

					if(file_exists($filename."_post_thumb.jpg")) {
						if (unlink($filename."_post_thumb.jpg")) {
							$check["info_thumb"] = "The file ".$filename."_post_thumb.jpg was deleted successfully!";
						} else {
							$check["info_thumb"] = "There was an error deleting the file ".$filename."_post_thumb.jpg.";
						}
					}

					return $check;
	}

	public function delete($id, $id_column = 'id') {

		$check = [];

		if($id_column == "id") {

			$rowToDelete = $this->first(["id"=>$id]);

			$check["rowToDelete"] = $rowToDelete;

			foreach($rowToDelete as $key=>$value) {
				if(str_contains($key, "image") && $value != "") {
					
					$check["delete_img"][$key] = $this->delete_img($value);
				}
			}
		}

		$check["delete_slider"] = $this->delete_model($id, $id_column);
		return $check;
	}

	public function save_img($files, $image_class) {

		$allowed[] = "image/jpeg";
		// $allowed[] = "image/png";
		// $allowed[] = "image/gif";
		// $allowed[] = "application/pdf";

		// velikost souboru v magabites
		$size = 10;
		$size = ($size * 1024 * 1024);

		$folder = "uploads/";

		$data = [];

		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}
		// check for files
		if(isset($files))
		foreach ($files as $key => $img_row) {
			if ($img_row["error"] == 0 && in_array($img_row['type'], $allowed)) {
				if ($img_row['size'] < $size) {
					$destination = $folder . $image_class->generate_filename(60)."_".$img_row["name"];
					move_uploaded_file($img_row["tmp_name"], $destination);
					$data[$key] = $destination;

					$image_class->resize_image($destination,$destination,320,320);
				} else {
					$_SESSION["error"] .= $key . " Is bigger than required size br>";
				}
			}
		}

		return $data;
	}

	public function add_row($data, $files = null, $image_class = null)
	{
		if($files != null) {
			$data['image'] = "";
			$data['image1'] = "";

			$img_data = $this->save_img($files, $image_class);

			if(is_array($img_data) && count($img_data) > 0) 
				$data =  array_merge($data, $img_data);
		}

		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check["slider"] = $this->insert($data);

			if ($check) {

				return $check;
			}
		}

		return false;
	}

	public function edit($data, $files = null, $image_class = null)
	{

		// show("edit");
		// show($data);
		
		if($files != null) {

			// nacteni radku ktery chci updatovat
			$rowToUpdate = $this->first(["id"=>$data["id"]]);

			// kontrolni vypis
			$check["rowToUpdate"] = $rowToUpdate;

			// projdu klíce nalezeneho radku
			foreach($rowToUpdate as $key=>$value) {
				// pokud najdu klic onsahujici image
				if(str_contains($key, "image")) {

					// pokud je tento klic v poli files vymazu soubor jehoz cesta je ve value abych ho mohl nahradit souborem ve files
					if(array_key_exists($key, $files)) {
						$check["delete_img"][$key] = $this->delete_img($value);

					}
					
				}
			}

			// ulozim soubory ktere jsou ve files
			$img_data = $this->save_img($files, $image_class);
			if(is_array($img_data) && count($img_data) > 0)
				$data =  array_merge($data, $img_data);
		}

		// echo json_encode($properties);

		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check["update"] =$this->update($data["id"], $data);

			if ($check) {

				return $check;
			}
		}

		return false;
	}

	// do tabulky categories by se chtelo pripojovat jen v modelo categorie
	// public function get_one_cat($data)
	// {

	// 	$query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
	// 	$result = $this->get_row($query, $data);
		
	// 	return $result;
	// }

	public function make_table($table_setup = [
		'title_table' => "sliders",
		'add_new' => "",
		'header' => 'header',
		'header1' => 'header1',
		'text' => 'text',
		'link' => 'link',
		'disabled' => [
				[
					"col_name" => "status",
					"db_col" => "disabled"
				],
			],
		'image' => [
			"image",
			"image1"
			],
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

		return make_table($rows, $table_setup);
	}
}