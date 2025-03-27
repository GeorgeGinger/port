<?php

//Main Model trait 

//misto extends pouzijem use uvnitr classy, protoze extends muzeme pouze jednu vec
// class Model extends Database
trait Model
{
	use Database;

	public $limit        = 100;
	public $offset       = 0;
	protected $order_type   = "desc";
	public $order_column 	= "id";
	public $errors       	= [];
	//vrati vsechny nalezene radky
	public function findAll()
	{

		$query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

		return $this->query($query);
	}
	public function where($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}
		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		//odriznuti koncoveho &&
		$query = trim($query, " && ");

		//:id znamena ze id je promenna za kterou se doplni data v execute
		$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		//spojeni obou poli
		$data = array_merge($data, $data_not);

		return $this->query($query, $data);
	}

	// hledany vyraz je i uprostred slova
	public function every_where($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "SELECT * FROM $this->table WHERE ";

		foreach ($keys as $key) {
			$query .= $key . " LIKE :" . $key . " && ";
		}
		foreach ($keys_not as $key) {
			$query .= $key . " != : " . $key . " && ";
		}

		//odriznuti koncoveho &&
		$query = trim($query, " && ");

		//:id znamena ze id je promenna za kterou se doplni data v execute
		$query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
		// show($query);
		//spojeni obou poli
		$data = array_merge($data, $data_not);

		return $this->query($query, $data);
	}
	
	//vrati jeden radek
	public function first($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}
		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		//odriznuti koncoveho &&
		$query = trim($query, " && ");

			//:id znamena ze id je promenna za kterou se doplni data v execute
			$query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
		
		//spojeni obou poli
		$data = array_merge($data, $data_not);

		// show($query);

			return $this->get_row($query, $data);

	}
	public function insert($data_unnone)
	{

		if(is_object($data_unnone)) {
			$data = get_object_vars($data_unnone);
		}else if(is_array($data_unnone)){
			$data = $data_unnone;
		}else {
			$_SESSION["error"] .= "fce edit ".$this->table." \$data must be a array or object, Model";
		}

		//remove unwanted data
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "INSERT INTO $this->table (" . implode(', ', $keys) . ") VALUES (:" . implode(', :', $keys) . ")";
		// echo $query;
		$this->query($query, $data);
		return false;

	}
	public function update($id, $data_unnone, $id_column = 'id')
	{

	// show($data_unnone);

		if(is_object($data_unnone)) {
			$data = get_object_vars($data_unnone);
		}else if(is_array($data_unnone)){
			$data = $data_unnone;
		}else {
			$_SESSION["error"] .= "fce edit ".$this->table." \$data must be array or object, Model";
			return;
		}

		//remove unwanted data
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}


		$keys = array_keys($data);
		$data[$id_column] = $id;
		$query = "UPDATE $this->table SET ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ', ');
		$query .= " WHERE $id_column = :$id_column";

		// show($query);

		$this->query($query, $data);

		return false;
	}
	public function delete_model($id, $id_column = 'id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column";

		$this->query($query, $data);

		return true;
	}
}