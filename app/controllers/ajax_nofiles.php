<?php

class Ajax_nofiles extends Controller
{

	public function index() {

		$_SESSION["error"] = "";

		// show($_POST);
		// show($_FILES);

		// prijmuti dat zaslanych ajaxem podle zpusobu jakym je odeslano
		if (count($_POST) > 0) {
			$data = (object) $_POST;
		} else {
			$data = file_get_contents("php://input");
		}

		$data->data  = json_decode($data->data);
		$image_class = $this->load_model("image");

		// show($data->model);

		if(isset($data->model)) {
			$model = $this->load_model($data->model);
		}else if(isset($data->core)) {
			$model = new $data->core;
			$data->model = $data->core;
		}
		

		if (is_object($data) && isset($data->data_type)) {

			switch ($data->data_type) {
				case "add_row":
					// add new model
						$check = $model->add_row($data->data, $_FILES, $image_class);
					
					$arr["data_type"] = "add_row";

					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] =  $data->model." added successfully";
					break;

				case "delete_row":
					// delete model
					$check = $model->delete($data->data->id);
					$arr["data_type"] = "delete_row";

					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] =  $data->model." was deleted";
					break;

				case "edit_row":
					// edit existing model
							$check = $model->edit($data->data, $_FILES, $image_class);
						
					$arr["data_type"] = "edit_row";

					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] = $data->model." was edited";
					break;

				case "refresh_table":
					$check = "";
					$arr["data_type"] = "refresh_table";

					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] = $data->model." was refreshed";
					break;

				case "change_status_row":
					// change_status of the model
					$check = $model->update($data->data->id, $data->data);
					$arr["data_type"] = "change_status_row";

					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] = "Status ". $data->model. " was changed";
					break;

				case "change_status_player":
					// change_status of the model
					
					$check = $model->toKill($data);
					$arr["data_type"] = "change_status_row";
				
					if (!(isset($_SESSION["error"]) && $_SESSION["error"] != ""))
						$arr["message"] = "Status ". $data->model. " was changed";
					break;
			}

			if (isset($_SESSION["error"]) && $_SESSION["error"] != "") {
				// pokud je error doplni se zbyvajici udaje do zpravy
				$arr["message"] = $_SESSION["error"];
				$_SESSION["error"] = "";
				$arr["message_type"] = "error";
				$arr["data"] = $data->data;

			} else {
				// vse probehlo v pořádku
				$arr["message_type"] = "info";
				$arr["check"] = $check;
				$arr["data"] = $model->make_table();
			}

			// odeslani dat nazpet do view
			echo json_encode($arr);

		}
	}
}
