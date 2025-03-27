<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">
	.add_new {
		width: 500px;
		/* height: 300px; */
		background-color: #cecccc;
		box-shadow: 0px 0px 10px #aaa;
		position: absolute;
		padding: 6px;
		z-index: 10;
	}

	.show {
		display: block;
	}

	.hide {
		display: none;
	}
</style>

<div class="content-panel">

	<!-- add new product -->
	<div class="add_new hide">

		<!-- BASIC FORM ELELEMNTS -->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<h4 class="mb"><i class="fa fa-angle-right"></i> Form Elements</h4>
					<form class="form-horizontal style-form" method="get">

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="setting">Setting name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="setting" id="setting"
									placeholder="Enter the setting" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="setting_value">Setting value</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="setting_value" id="setting_value"
									placeholder="Enter the value of setting" style="margin-bottom: 1rem">
							</div>
						</div>

						<button type="button" class="btn btn-danger" onclick="show_add_new(event)">Close</button>
						<button type="button" class="btn btn-primary js_button_add hide"
							onclick="collect_data({data_type:'add_row'})">Save</button>
						<button type="button" class="btn btn-primary js_button_edit hide"
							onclick="collect_data({data_type:'edit_row'})">Edit</button>
					</form>
				</div>
			</div><!-- col-lg-12-->
		</div><!-- /row -->
	</div>

	<form action="" method="post">
		<div class="js_table_div">
			<?= $table_row ?>
		</div>
		<input type="submit" value="Save" name="save_social" id="save_social" class="btn btn-warning">
	</form>


</div><!-- /content-panel -->

<script>
	let EDIT_ID = "";

	const show_add_box = document.querySelector(".add_new");
	const button_edit_onform = document.querySelector(".js_button_edit");
	const button_add_onform = document.querySelector(".js_button_add");
	const js_table_div = document.querySelector(".js_table_div");

	const setting_input = document.querySelector("#setting");
	const setting_value_input = document.querySelector("#setting_value");

	const add_new_inputs = document.querySelectorAll(".add_new input");

	console.log(add_new_inputs);

	function show_add_new(obj = {}) {

		if (show_add_box.classList.contains("hide")) {
			show_add_box.classList.remove("hide");
			button_add_onform.classList.remove("hide");
			add_new_inputs[0].focus();

			if (obj.button_type == "edit") {
				button_edit_onform.classList.remove("hide");
				button_add_onform.classList.add("hide");
			}

		} else {
			show_add_box.classList.add("hide");
			button_edit_onform.classList.add("hide");
			add_new_inputs[0].value = "";
			add_new_inputs[1].value = "";
		}
	}

	function collect_data(obj = {}) {

		const data = {};

		data.setting = setting_input.value.trim();
		data.setting_value = setting_value_input.value.trim();
		data.id = EDIT_ID;

		// console.log("data", data);
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.setting == "" || !isNaN(data.setting)) {
			alert("Please enter a valid setting js");
			return;
		}

		if (data.setting == "") {
			alert("Please enter a valid value js");
			return;
		}

		const formdata = new FormData();

		formdata.append("data", JSON.stringify(data));
		formdata.append("data_type", obj.data_type);

		send_data_files(formdata);

		show_add_new();
	}


	function send_data_files(data) {

		// console.log(data.data.new_product);

		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>ajax_nofiles", true);

		data.append("core", "Settings_global");
		ajax.send(data);
	}

	function handle_result(result) {

		console.log(result);

		if (result != "") {
			const obj = JSON.parse(result);
			// console.log(obj.check);

			if (typeof obj.data_type != "undefined") {

				if (obj.data_type == "add_row") {

					if (obj.message_type == "info") {
						// alert(obj.message);
						console.log("zde");
						console.log(obj.data);
						js_table_div.innerHTML = obj.data;
					} else {
						alert(obj.message);
					}

				} else if (obj.data_type == "delete_row") {

					// alert(obj.message);

					js_table_div.innerHTML = obj.data;

				} else if (obj.data_type == "disable_row") {

					js_table_div.innerHTML = obj.data;

				} else if (obj.data_type == "edit_row") {

					if (obj.message_type == "info") {

						js_table_div.innerHTML = obj.data;
					} else {
						alert(obj.message);
					}
				}
			}
		}
	}

	function edit_row(e) {

		obj = JSON.parse(e.currentTarget.getAttribute("info"));
		// console.log(obj);

		setting_input.value = obj.setting;
		setting_value_input.value = parseInt(obj.setting_value);
		EDIT_ID = parseInt(obj.id);

		show_add_new(obj);
	}

	function delete_row(obj) {
		// console.log(obj.id);

		const answer = confirm("Are you soure you want to delete this row");

		if (answer) {
			const formdata = new FormData();
			formdata.append("data", JSON.stringify(obj));
			formdata.append("data_type", "delete_row");
			send_data_files(formdata);
		}
	}

	function change_status_row(obj) {
		// console.log(obj);

		obj.disabled = obj.disabled ? 0 : 1;

		const formdata = new FormData();
		formdata.append("data", JSON.stringify(obj));
		formdata.append("data_type", "change_status_row");
		send_data_files(formdata);

	}

</script>

<?php $this->view("admin/footer", $data); ?>