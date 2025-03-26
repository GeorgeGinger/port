<?php

class Beforesignup
{

	use Model;
	protected $table = 'beforesignup';
	protected $allowedColumns = [
		'user_url',
		'signup_data'
	];
	

	public function add($data=[])
	{
		// ulozeni signup formulare pred overovacim emailem
			$arr["user_url"] = $data["user_url"];
			$arr["signup_data"] = json_encode($data);

			$result = $this->insert($arr);

	}

	public function edit($data) {
		User::$user_type = $this->getOne(["id"=>$data["id"]])->rank;
		$check["update"] =$this->update($data["id"], $data);
	}

	public function delete($id, $id_column = 'id') {
		User::$user_type = $this->getOne([$id_column=>$id])->rank;
		$check = $this->delete_model($id, $id_column);
		return $check;
	}

	public function getOne($data) {
		return $this->first($data);
	}

	public function check_user_url($user_url) {

		$before_user = $this->getOne(["user_url" => $user_url]);

		
		if(is_object($before_user) && $before_user->user_url == $user_url) {

			$obj = json_decode($before_user->signup_data);
			// aby mohli projit udaje znovu validaci 
			$obj->password2 = $obj->password;

			return $obj;
		} 
		return false;
	} 

}