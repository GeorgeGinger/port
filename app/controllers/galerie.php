<?php 

// kontrola zdali byla konstanta ROOTPATH nadefinovana v index.php pokud ne vypise se hlaska 
// zamezi prisupu k souboru primo pres adresni radek
// pridame do kazdeho souboru do ktereho chceme zamezit pristup

defined('ROOTPATH') OR exit('Access Denied!');
/**
 * galerie class
 */
class Galerie extends Controller
{
	

	public function index()
	{
		$data["stranka"] = "galerie";

		$this->view('home/galerie.view', $data);
	}

}
