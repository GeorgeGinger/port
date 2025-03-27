<?php

define("WEBSITE_TITLE", "MY SHOP");

if($_SERVER["SERVER_NAME"] == "localhost") {
	define("DBNAME", "nebudSam");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBTYPE", "mysql");
	define("DBHOST", "localhost");

	// nevim proc to delal tak slozite v promenne SERVER jsou podle me lepsi hodnoty, SERVER PORT nevim proc tam je ale v url zmizi
	$url =  $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . str_replace("index.php", "", $_SERVER["PHP_SELF"]).str_replace("url=", "", $_SERVER["QUERY_STRING"]);
	// $url = $_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].str_replace("index.php", "", $_SERVER["PHP_SELF"]).str_replace("url=", "", $_SERVER["QUERY_STRING"]);
}else {
	define("DBNAME", "nebuds-saunaklub");
	define("DBUSER", "nebuds-saunaklub");
	define("DBPASS", "oydhULdR2rKT");
	define("DBTYPE", "mysql");
	define("DBHOST", "nebudsam.saunaklubslany.cz");
	

	$url = 'http://nebudsam.saunaklubslany.cz/public/'.str_replace("url=", "", $_SERVER["QUERY_STRING"]);


}


define("THEME", "eshop/");

define("FULL_URL", $url);


define("DEBUG", true);
if(DEBUG) {
	ini_set("display_errors", 1);
}else {
	ini_set("display_errors", 0);
}
