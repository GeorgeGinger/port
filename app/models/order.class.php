<?php

class Order
{

	use Model;
	protected $table = 'orders';

	public $errors = array();

	protected $allowedColumns = [
		'user_url',
		'street',
		'total',
		'country',
		'city',
		'zip',
		'tax',
		'shipping',
		'date',
		'sessionid',
		'phone'
	];

	public function validate($POST)
	{

		$this->errors = array();

		foreach ($POST as $key => $value) {
			if ($key == "country") {
				if ($value == "" || $value == "-- Country --") {
					$this->errors[] = "Pleace enter a valid country";
				}
			}

			if ($key == "city") {
				if ($value == "" || $value == "-- State / Province / Region --") {
					$this->errors[] = "Pleace enter a valid city";
				}
			}

			if ($key == "street") {
				if (empty($value)) {
					$this->errors[] = "Pleace enter a valid address";
				}
			}

			if ($key == "zip") {
				if (empty($value)) {
					$this->errors[] = "Pleace enter a valid zip code";
				}
			}

			if ($key == "phone") {
				if (empty($value)) {
					$this->errors[] = "Pleace enter a valid phone";
				}
			}
		}
	}

	public function save($POST, $user_url, $sessionid)
	{

		// show($sessionid);
		// show($user_url);
		// show($POST);
		// show($products);

		if (count($this->errors) > 0) {
			return;
		}

		$data['user_url'] = $user_url;
		$data['street'] = $POST["street"];
		$data['total'] = $POST["subtotal_cart_price"];
		$data['zip'] = $POST["zip"];
		$data['country'] = $POST["country"];
		$data['city'] = $POST["city"];
		$data['tax'] = 0;
		$data['shipping'] = 0;
		$data["date"] = date("Y-m-d H:i:s");
		$data['sessionid'] = $sessionid;
		$data['phone'] = $POST["phone"];

		// show($data);
		$this->insert($data);

	}

	public function make_table($rows, $table_setup)
	{

		if (is_array($rows)) {
			$table_string = '<table class="table table-striped table-advance table-hover">
			<h4><i class="fa fa-angle-right"></i> Orders </h4>
			<thead>';

			$table_string .= '<tr>';
			foreach ($table_setup as $key_setup => $value) {
				if ($key_setup == "anchor") {
					$table_string .= '<th>' . ucfirst($key_setup) . '</th>';
				} else if($key_setup == "title_table"){

				} else {
					$table_string .= '<th>' . ucfirst($value) . '</th>';
				}

			}
			$table_string .= '<th> ... </th></tr></thead>
			<tbody id="table_body" onclick="show_dateils(event)" style="cursor: pointer;">';



			foreach ($rows as $row) {

				$table_string .= '<tr style="position: relative;">';
				$row_key = array_keys(get_object_vars($row));
				foreach ($table_setup as $key => $column) {
					if (in_array($key, $row_key)) {

						$table_string .= '<td class="">' . $row->$key . '</td>';
					} else if ($key == "anchor") {
						$table_string .= '<td class=""><a href="' . ROOT . 'profile/' . $row->user_url . '" target="_blank">' . $column["a_name"] . '</a></td>';
					} else if ($key == "status") {
						$table_string .= '<td class="">nezaplaceno</td>';
						// $table_string .= '<td class="">'.is_payd($row).'</td>';
					}
				}
				$table_string .= '<th><i class="fa fa-arrow-down"></i><div class="js_order_details details hide"><div class="close">close</div>' . $this->make_table_details($row->id_order) . '</div></th></tr>';
			}

			$table_string .= '</tbody>
			</table>';

			return $table_string;
		}
		return false;

	}

	public function make_table_details($id)
	{
		$query = "SELECT * FROM order_details WHERE order_id=:order_id";
		$rows = $this->query($query, ["order_id" => $id]);

		$table_setup = [
			'description' => 'description',
			'qty' => 'qty',
			'price' => 'price',
			'total' => 'total',
		];

		if (is_array($rows)) {
			$table_string = '<table class="table table-striped table-advance table-hover">
			<h4><i class="fa fa-angle-right"></i> Orders </h4>
			<thead>';

			$table_string .= '<tr>';
			foreach ($table_setup as $value) {
				$table_string .= '<th>' . ucfirst($value) . '</th>';
			}
			$table_string .= '</tr></thead>
			<tbody id="table_body" style="cursor: pointer;">';



			foreach ($rows as $row) {

				$table_string .= '<tr style="position: relative;">';
				$row_key = array_keys(get_object_vars($row));
				foreach ($table_setup as $key => $column) {
					if (in_array($key, $row_key)) {
						$table_string .= '<td>' . $row->$key . '</td>';
					}
				}
				$table_string .= '</tr>';
			}

			$table_string .= '</tbody>
		</table>';

			return $table_string;
		}

		return false;
	}
}