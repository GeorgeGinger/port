<?php 
// kontrola zdali byla konstanta ROOTPATH nadefinovana v index.php pokud ne vypise se hlaska 
// zamezi prisupu k souboru primo pres adresni radek
// pridame do kazdeho souboru do ktereho chceme zamezit pristup
defined('ROOTPATH') OR exit('Access Denied!');

Trait Controller
{

	public function view($name, $data = [])
	{
		if(!empty($data))
			extract($data);

		$filename = "./app/views/".$name.".view.php";
		if(file_exists($filename))
		{
			require $filename;
		}else{

			$filename = "./app/views/404.view.php";
			require $filename;
		}
	}
}