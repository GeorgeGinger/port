<?php

// pro vypisy pri ladeni programu
function show($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

// jeste jsem nepouzil
function check_error() {

	if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {

		echo $_SESSION['error'];
		unset($_SESSION["error"]);
	}
}

// escapovani hodnot pred ulozenim do databaze
function esc($data) {

return	addslashes($data);
}

function redirect($link) {

	header("Location: ".ROOT.$link);
	die;
}

// formatovani cisel
function nF($num, $unit = "") {

	$num1 = number_format($num, 2, ".", " ");
	$num_arr = explode(".", $num1);
	if($num_arr[1] == 0 ) {
		$num = number_format($num, 0, ".", " ");
	}else {
		$num = number_format($num, 2, ".", " ");
	}
	$num .= " ".$unit;
	return $num;
}

/** displays input values after a page refresh **/
function old_checked(string $key, string $value):string
{

	// show($key);
	// show($value);

  if(isset($_POST[$key]))
  {
    if($_POST[$key] == $value){
      return ' checked ';
    }
  }
  
  if(isset($_GET[$key]))
  {
	if(is_array($_GET[$key])) {

		foreach($_GET[$key] as $get_value) {
			if($get_value == $value){
				return ' checked ';
			  }
		}
	}else {
		if($_GET[$key] == $value){
			return ' checked ';
			}
	}
    
  }

  return '';
}

// vraceni hodnoty do formulare
function old_value(string $key, mixed $default = "", string $mode = 'post'):mixed
{
	$POST = ($mode == 'post') ? $_POST : $_GET;
	if(isset($POST[$key]))
	{
		return $POST[$key];
	}

	return $default;
}

// prida do zvoleneho radku option atribut selected 
function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'):mixed
{
	$POST = ($mode == 'post') ? $_POST : $_GET;
	if(isset($POST[$key]))
	{
		if($POST[$key] == $value)
		{
			return " selected ";
		}
	}else

	if($default == $value)
	{
		return " selected ";
	}

	return "";
}

function str_to_url($url) {
	
	$paretn 		= ['/~[^\\pL0-9_]+~u/',"/ /","/\,/","/\./","/ě/","/š/","/č/","/ř/","/ž/","/ý/","/á/","/í/","/é/","/ů/","/ú/","/Ě/","/Š/","/Č/","/Ř/","/Ž/","/Ý/","/Á/","/Í/","/É/","/Ů/","/Ú/"];
	$replacements 	= 				  ["-", "-" , "-" , "-" , "e" , "s" ,"c","r","z","y","a","i","e","u","u","e","s","c","r","z","y","a","i","e","u","u"];
	
	$url = preg_replace($paretn, $replacements, $url);
	$url = trim($url, "-");
	$url = strtolower($url);
	$url = preg_replace('~[^-a-z0-9_]+~', '', $url);
	return $url;

	// $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	// $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	// $url = trim($url, "-");
	// $url = iconv("utl-8", "us_ascii//TRANSIT", $url);
	// $url = strtolower($url);
	// $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
	// return $url;
}

function is_payd($order) {

	$arr["amount"] = $order->total;
	$arr["order_id"] = $order->id_order; 

	$cont = new Controller();
	$payments = $cont->load_model("payments");
	$payments = $payments->first($arr); 

	if(is_object($payments)) {
		return "<button class='btn btn-success btn-sm'>Paid</button>";
	}

	return "<button class='btn btn-danger btn-sm'>Not Paid</button>";
}
