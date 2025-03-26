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
								<label class="col-sm-2 col-sm-2 control-label" for="category">Category name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="category" id="category"
										placeholder="Enter product name" style="margin-bottom: 1rem">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label" for="parent">Parent (optional)</label>
								<div class="col-sm-10">
									<select id="parent" name="parent" class="form-control" style="margin-bottom: 1rem">
										<option value="0" selected>--Bez Nadkategorie--</option>
										<?php if (is_array($categories)): ?>
											<?php foreach ($categories as $value): ?>
												<option value='<?= $value->id ?>'><?= $value->category ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
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

		<?php if(isset($table_rows) && $table_rows != ""): ?> 

		<div class="js_table">
			<?=$table_rows ?>
		</div>
		
		<?php else: ?>

			<div>
				<h2 style="text-align: center">No categories.</h2>
			</div>

		<?php endif; ?>

</div><!-- /content-panel -->

<script>
	let EDIT_ID = "";

	const show_add_box 		 = document.querySelector(".add_new");
	const button_edit_onform = document.querySelector(".js_button_edit");
	const button_add_onform  = document.querySelector(".js_button_add");

	const table				 = document.querySelector(".js_table");

	const category_input 	 = document.querySelector("#category");
	const parent_input 		 = document.querySelector("#parent");

	const add_new_inputs 	 = document.querySelectorAll(".add_new input,select");

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

		data.category = category_input.value.trim();
		data.parent	  = parent_input.value.trim();
		data.id 	  = EDIT_ID;



		console.log("data", isNaN(data.parent));
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.category == "" || !isNaN(data.category)) {
			alert("Please enter a valid category name js");
			return;
		}

		if (isNaN(data.parent)) {
			alert("Please enter a valid category name js");
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

		data.append("model", "category");
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

						table.innerHTML = obj.data;
					} else {
						alert(obj.message);
					}

				} else if (obj.data_type == "delete_row") {

					// alert(obj.message);

					table.innerHTML = obj.data;

				} else if (obj.data_type == "change_status_row") {

					table.innerHTML = obj.data;

				} else if (obj.data_type == "edit_row") {

					if (obj.message_type == "info") {
						table.innerHTML = obj.data;
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

		category_input.value = obj.category;
		parent_input.value 	 = parseInt(obj.parent);
		EDIT_ID				 = parseInt(obj.id);

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