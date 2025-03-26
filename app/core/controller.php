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
		
		$sauna_text = $this->load_model("sauna_text");
		$sauna_text->order_column = "shelf_order";
		$saunaAlltext = $sauna_text->where(["style_id"=>$_SESSION["style"], "disabled"=>1]);
		if(is_array($saunaAlltext)) {
			foreach($saunaAlltext as $key => $value) {
			$data[$value->place][$key] = $value;
			}
		}
		
		// globalni promenne pro main-menu v headru
		$footer_menu = $this->load_model("footer_menu");
		$data["footer_down_left"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place AND type=:type ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_down_left", "type"=>"parapgaph"]);
		$data["footer_down_right"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place AND type=:type ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_down_right", "type"=>"ancor"]);
		$data["footer_down_right_text"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place AND type=:type ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_down_right", "type"=>"ancor_text"]);
		$data["service_menu"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"service"]);
		$data["policies_menu"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"policies"]);
		$data["about_menu"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"about_shoper"]);
		$data["footer_logo"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_logo"]);
		$data["logo_paragraph"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_logo_popis"]);
		$data["img_text"] = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"footer_img_popis"]);
		$sidebar = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"sidebar"]);
		$index_shop = $footer_menu->query("SELECT shelf,type,class,url, place FROM $footer_menu->table WHERE style_id=:style_id AND place=:place ORDER BY shelf_order", ["style_id"=>$_SESSION["style"], "place"=>"index_shop"]);

		// show($sidebar);

		if(is_array($sidebar)) {
			foreach($sidebar as $value) {
				$data[$value->type] = $value;
					// show($data[$value->type]);
			}
		}

		if(is_array($index_shop)) {
			foreach($index_shop as $value) {
				$data[$value->type] = $value;
					// show($data[$value->type]);
			}
		}

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