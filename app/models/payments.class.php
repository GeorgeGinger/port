<?php

class Payments
{
	use Model;
	
	protected $table = 'payments';

	protected $allowedColumns = [
		'date',
		'trans_id',
		'raw',
		'event_type',
		'amount',
		'status',
		'order_id',
		'first_name',
		'last_name',
		'email',
		'payer_id',
	];
	
	public function validate($data) {

		$_SESSION["error"] = "";

		if(!is_object($data)) {
			$_SESSION["error"] .= "fce edit product \$data must be a type of array or object";
			return;
		}else {
			$arr = array();

			// $arr["trans_id"] 		= $data->id;
			// $arr["event_type"]  = $data->event_type;
			// $arr["amount"] 		= $data->resource_inits[0]->amount_value;
			// $arr["descroption"] = $data->resource_inits[0]->description;
			// $arr["status"] 		= $data->resource->status;
			// $arr["first_name"]  = $data->resource->payer->name->given_name;
			// $arr["last_name"] 	= $data->resource->payer->name->surename;
			// $arr["email"] 		= $data->resource->payer->email_address;
			// $arr["payer_id"] 	= $data->resource->payer->payer_id;
			// $arr["summary"] 	= $data->summary;
			// $arr["raw"]		 	= $data;

			$arr["trans_id"] 		= "1";
			$arr["raw"]		 	= "dfsfsd"; 
			$arr["event_type"]  = "dfsfsd";
			$arr["amount"] 		= 10;
			$arr["status"] 		= "dfsfsd"; 
			$arr["order_id"] 	= "dfsfsd"; 
			$arr["first_name"]  = "dfsfsd"; 
			$arr["last_name"] 	= "dfsfsd"; 
			$arr["email"] 		= "dfsfsd"; 
			$arr["payer_id"] 	= "dfsfsd"; 
			$arr["summary"] 	= "dfsfsd"; 
			$arr["date"] 		= date("Y-m-d H:i:s"); 
			

		}
				
		if(!isset($_SESSION["error"]) || $_SESSION["error"] == "") {

			return $arr;

		}
		
		return false;
	}

	public function total_payment() {
		// celkovy soucet prijatych plateb
		return $this->query("SELECT SUM(amount) AS payment_total FROM payments")[0]->payment_total;
	}

}