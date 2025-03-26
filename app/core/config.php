<?php

define("WEBSITE_TITLE", "MY SHOP");

if($_SERVER["SERVER_NAME"] == "localhost") {
	define("DBNAME", "sauna_mvc_4_1");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBTYPE", "mysql");
	define("DBHOST", "localhost");

	$url =  $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . str_replace("index.php", "", $_SERVER["PHP_SELF"]).str_replace("url=", "", $_SERVER["QUERY_STRING"]);
}else {
	define("DBNAME", "test-saunaklub");
	define("DBUSER", "test-saunaklub");
	define("DBPASS", "Lacwgvs84UN3");
	define("DBTYPE", "mysql");
	define("DBHOST", "test.saunaklubslany.cz");

	$url = 'https://test.saunaklubslany.cz/public/'.str_replace("url=", "", $_SERVER["QUERY_STRING"]);

}

define("THEME", "eshop/");

define("FULL_URL", $url);
define('APP_NAME', "Sauna Klub Slaný");

define("DEBUG", true);
if(DEBUG) {
	ini_set("display_errors", 1);
}else {
	ini_set("display_errors", 0);
}
