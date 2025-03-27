<?php

class Contact extends Controller {

	protected $class_name = "contact";

	public function index() {

		$data["errors"] = "nejsou";

		$User 	  = $this->load_model("User");
		$messages = $this->load_model("messages");
		$players  = $this->load_model("players");

		$settings = new Settings_global;
		
		$user_data = $User->check_login();

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$palyer_data = $players->check_login();
		if(is_object($palyer_data)) {
			$data["player_data"] = $palyer_data;
		}

		if(array_key_exists("submit_contact", $_POST)) {
			$POST = $_POST;
			$POST["date"] =  date("Y-m-d H:i:s");

			if($messages->validate($POST)) {
				$messages->insert($messages->validate($POST));

				$name       = @trim(stripslashes($POST['name'])); 
				$email_from = @trim(stripslashes($POST['email'])); 
				$subject    = @trim(stripslashes($POST['subject'])); 
				$message    = @trim(stripslashes($POST['message'])); 

				// nacte emailovou adresu ze settingu
				$email_arr = $settings->where(["setting"=>"email"]);
				if(is_array($email_arr)) {
					//replace with your email
					$email_to = $email_arr[0]->setting_value;
				}

				$mail = new PHPMailer\PHPMailer\PHPMailer(true);

				$mail->CharSet = "utf-8";
		
				$mail->setFrom($email_from, $name);
				$mail->addAddress($email_to);
		
				// $mail->addAttachment('./qrcode.png', 'new.jpg');
		
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = "
						<h1>$subject</h1>
						<div class='cisloObjednavky'>
						mesage: $message
						</div>
					";
			$mail->send();

				redirect("contact?success=true");
			}else {
				$data["error"] = $messages->error;
			}
		} 

		if(array_key_exists("success", $_GET)) {
			
		}
		
		$data["show_search"] = false;

		$data["page_title"] = "Contact";
		$this->view("contact", $data);
	}

}
