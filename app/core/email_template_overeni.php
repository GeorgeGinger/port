<?php

function email_temp_overeni($data = []) {

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
				<h1>Ověření emailu</h1>

				<div class="">

				<p>Kliknutím na odkaz ověříte pravost emailu</p> 

				<a href="'.ROOT.'signup?submit_overeni='.$data['user_url'].'">Klikni pro ověření</a>

				</div>
			</body>
		</html>
		';

		return $html;

}

