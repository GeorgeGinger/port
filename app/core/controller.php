<?php

 class Controller {

	public function view($path, $data = []) {
		

		// pri zobrazovani karet vyrobku prijde z databaze objekt prevedeme ho na pole abych mohl pridavat settings o par radek pozdeji
		if(is_object($data)) {
			$data = get_object_vars($data);
		}

		// nacteni dat z tab settings a vytvoreni globalnich promennych
		if(is_array(Settings_global::$SETTINGS))
		foreach(Settings_global::$SETTINGS as $value) {
			$data[$value->setting] = $value->setting_value;
		}

		$styles	= $this->load_model("styles");
		$data["styles"] = $styles->findAll();

		// volba stylu
		if(!isset($_SESSION["style"])) {
			$_SESSION["style"] = 1;
		}

		if(array_key_exists("style", $_GET)) {
			$_SESSION["style"] = $_GET["style"];
		}

		// globalni promenne pro shop-menu v headru
		$shop_menu = $this->load_model("shop_menu");
		$data["shop_menu"] = $shop_menu->query("SELECT shelf,type,class,url FROM $shop_menu->table WHERE style_id=:style_id ORDER BY shelf_order", ["style_id"=>$_SESSION["style"]]);
		
		// globalni promenne pro main-menu v headru
		$main_menu = $this->load_model("main_menu");
		$data["main_menu"] = $main_menu->query("SELECT shelf,type,class,url FROM $main_menu->table WHERE style_id=:style_id ORDER BY shelf_order", ["style_id"=>$_SESSION["style"]]);
		
		// globalni promenne pro main-menu v headru
		

		// show($data);

		if(is_array($data) && !empty($data))
		{
			extract($data);
		}

		if(file_exists("../app/views/" . THEME .$path . ".php")) {
			include "../app/views/" . THEME . $path . ".php";
		} else {
			include "../app/views/" . THEME . "_404.php";
		}
	}

	public function load_model($model) {

		if(file_exists("../app/models/" . strtolower($model) . ".class.php")) {

			include_once "../app/models/" . strtolower($model) . ".class.php";
			return $a = new $model();
		}

		return false;
	}

 }