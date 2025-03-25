<?php
require "./pripojeni.php";
class Uzivatel{
	private $jmeno;
	private $heslo;
	private $datum;

	function __construct($argJmeno, $argHeslo){
		$this->jmeno = $argJmeno;
		$this->heslo = $argHeslo;
		$this->datum = date("Y-n-j");
	}
	function ulozDoDatabaze(){
		//nalezeni opakujiciho se jmena nebo hesla
		$prikaz = $GLOBALS["db"]->prepare("SELECT * FROM hodinysetup WHERE uzivatel=? AND heslo=?");
		$prikaz->execute(array( $this->jmeno, $this->heslo));
		$nalezeneJmenoHeslo = $prikaz->fetchAll();
		// heslo ani jmeno nenalezeno muzu ho ulolzit
		if ($nalezeneJmenoHeslo == NULL){
		$prikaz = $GLOBALS["db"]->prepare("INSERT INTO hodinysetup (uzivatel, heslo) VALUES (?, ?)");
		$prikaz->execute(array( $this->jmeno, $this->heslo));	
		return true;
		} else {
			return false;
		}
	}
	function login(){
		//nalezeni opakujiciho se jmena nebo hesla
		$prikaz = $GLOBALS["db"]->prepare("SELECT * FROM hodinysetup WHERE uzivatel=? AND heslo=?");
		$prikaz->execute(array( $this->jmeno, $this->heslo));
		$nalezeneJmenoHeslo = $prikaz->fetchAll();
		//var_dump($nalezeneJmenoHeslo);
		if ($nalezeneJmenoHeslo == NULL){
		return false;
		} else {
			return true;
		}
	}

}