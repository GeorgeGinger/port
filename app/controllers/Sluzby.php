<?php 

// kontrola zdali byla konstanta ROOTPATH nadefinovana v index.php pokud ne vypise se hlaska 
// zamezi prisupu k souboru primo pres adresni radek
// pridame do kazdeho souboru do ktereho chceme zamezit pristup

defined('ROOTPATH') OR exit('Access Denied!');
/**
 * sluzby class
 */
class Sluzby
{
	use Controller;

	public function index()
	{

		$this->view('sluzby');
	}

}
