<?php

class Blog extends Controller {

	protected $class_name = "blog";

	public function index() {


		$User = $this->load_model("User");
		$blogs = $this->load_model("blogs");
		$image_class = $this->load_model("image");
		
		$user_data = $User->check_login(true, ["admin", "customer"]);

		// pagination variables
		$limit = 10;
		$offset = Page::get_offset($limit);
		$blogs->limit = $limit;
		$blogs->offset = $offset;


		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["blogs"] = $blogs->findAll();

		if(is_array($data["blogs"])) {
			foreach($data["blogs"] as $key => $value) {

				$blog_owner = $User->first(["user_url" => $data["blogs"][$key]->user_url]);

				if($blog_owner) {
					$data["blogs"][$key]->blog_owner = $blog_owner->name;
				}else {
					$data["blogs"][$key]->blog_owner = "";
				}

				// show($data["blogs"][$key]->image);
				$data["blogs"][$key]->image = $image_class->get_thumb_post($data["blogs"][$key]->image, 600, 300);
			}
		}

		$data["show_search"] = false;

		$data["page_title"] = "Blog";

		$this->view("blog", $data);
	}

}
