<?php

class Checkout extends Controller {

	public function index() {
	
		$User = $this->load_model("User");
		$image_class = $this->load_model("image");
		// $product = $this->load_model("product");
		$product = $this->load_model("product_prodej");
		$order = $this->load_model("order");

		// kontrola prihlaseneho uzivatele
		$user_data = $User->check_login(true, ["admin", "customer"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		$data["products"] = [];
		$data["subtotal_cart_price"] = 0;
		$data["total_cart_price"] = 0;
		$data["page_title"] = "Checkout";

		$prod_ids = array();

		// vyhledani productu z kosiku v databazi a opetovne prohledani SESSION["cart"] kvuli prirazeni quantity
 		if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {

			// vytvori pole ze sloupce id
			$prod_ids = array_column($_SESSION["cart"], "id");

				foreach($prod_ids as $prod_id) {

					$product_row = $product->getOne(["id"=>$prod_id]);

					if(is_object($product_row)) {

						foreach($_SESSION["cart"] as $key => $prod) {

							if($prod_id == $prod["id"]) {
								
								$product_row->qty = $_SESSION["cart"][$key]["qty"]; 
								$product_row->image = $image_class->get_thumb_post($product_row->image);
								// celkova cena jednotlivych polozek
								$product_row->item_total_price = $product_row->cenaProdej * $product_row->qty;
								$data["products"][] = $product_row;
								break;
							}
							
						}
						// celkova cena kosiku bez dopravy
						$data["subtotal_cart_price"] += $product_row->item_total_price;
					}
				}
		}

		if(is_array($data["products"])){
			// zmena poradi prvku pole
			rsort($data["products"]);
		}
		$_SESSION["data_product"] = $data["products"];
		$_SESSION["subtotal_cart_price"] = $data["subtotal_cart_price"];

		
		// aby se nestratily data pri refreshy a predvyplnil se formular pokud se na stranku opet vratime
		// stane se pokud se na stranku opetovne vratim
		if(isset($_SESSION["POST_DATA"]) && count($_POST) == 0) {
			// data vracim do $_POST abych mohl pouzivat fci old_select a old_value ve formulari
			$_POST = $_SESSION["POST_DATA"];
			
			$data["POST_DATA"] = $_SESSION["POST_DATA"];
		}

		
		// stane se pouze pokud kliknu na continue
		if(count($_POST) > 0 && !isset($_POST["subtotal_cart_price"])){
			// show($_POST);

			$POST = $_POST;

			// pridani ceny kosiku bez dane a dopravy
			$POST["subtotal_cart_price"] = $data["subtotal_cart_price"];

			$order->validate($POST);

			$data["errors"] = $order->errors;
			// vraceni hodnot do formulare
			$data["POST_DATA"] = $POST;
			if(count($order->errors) == 0) {
				//pouzije se ve funkci summary 
				$_SESSION["POST_DATA"] = $POST;
				header("Location: ".ROOT."checkout/summary");
				die;
			}
		}

		$data["total_cart_price"] = 0;

		$this->view("checkout", $data);

	}

	public function summary() {

// show("summary");

		$User = $this->load_model("User");
		
		$data["page_title"] = "Checkout Summary";

	// kontrola pripojeni uzivatele
		$user_data = $User->check_login(true, ["admin", "customer"]);

		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		if(isset($_SESSION["POST_DATA"])) {
			$_SESSION["summary"] = array_merge($_SESSION["POST_DATA"], (array)$data["user_data"]);
			$data["summary"] 	 = $_SESSION["summary"];
			
		}
			
		// nastane kdyz kliknu v summary na order
		if(array_key_exists("order", $_POST) && isset($_SESSION["POST_DATA"])) {
			
			$order = $this->load_model("order");
			
			// identifikace uzivatele
			// melo by se pouzit pokud by mohl objednavat i neprihlaseny uzivetel
			$sessionid = session_id();
			// show($sessionid);
			
			$user_url = "";
			if(isset($_SESSION["user_url"])) {
				$user_url = $_SESSION["user_url"];
			}

			$order->save($_SESSION["POST_DATA"], $user_url, $sessionid);
			
			// nalezne id posledni objednavky danneho uzivatele
			$data["last_order"] = $order->first(["sessionid" => $sessionid]);
			if(is_object($data["last_order"])) {
				foreach($data["last_order"] as $key=>$value) {
					$_SESSION["summary"][$key] = $value;
				}
			}
			// $_SESSION["summary"]["data["last_order"]"] = $data["last_order"];

			$order_details = $this->load_model("order_details");
			$order_details->save($_SESSION["data_product"], $data["last_order"]->id);
			
				unset($_SESSION["cart"]);
				
				header("Location: ".ROOT."checkout/pay");
				die;
		}

		// vytvoreni tabulky rekapitulace objednavky
		$table_setup = [
			'email' => 'email',
			'name' => 'Name',
			'last_name' => 'Last name',
			'street' => 'street',
			'city' => 'city',
			'country' => 'country',
			'zip' => 'p.s.č.',
			'phone' => 'phone',
			'message' => 'message',
			'title_table' => 'Summary',
			];

		if(isset($data["summary"]))
		$data["table_row1"] = make_table($_SESSION["summary"], $table_setup, "na_vysku");

		$table_setup = [
			
			'description' => 'description',
			'qty' => 'qty',
			'item_total_price' => 'total',
			'title_table' => 'Order',
			];

		if(isset($_SESSION["data_product"]))
		$data["table_row2"] = make_table($_SESSION["data_product"], $table_setup, "na_sirku");

		$this->view("checkout.summary", $data);
	}

	public function pay($data) {

		// show($data);

		$User = $this->load_model("User");
		$order = $this->load_model("order");

		$settings = new Settings_global;

		// kontrola prihlaseni uzivatele
		$user_data = $User->check_login(true, ["admin", "customer"]);
		if(is_object($user_data)) {
			$data["user_data"] = $user_data;
		}

		// nalezeni posledni objednavky uzivatele
		$data["last_order"] = $order->first(["user_url" =>$user_data->user_url]);

		// nacteni kodu banky pro rekapitulaci objednavky a tvorby qr codu
		$setting_bank_code = $settings->query("SELECT * FROM settings WHERE setting='bank_code'");
		if(is_array($setting_bank_code)) {
			$bank_code = $setting_bank_code[0]->setting_value;
		}

		// nacteni bankovniho uctu pro rekapitulaci objednavky a tvorby qr codu
		$setting_bank_account = $settings->query("SELECT * FROM settings WHERE setting='bank_account'");
		if(is_array($setting_bank_account)) {
			$data["bank_account"] = $setting_bank_account[0]->setting_value;
		}

		$company_name = $settings->query("SELECT * FROM settings WHERE setting='company_name'");
		$company_setting = $settings->query("SELECT * FROM settings");

		foreach($company_setting as $value) {
			$data["company_setting"][$value->setting] = $value->setting_value;
			// show($data["company_setting"]);
		}

		if(is_array($company_name)) {
			$company_name = $company_name[0]->setting_value;
		}

		if(isset($_SESSION["summary"]) && count($_SESSION["summary"])) 
			{

				$data["summary"] = $_SESSION["summary"];

				// paltebni udaje co se premeni na qr code 
				$qr_text["data"] = "SPD*1.0*ACC:CZ58".$data["company_setting"]["bank_code"].$data["company_setting"]["bank_account"]."*AM:{$_SESSION["summary"]["total"]}*CC:CZK*VS:{$data["last_order"]->id}*MSG:PLATBA ZA ZBOZI*RN:{$company_name}";
				$qr_text["order_id"] = $data["last_order"]->id;
				$qr_text["label"] = "cena: {$_SESSION["summary"]["total"]} kč";
				// fce preda dataURI qr codu a zaroveni ulozi qr code jako png na server
				$data["qr_code"] = qrCodeGenerator($qr_text);

				// email zakaznika
				$email_to = $data["summary"]["email"];
				$data["email_to"] = $data["summary"]["email"];

				// nacte emailovou adresu ze settingu
				$email_arr = $settings->where(["setting"=>"email"]);
				if(is_array($email_arr)) {
					//replace with your email
					$email_from = $email_arr[0]->setting_value;

					$data["email_from"] = $email_arr[0]->setting_value;
				}

				if(isset($_SESSION["data_product"]) && count($_SESSION["data_product"])) {
					$data["data_product"] = $_SESSION["data_product"];

					$rekapitulaceObjednavky = email_temp($data);
					$data["rekapitulaceObjednavky"] = email_temp($data);
				}

				// show($rekapitulaceObjednavky);


				// ulozeni rekapitulace v pdf
				$mpdf = new \Mpdf\Mpdf();
				$mpdf->WriteHTML($rekapitulaceObjednavky);
				// $mpdf->WriteHTML('<h1>áíčšěščŽáříčé</h1>');
				$content = $mpdf->Output('./objednavky/faktury/'.$data["last_order"]->id.'_faktura.pdf',"F");

				// odeslani rekapitulace objednavky zakaznikovi jako priloha je pripojeno pdf rekepitulace
				// qr code je soucasti emailu jako odkaz protoze jako data uri nefunguje v gmailu
				$mail = new PHPMailer\PHPMailer\PHPMailer(true);
				$mail->CharSet = "utf-8";
				$mail->setFrom($email_from, "saunaklubslany");
				$mail->addAddress($email_to);
				$mail->addAttachment("./objednavky/faktury/".$data["last_order"]->id."_faktura.pdf", 'new.pdf');
				$mail->isHTML(true);
				$mail->Subject = "Rekapitulace objednávky saunaklubslany";
				$mail->Body = $rekapitulaceObjednavky;

				$mail->send();

			}
			
		if(isset($_SESSION["POST_DATA"])) {
			unset($_SESSION["data_product"]);
			unset($_SESSION["POST_DATA"]);
			unset($_SESSION["summary"]);
		}

		$data["page_title"] = "Pay now";
		$this->view("checkout.pay", $data);
	}

}

