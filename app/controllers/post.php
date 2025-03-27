<?php

class Post extends Controller {

	protected $class_name = "post";

	public function index($slug = "") {


		$User = $this->load_model("User");
		$blogs = $this->load_model("blogs");
		$image_class = $this->load_model("image");
		
		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["post"] = $blogs->first(["slug" => $slug]);

		if($data["post"]) {
				$blog_owner = $User->first(["user_url" => $data["post"]->user_url]);
			
				if($blog_owner) {
					$data["post"]->blog_owner = $blog_owner->name;
				}
				// show($data["blogs"][$key]->image);
				// $data["post"]->image = $image_class->get_thumb_post($data["post"]->image, 600, 300);
		}

		$data["show_search"] = false;

		if(is_object($data["post"])) {
			$data["page_title"] = "Post - ".$data["post"]->title;
		}else {
			redirect("_404");
		}
		
		$this->view("post", $data);
	}

}
