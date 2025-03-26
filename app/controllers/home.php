<?php 

// kontrola zdali byla konstanta ROOTPATH nadefinovana v index.php pokud ne vypise se hlaska 
// zamezi prisupu k souboru primo pres adresni radek
// pridame do kazdeho souboru do ktereho chceme zamezit pristup

defined('ROOTPATH') OR exit('Access Denied!');
/**
 * home class
 */
class Home extends Controller
{

	public function index()
	{

		$vzkazy = $this->load_model("vzkazy");

		$data["vzkazy"] = $vzkazy->getAll(["disabled" => 1]);

		$this->view('home/home.view', $data);
	}

}
