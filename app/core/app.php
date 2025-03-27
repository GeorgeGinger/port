<?php

Class App extends Settings_global
{
	
	protected $controller = "home";
	protected $method = "index";
	protected $params;

	function __construct() {
		
		// nactou se hodnoty z tabulky settings, do databaze by se melo pristupovat jen jednou
		parent::__construct();

		$url = $this->parseURL();

		if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {

			$this->controller = strtolower($url[0]);
			unset($url[0]);
		}else {
			
			$this->controller = "_404";
			unset($url[0]);

		}

		require "../app/controllers/" . $this->controller . ".php";
		
		$this->controller = new $this->controller;

		if (isset($url[1])) {
			$url[1] = strtolower($url[1]);
			if(method_exists($this->controller, $url[1]) && is_callable([$this->controller, $url[1]])) {

				$this->method = $url[1];

				unset($url[1]);

			}
		}

		$this->params = (count($url) > 0) ? array_values($url) : [null];

		// nevim proc jsme to nepouzili 
		// show(array_values($url));

		call_user_func_array([$this->controller, $this->method], $this->params);
	}
	private function parseURL() {
		$url = isset($_GET["url"]) ? $_GET["url"] : "home";
		return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));
		}
}