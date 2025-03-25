<?php
session_start();
require_once "./uzivatel.php";

$report = [];

//zpracovani prihl. formulare
//uzivatel kliknul na login
if(array_key_exists("prihlaseni", $_GET)) {
    $userName = $_GET["prihlaseni"]["userName"];
    $userHeslo = $_GET["prihlaseni"]["userHeslo"];
	$uzivatel = new Uzivatel($userName, $userHeslo);
	//var_dump($zadaneJmeno);
	if ($uzivatel->login()) {
		//udaje jsou spravne prihlasime ho
		//na hodnote mi nezalezi jde mi jen o to, aby tam byl ten klic "jePrihlasen"
		$_SESSION["jePrihlasen"] = ["jmeno" => $userName, "heslo" => $userHeslo];
		$_SESSION["jmeno"] = $userName;
		$_SESSION["heslo"] = $userHeslo;
		$report["jePrihlasen"] = "";
	} else {
		$report["chyby"]["chybyPrihlaseni"] = "{$_SESSION["jePrihlasen"]["jmeno"]} Zadali jste spatne jmeno nebo heslo";
	}

	echo json_encode($report);

}
