<?php

class Signup extends Controller {

	public function index() {
		
		$user = $this->load_model("user");
		$beforesignup = $this->load_model("beforesignup");
		$data["page_title"] = "Signup";

		// show($_POST);

		// kdyz projde validaci odesli email a redirectuj na login
		if(array_key_exists("submit_signup", $_POST)) {

			$validate = $user->validate($_POST);

			if(is_array($validate)) {


				// ulozi data nez dojde k jijich overeni pres email
				$beforesignup->add($validate);

				$_SESSION["post_signup"] = $_POST;

				$settings = new Settings_global;
				// nacte emailovou adresu ze settingu
				$email_arr = $settings->where(["setting"=>"email"]);
				if(is_array($email_arr)) {
					//replace with your email
					$email_from = $email_arr[0]->setting_value;
				}

				$email_to = $_POST["email"];
				$rekapitulaceObjednavky = email_temp_overeni($validate);

				$mail = new PHPMailer\PHPMailer\PHPMailer(true);
				$mail->CharSet = "utf-8";
				$mail->setFrom($email_from, "saunaklubslany");
				$mail->addAddress($email_to);
				// $mail->addAttachment("./objednavky/faktury/".$data["last_order"]->id."_faktura.pdf", 'new.pdf');
				$mail->isHTML(true);
				$mail->Subject = "Ověření emailu";
				$mail->Body = $rekapitulaceObjednavky;

				$mail->send();

				// mela by se zobrazit stranka ze na vas email byla odeslano overeni 
				header("location: " .ROOT. "login");
				die;
			}
		}

	// problem s overenim musi probehnout na stejnem prohlizeco jako odeslani signup
		if(array_key_exists("submit_overeni", $_GET)) {

			$before_user = $beforesignup->check_user_url($_GET["submit_overeni"]);

			if($before_user) {
				$validate = $user->validate($before_user);

				if(isset($validate) && is_array($validate)) {
					$user->signup($validate);
					header("Location:" . ROOT . "login");
					die;
				}
			
			}else {
				$_SESSION["error"] = "Oveření emailem selhalo";
				header("Location:" . ROOT . "signup");
				die;
			}
		}

		$this->view("signup", $data);
	}
	
}
