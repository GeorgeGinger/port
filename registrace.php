<?php

require_once "./uzivatel.php";

$report = [];

//registrace uzivatel
if (array_key_exists("registrace", $_GET)) {
	$jmeno = $_GET["registrace"]["userName"];
	$heslo = $_GET["registrace"]["userHeslo"];

	//budeme validovat
	//délka znaku musí být více než tři znaky
	//mb_strlen počítá znaky s diakritikou jako jeden znak na rozdíl od strlen
	if (mb_strlen($jmeno) < 3) {
		$report["chyby"]["chybaJmeno"] = "Vaše jmeno: $jmeno je moc krátké!";
	}
	//kontrola hesla musí mít více než tři znaky
	if (mb_strlen($heslo) < 3) {
		$report["chyby"]["chybaHeslo"] = "Vaše heslo: $heslo je moc kratké!";
		
	}
	// pokud nevznikly do ted zadne chyby
	if(count($report) == 0) {
		$uzivatel = new Uzivatel($jmeno, $heslo);
		if ($uzivatel->ulozDoDatabaze()) {
			$report["zaregistrovan"] = "Registrace proběhla úspěšně";
		} else {
			$report["chyby"]["chybaRegistrace"] = "$jmeno Registrace se nezdařila zadejte jiné jméno a heslo";
		}
	}
	
	echo json_encode($report);
	// // $test = "roman";
	// $test = array("petr","pavel","roman");
	// echo json_encode($test);
	
}