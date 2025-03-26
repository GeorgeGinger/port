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
								<label class="col-sm-2 col-sm-2 control-label" for="style_id">Style</label>
								<div class="col-sm-10">
									<select id="style_id" name="style_id" class="form-control"
										style="margin-bottom: 1rem">
										<option value=""></option>
										<?php if (is_array($styles)): ?>
											<?php foreach ($styles as $value): ?>
												<option value='<?= $value->id ?>'><?= $value->style ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</div>
							</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="shelf">Shelf name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="shelf" id="shelf"
									placeholder="Enter the shelf name" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="shelf_order">Shelf order</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="shelf_order" id="shelf_order"
									placeholder="Enter the shelf order name" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="type">Type</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="type" id="type"
									placeholder="Enter the shelf type" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="class">Class</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="class" id="class"
									placeholder="Enter the shelf icon class" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="place">Place</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="place" id="place"
									placeholder="Enter the shelf place" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="url">Url</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="url" id="url"
									placeholder="Enter the url" style="margin-bottom: 1rem">
							</div>
						</div>

						<button type="button" class="btn btn-danger" onclick="hide_add_new(event)">Close</button>
						<button type="button" class="btn btn-success js_button_add hide"
							onclick="collect_data({data_type:'add_row'})">Save new</button>
						<button type="button" class="btn btn-primary js_button_edit hide"
							onclick="collect_data({data_type:'edit_row'})">Edit</button>
					</form>
				</div>
			</div><!-- col-lg-12-->
		</div><!-- /row -->
	</div>

		<div class="js_table_div">
			<?= $table_rows ?>
		</div>



</div><!-- /content-panel -->

<script>
	let EDIT_ID = "";

	const show_add_box 		 = document.querySelector(".add_new");
	const button_edit_onform = document.querySelector(".js_button_edit");
	const button_add_onform  = document.querySelector(".js_button_add");
	const js_table_div 		 = document.querySelector(".js_table_div");

	const style_id_input 	= document.querySelector("#style_id");
	const shelf_input 		= document.querySelector("#shelf");
	const shelf_order_input = document.querySelector("#shelf_order");
	const type_input 		= document.querySelector("#type");
	const class_input 		= document.querySelector("#class");
	const place_input 		= document.querySelector("#place");
	const url_input 		= document.querySelector("#url");

	const add_new_inputs = document.querySelectorAll(".add_new select, .add_new input");

	console.log(add_new_inputs);

	function show_add_new(obj = {}) {

		if (show_add_box.classList.contains("hide")) {
			show_add_box.classList.remove("hide");
			button_add_onform.classList.remove("hide");
			add_new_inputs[0].focus();

			if (obj.button_type == "edit") {
				button_edit_onform.classList.remove("hide");
				// button_add_onform.classList.add("hide");
			}

		}
	}

	function hide_add_new(obj = {}) {

		show_add_box.classList.add("hide");
		button_edit_onform.classList.add("hide");
		add_new_inputs[0].value = "";
		add_new_inputs[1].value = "";
		add_new_inputs[2].value = "";
		add_new_inputs[3].value = "";
		add_new_inputs[4].value = "";
		add_new_inputs[5].value = "";
		add_new_inputs[6].value = "";
	}

	function collect_data(obj = {}) {

		const data = {};
		
		data.style_id = style_id_input.value.trim();
		data.shelf = shelf_input.value.trim();
		data.shelf_order = shelf_order_input.value.trim();
		data.type = type_input.value.trim();
		data.class = class_input.value.trim();
		data.place = place_input.value.trim();
		data.url = url_input.value.trim();
		
		data.id = EDIT_ID;

		// console.log("data", data);
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.shelf == "" || !isNaN(data.shelf)) {
			alert("Please enter a valid setting js");
			return;
		}

		const formdata = new FormData();

		formdata.append("data", JSON.stringify(data));
		formdata.append("data_type", obj.data_type);

		send_data_files(formdata);

		hide_add_new();
	}


	function send_data_files(data) {


		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>ajax_nofiles", true);

		data.append("model", "footer_menu");
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


						js_table_div.innerHTML = obj.data;
					} else {
						alert(obj.message);
					}

				} else if (obj.data_type == "delete_row") {

					// alert(obj.message);

					js_table_div.innerHTML = obj.data;

				} else if (obj.data_type == "change_status_row") {

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
		

		style_id_input.value 	= obj.style_id;
		shelf_input.value 		= obj.shelf;
		shelf_order_input.value = obj.shelf_order;
		type_input.value 		= obj.type;
		class_input.value 		= obj.class;
		place_input.value 		= obj.place;
		url_input.value 		= obj.url;
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