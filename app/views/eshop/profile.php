<?php $this->view("header", $data); ?>

<style>
	.details {
		background-color: #eee;
		box-shadow: 0px 0px 10px #aaa;
		width: 100%;
		position: absolute;
		min-height: 100px;
		left: 0px;
		padding: 10px;
		z-index: 2;
		cursor: default;
	}

	.hide {
		display: none;
	}

	.close {
		float: right;

	}
</style>

<div class="container pb-4">

	<?php if(!$profile_data == null): ?>

	<div class="row">
		<div class="col-md-4">
			<div class="main-chart">
				<!-- WHITE PANEL - TOP USER -->
				<div class="white-panel-profile pn">
					<div class="white-header">
						<h5>MY ACCOUNT</h5>
					</div>
					<p><img src="<?= ASSETS . THEME ?>admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
					<p><b><?= $data["profile_data"]->name ?></b></p>
					<div class="row">
						<div class="col-md-6">
							<p class="small mt">MEMBER SINCE</p>
							<p><?= date("jS M Y", strtotime($data["profile_data"]->date)) ?></p>
						</div>
						<div class="col-md-6">
							<p class="small mt">TOTAL SPEND</p>
							<p>$ 47,60</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<p class="small mt" style="cursor: pointer">EDIT</p>
						</div>
						<div class="col-md-6">
							<p class="small mt" style="color: red; cursor: pointer;">DELETE</p>
						</div>
					</div>
				</div>
			</div><!-- /col-md-4 -->
		</div>
	</div>
	<?php else: ?>
		<div>
			<h2 style="text-align: center">Uzivatel nenalezen</h2>
		</div>
	<?php endif; ?>

</div>

<div class="container">

	<?php if(isset($table_row) && $table_row != ""): ?> 
		
		<?=$table_row ?>

	<?php else: ?>

		<div>
			<h2 style="text-align: center">Nothing is ordered.</h2>
		</div>

	<?php endif; ?>

</div>

<script>

	EDIT_ID = "";

	

	function show_dateils(e) {
		
		let all_js_order_details = document.querySelectorAll(".js_order_details");
		all_js_order_details.forEach((elemen) => {elemen.classList.add("hide")});

		let row = e.target.parentNode;

		let details = row.querySelector(".js_order_details");

		// pokud kliknu na close pak details == null protoze parent pro div s close neobsahuje .js_order_details
		if(details) {
			details.classList.remove("hide");
		}
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
		data.mobile = mobile.value.trim();
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
					// mohli ny jsme to udela v js ale trochu by se to komplikovalo
					// window.location.href = window.location.href;
				}
			}
		}
	}
</script>

<?php $this->view("footer", $data); ?>

