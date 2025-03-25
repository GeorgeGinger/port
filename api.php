<?php
session_start();

if($_SERVER["SERVER_NAME"] == "localhost") {
	define("DBNAME", "mycompany");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBTYPE", "mysql");
	define("DBHOST", "localhost");
}else {
	define("DBNAME", "mycomp-saunaklub");
	define("DBUSER", "mycomp-saunaklub");
	define("DBPASS", "4WYSgNu74PXB");
	define("DBTYPE", "mysql");
	define("DBHOST", "portfolio.saunaklubslany.cz");
}

$database_name = DBNAME;
$table = "employees";
$primary_key = "id";
// $database_name = "mycompany";
// $table = "employees";
// $primary_key = "id";

// connect to the database
if(!$con = mysqli_connect(DBHOST, DBUSER, DBPASS, $database_name)) {
	die("failed to connect");
};

$primary_key = get_primary_key($table, $con);

// read the input source
$data = file_get_contents("php://input");
// convert the string to an object
$OBJ = json_decode($data);

// check if its an object
if(is_object($OBJ)) {

	// set data type
	$info = (object)[];
	$info->data_type = $OBJ->data_type;

	if($OBJ->data_type == "read") {

		$arr = array();

		// read from the database
		$query = "select * from $table order by $primary_key desc";
		$result = mysqli_query($con, $query);
		if($result) {
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_assoc($result)) {
					// konvertuje pole na objekt
					$arr[] = (object)$row;
					}

					$info->data = $arr;
					// cokoli echujeme objevi se v souboru index
					echo json_encode($info);
			}
		}

	}else if($OBJ->data_type == "prepareNewEmployee") {
		$arr = array();

		// read from the database
		$query = "select * from $table order by $primary_key desc";
		$result = mysqli_query($con, $query);
		if($result) {
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_assoc($result)) {
					// konvertuje pole na objekt
					$arr[] = (object)$row;
					}

					$info->data = $arr;
					// cokoli echujeme objevi se v souboru index
					echo json_encode($info);
			}
		}

	}else if($OBJ->data_type == "save") {

		if(is_array($OBJ->data[0]) && count($OBJ->data[0]) > 0) {

			foreach ($OBJ->data[0] as $row) {

				$query = "update $table set ";
				$primary_key_value = "";

				foreach ($row as $key => $value) {
					if($key == $primary_key) {
						$primary_key_value = $value;
					}else {
						$query .= $key."='".mysqli_real_escape_string($con, $value)."',";
					}
				}

				$query = trim($query,",");
				$query .= " WHERE $primary_key = '$primary_key_value' limit 1";

				// print_r($query);

				$result = mysqli_query($con, $query);

			}
		}

		if(is_array($OBJ->data[1]) && count($OBJ->data[1]) > 0) {


			$column_names = array_keys(get_object_vars($OBJ->data[1][0]));

			$query = "INSERT INTO $table (";
			foreach ($column_names as $column_name) {
				// if($column_name != $primary_key) {
				$query .= "$column_name, ";
				// }
			}
			$query = trim($query,", ");
			$query .= ") VALUES (";

			foreach ($OBJ->data[1] as $row) {
				foreach ($row as $column_name => $value) {
					if($column_name != $primary_key) {
						$query .= "'".mysqli_real_escape_string($con, $value)."', ";
					}else {
						$query .= "NULL, ";
					}
				}
			}
				$query = trim($query,", ");
				$query .= ")";
		
				// print_r($query);

				$result = mysqli_query($con, $query);
			
		}

		echo json_encode($info);
	}else if($OBJ->data_type == "delete") {

		$column_names = array_keys(get_object_vars($OBJ->data[0]));

		foreach ($OBJ->data as $value) {

			if(in_array($primary_key, $column_names)) {
				// read from the database
				$query = "DELETE FROM $table WHERE $primary_key=".mysqli_real_escape_string($con, $value->{$primary_key});
				$result = mysqli_query($con, $query);
			}
		}
		echo json_encode($info);
	}
}

function get_primary_key($table, $con) {
	// determin primary key
	$query = "show columns from $table";
	$result = mysqli_query($con, $query);
	if($result) {
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_assoc($result)) {
				
				if($row['Key'] == "PRI" && $row["Extra"] == "auto_increment"){
					return $row['Field'];
				}
				}
		}
	}
	return "id";
}
