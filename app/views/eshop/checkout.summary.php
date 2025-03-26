<?php $this->view("header", $data); ?>

<!-- <?php show($data) ?> -->

<?php
if (isset($errors) && count($errors) > 0) {
	foreach ($errors as $error) {
		echo "<div class='container'>";
		echo "<div class='alert alert-danger' style='padding: 5px; font-size: 3rem; text-align: center;'>$error</div>";
		echo "</div>";
	}
}
?>
<section id="cart_items">
	<div class="container">

		<?php if (isset($summary) && count($summary) > 0): ?>

			<div class="register_reg">
				<p style="font-size: 3rem; text-align: center;">Pleace confirm the information below</p>
			</div>

			<div class="table-responsive cart_info">

				<?= $table_row1 ?>
				<?= $table_row2 ?>

				<div class="pull-right" style="font-size: 3rem">
					Sub. Total: <?= nF($summary["subtotal_cart_price"], "Kč") ?>
				</div>

			</div>

			<form method="post">
				<input type="submit" class="btn btn-danger pull-right" value="ORDER >" name="order">
			</form>

		<?php else: ?>
			<div style="font-size: 3rem; text-align: center;">
				Please add some items to the cart first.
			</div>
		<?php endif; ?>

		<div>
			<a href="<?= ROOT ?>checkout">
				<input type="button" class="btn btn-danger pull-left" value="< Back to checkout" name="">
			</a>

		</div>
	</div>
</section> <!--/#cart_items-->

<!-- <?= show($data); ?> -->


<script>

	EDIT_ID = "";

	const js_city = document.querySelector(".js_city");
	const delivery_adress = document.querySelector("#delivery_adress");
	const zip = document.querySelector("#zip");
	const country = document.querySelector("#country");
	const city = document.querySelector("#city");
	const phone = document.querySelector("#phone");



	function get_cities(id) {
		send_data({
			id: id,
		}, "get_cities");
	}

	function send_data(data = {}, data_type) {

		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>ajax_checkout/" + data_type + "/" + JSON.stringify(data), true);

		ajax.send();
	}

	function collect_data(obj = {}) {

		const data = {};

		data.delivery_adress = delivery_adress.value.trim();
		data.zip = zip.value.trim();
		data.country = country.value.trim();
		data.city = city.value.trim();
		data.zip = zip.value.trim();
		data.phone = phone.value.trim();
		data.id = EDIT_ID;

		// console.log("data", data);
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.delivery_adress == "" || !isNaN(data.delivery_adress)) {
			alert("Please enter a valid delivery_adress name js");
			return;
		}

		if (isNaN(data.zip)) {
			alert("Please enter a valid zip name js");
			return;
		}

		const formdata = new FormData();

		formdata.append("data", JSON.stringify(data));
		formdata.append("data_type", obj.data_type);

		send_data_form(formdata);


	}

	function send_data_form(data) {

		// console.log(data.data.new_product);

		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>checkout", true);

		data.append("model", "category");
		ajax.send(data);
	}

	function handle_result(result) {

		// console.log(result);
		if (result != "") {

			console.log(result);
			const obj = JSON.parse(result);
			console.log(obj);

			if (typeof obj.data_type != "undefined") {

				if (obj.data_type == "get_cities") {

					js_city.innerHTML = "<option>-- State / Province / Region --</option>";
					for (const key in obj.cities) {
						// console.log(obj.cities[key].city);
						js_city.innerHTML += `<option value='${obj.cities[key].id}'>${obj.cities[key].city}</option>`
					}
					// 
					// refresch stranky po zneme kvuli prepocitani total price, a cart price
					// mohli ny jsme to udelt v js ale trochu by se to komplikovalo
					// window.location.href = window.location.href;
				}
			}
		}
	}

</script>

<?php $this->view("footer", $data); ?>