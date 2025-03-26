<?php

class Blogs
{
	use Model;
	protected $table = 'blogs';
	protected $allowedColumns = [
		'user_url',
		'title',
		'post',
		'image',
		'date',
		'slug',
	];

	public $error = "";

	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}
		
		$arr["user_url"] = $_SESSION["user_url"];
		$arr["title"] = ucwords(trim($data->title));
		$arr["post"] = ucwords(trim($data->post));
		$arr["id"] = $data->id;

		if (empty($arr["header"]) && !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ 0-9._\-,]+$/", trim($arr["title"]))) {
			$_SESSION["error"] .= "Please enter a valid title <br>";
		}

		if (empty($arr["header1"]) && !preg_match("/^[a-zA-ZěščřžňťďýáíéůúĚŠČŘŽŇŤĎÝÁÍÉÚŮ\n\r 0-9._\-,;?!\"]+$/", trim($arr["post"]))) {
			$_SESSION["error"] .= "Please enter a valid post <br>";
		}


		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			// vytvoreni slugu az pote co projde title validaci
			$arr["slug"] = str_to_url($data->title);
			if($this->first(["slug"=>$arr["slug"]])) {
				$arr["slug"] .= "-".rand(0,9999); 
			}

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
	
					$check["delete_blog_img"][$key] = $this->delete_img($value);
		
				}
			}
		}

		$check["delete_blog"] = $this->delete_model($id, $id_column);
		return $check;
	}

	public function add_row($data, $files = null, $image_class = null)
	{

		
		$data["date"] =  date("Y-m-d H:i:s");

		if($files != null) {
			$data['image'] = "";
			$img_data = $this->save_img($files, $image_class);

			if(is_array($img_data) && count($img_data) > 0) 
				$data =  array_merge($data, $img_data);
		}
		
		
		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check["blog"] = $this->insert($data);

			// show($blog_id);

			if ($check["blog"]) {
		

				return true;
			}
		}

		return false;
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

		// zalozi adresar pokud neexistuje
		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}
		// check for files
		if(isset($files)) {
			foreach ($files as $key => $img_row) {
				if ($img_row["error"] == 0 && in_array($img_row['type'], $allowed)) {
					if ($img_row['size'] < $size) {
						$destination = $folder . $image_class->generate_filename(60)."_blog_".$img_row["name"];
						move_uploaded_file($img_row["tmp_name"], $destination);
						$data[$key] = $destination;

						$image_class->resize_image($destination,$destination,320,320);
					} else {
						$_SESSION["error"] .= $key . " Is bigger than required size br>";
					}
				}else {
					$_SESSION["error"] .= "nepovolena koncovka souboru <br>";
				}
			}
		} else {
			$_SESSION["error"] .= "nezadan soubor img v blogs save_img  <br>";

		}

		show("save img");
		show($data);

		return $data;
	}

	public function create($data, $files, $image_class)
	{

		$data['image'] = "";
		$data["date"] =  date("Y-m-d H:i:s");
		$img_data = $this->save_img($files, $image_class);

		if(is_array($img_data) && count($img_data) > 0) 
			$data =  array_merge($data, $img_data);
		
		if (!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			$check = $this->insert($data);

			if ($check) {

				return true;
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

				return true;
			}
		}

		return false;
	}

	// do tabulky categories by se chtelo pripojovat jen v modelo categorie
	public function get_one_cat($data)
	{

		$query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
		$result = $this->get_row($query, $data);
		
		return $result;
	}

	public function make_table($table_setup = [
		'title_table' => "blogs",
		'add_new' => "",
		'title' => "title",
		'post' => 'post',
		'anchor_1' => [
			"column_name" => "user",
			// "a_name" => "",
			"a_name_dyn" => "user_name",
			"target" => "_blank",
			"url_0" => ROOT,
			"url_1" => "profile/",
			"url_2" => "user_url",
			"url_3" => ""
		],
		'image' => [
			'image',
			],
		'date' => 'date',
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

		if(is_array($rows)) {
			foreach ($rows as $key => $row) {
				$user = $this->query("SELECT * FROM users WHERE user_url=:user_url", ["user_url" => $row->user_url]);

				$name = is_array($user) ? $user[0]->name : "";

				$rows[$key]->user_name = $name;
			}
		}
		return make_table($rows, $table_setup);
	}

}