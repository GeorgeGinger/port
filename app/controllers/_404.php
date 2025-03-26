<?php 

// kontrola zdali byla konstanta ROOTPATH nadefinovana v index.php pokud ne vypise se hlaska 
// zamezi prisupu k souboru primo pres adresni radek
// pridame do kazdeho souboru do ktereho chceme zamezit pristup
defined('ROOTPATH') OR exit('Access Denied!');

class _404
{
	use Controller;
	
	public function index()
	{
		echo "404 Page not found controller";
	}
}
