<?php
session_start();
require_once "uzivatel.php";

$report = [];

//uzivatel kliknul na logout
if (array_key_exists("logout", $_GET)) {
	unset($_SESSION["jePrihlasen"]);
	if(array_key_exists("jePrihlasen", $_SESSION)) {
		$report["chyby"]["chybaOdhlaseni"] = "Uzivatel se neodhlásil{$_SESSION["jePrihlasen"]["jmeno"]}";
	}else {
		$report["odhlasen"] = "";
	}

	echo json_encode($report);
}