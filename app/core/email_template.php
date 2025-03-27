<?php

function email_temp($data = []) {
if(count($data) > 0) {

	// show($data);

	$html = '
	<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

				<style>

					body {
						font-family: "Times";
					}

					th {
						padding: 0.25rem 1rem;
					}

				</style>
			</head>

			<body>
				<h1>Rekapitulace objednávky</h1>

				<div class="cisloObjednavky">

				<table border="1">
					<tr>
						<th>id</th>
						<th>název</th>
						<th>cena/ks</th>
						<th>množství</th>
						<th>cena</th>
					</tr>
						<tr>
						<th></th>
						<th></th>
						<th>[kč]</th>
						<th>[ks]</th>
						<th>[kč]</th>
					</tr>
					';

				foreach ($data["data_product"] as $klic => $product) {
					$html .= '<tr>
						<td>'.$product->id.'</td>
						<td>'.$product->description.'</td>
						<td>'.nF($product->price).'</td>
						<td>'.nF($product->qty).'</td>
						<td>'.nF($product->item_total_price).'</td>
					</tr>
					';
				}

				$html .= '
					<tr>
						<td colspan="4">cena celkem</td><td>'.nF($data["summary"]["subtotal_cart_price"]).'</td>
					</tr>
				</table>

				<br>
				<div class="tabulky">
						<table>
							<tr>
								<td colspan="2">Příjemce</td>
							</tr>
							<tr>
								<td>jméno:</td><td> '.$data["summary"]["name"].'</td> 
							</tr>
							<tr>
								<td>příjmení:</td><td> '.$data["summary"]["last_name"].'</td>
							</tr>
							<tr>
								<td>ulice:</td><td> '.$data["summary"]["street"].'</td>
							</tr>
							<tr>
								<td>město:</td><td> '.$data["summary"]["city"].'</td>
							</tr>
							<tr>
								<td>stát:</td><td> '.$data["summary"]["country"].'</td>
							</tr>
							<tr>
								<td>p.s.č.:</td><td> '.$data["summary"]["zip"].'</td>
							</tr>
						</table>

						<br>

						<table>
							<tr>
								<td colspan="2">Odesílatel</td>
							</tr>
							<tr>
								<td>Název:</td><td>'.$data["company_setting"]["company_name"].'</td>
							</tr>
							<tr>
								<td>IČO:</td><td>'.$data["company_setting"]["company_ico"].'</td>
							</tr>
							<tr>
								<td>Adresa:</td><td>'.$data["company_setting"]["company_address"].'</td>
							</tr>
							<tr>
								<td>telefon:</td><td>'.$data["company_setting"]["phone"].'</td>
							</tr>
						</table>

						<br>

						<table>
							<tr>
								<td colspan="2">Platební údaje</td>
							</tr>
							<tr>
								<td>bankovní účet:</td><td> '.$data["company_setting"]["bank_account"].'</td>
							</tr>
							<tr>
								<td>kód banky:</td><td> '.$data["company_setting"]["bank_code"].'</td>
							</tr>
							<tr>
								<td>variabilni symbol:</td><td> '.$data["last_order"]->id.'</td>
							</tr>
							<tr>
								<td>částka k zaplacení:</td><td>'.nF($product->item_total_price).'</td>
							</tr>
						</table>

					</div>
				
				<img src="'.ROOT.'/objednavky/qr_codes/'.$data["last_order"]->id.'_qrcode.png" alt="qr code">
			</body>
		</html>
		';

		return $html;
				}
 return false;
}
function email_temp_pdf($data = []) {
if(count($data) > 0) {

	$html = '
	<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

				<style>

					body {
						font-family: "Times";
					}

					th {
						padding: 0.25rem 1rem;
					}

				</style>
			</head>

			<body>
				<h1>Rekapitulace objednávky</h1>

				<div class="cisloObjednavky">

				<table border="1">
					<tr>
						<th>id</th>
						<th>název</th>
						<th>cena/ks</th>
						<th>množství</th>
						<th>cena</th>
					</tr>
						<tr>
						<th></th>
						<th></th>
						<th>[kč]</th>
						<th>[ks]</th>
						<th>[kč]</th>
					</tr>
					';

				foreach ($data["data_product"] as $klic => $product) {
					$html .= '<tr>
						<td>'.$product->id.'</td>
						<td>'.$product->description.'</td>
						<td>'.nF($product->price).'</td>
						<td>'.nF($product->qty).'</td>
						<td>'.nF($product->item_total_price).'</td>
					</tr>
					';
				}

				$html .= '
					<tr>
						<td colspan="4">cena celkem</td><td>'.nF($data["summary"]["subtotal_cart_price"]).'</td>
					</tr>
				</table>

				<p>jméno: '.$data["summary"]["name"].'</p>
				<p>příjmení: '.$data["summary"]["last_name"].'</p>
				<p>ulice: '.$data["summary"]["street"].'</p>
				<p>město: '.$data["summary"]["city"].'</p>
				<p>stát: '.$data["summary"]["country"].'</p>
				<p>p.s.č.: '.$data["summary"]["zip"].'</p>
				<p>bankovní účet: '.$data["bank_account"].'</p>
				<p>variabilni symbol: '.$data["last_order_id"].'</p>
				
				<img src="'.$data["qr_code"].'" alt="qr code">
			</body>
		</html>
		';

		return $html;
				}
 return false;
}