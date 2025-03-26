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

	.popup_form {
		width: 500px;
		/* height: 300px; */
		background-color: #cecccc;
		box-shadow: 0px 0px 10px #aaa;
		position: absolute;
		padding: 6px;
	}

	.show {
		display: block;
	}

	.hide {
		display: none;
	}

	.form-horizontal.style-form .form-group {
		padding-bottom: 10px;
		margin-bottom: 0px;
		border-bottom: 1px none #eff2f7;
	}

	.edit_product_images {
		display: flex;
		width: 100%;
		margin-bottom: 3rem;
	}
	.edit_product_images img {
		flex: 1;
		width: 10px;
		margin: 3px; 

	}
</style>

<div class="content-panel">
	<!-- searchbox -->
	 <form action="">
		<table class="table">
			<thead>
				<tr>
					<td colspan="4">
						<h3>Advance Search</h3>
					</td>
				</tr>
			</thead>
				<tr>
					<th>Description</th>
					<td>
						<input type="text" name="description" class="form-control" autofocus="true" placeholder="Type what you searching for" value="<?=old_value("description", "", "GET")?>">
					</td>
					<th>Category</th>
					<td>
						<select name="category" class="form-control">
							<option value="">--Any Category--</option>
							<?php  $search = new Search; $search->get_categories(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Quantity</th>
					<td>
						<div class="form-inline">
							<label for="min_quantity">Min:</label>
							<input class="form-control" id="min_quantity" type="number" step="1" name="min_quantity" value="<?=old_value("min_quantity", 0, "GET")?>">
							<label for="max_quantity">Max:</label>
							<input class="form-control" id="max_quantity" type="number" step="1" name="max_quantity" value="<?=old_value("max_quantity", 0, "GET")?>">
						</div>
					</td>
					<th>Price</th>
					<td>
						<div class="form-inline">
							<label for="min_price">Min:</label>
							<input class="form-control" id="min_price" type="number" step="1" name="min_price" value="<?=old_value("min_price", 0, "GET")?>">
							<label for="max_price">Max:</label>
							<input class="form-control" id="max_price" type="number" step="1" name="max_price" value="<?=old_value("max_price", 0, "GET")?>">
						</div>
						
					</td>
				</tr>
				<tr >
					<th>Year</th>
					<td>
						<select name="year" class="form-control">
							<option>--Any Year--</option>
							<?php $search->get_year(); ?>
						</select>
					</td>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th>Brands</th>
					<td colspan="3">
						<?php $search->get_brand() ?>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<input class="btn btn-success pull-right" type="submit" name="search_submit" value="Search">
					</td>
				</tr>
	 </table>

	 </form>
	 
	<!--end searchbox -->
	

	<!-- add new product -->
	<div class="add_new hide">
		<!-- BASIC FORM ELELEMNTS -->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<h4 class="mb"><i class="fa fa-angle-right"></i> Form Elements</h4>

					<div class="status alert alert-danger hide" id="error"></div>

					<form class="form-horizontal style-form" method="get">

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="description">Product name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="description" id="description"
									placeholder="Enter product name" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="category">Category</label>
							<div class="col-sm-10">
								<select id="category" name="category[]" class="form-control"
									style="margin-bottom: 1rem" multiple>
									<!-- <option value=""></option> -->
									<?php if (is_array($categories)): ?>
										<?php foreach ($categories as $value): ?>
											<option value='<?= $value->id ?>'><?= $value->category ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="brand">Brand</label>
							<div class="col-sm-10">
								<select id="brand" name="brand" class="form-control"
									style="margin-bottom: 1rem">
									<option value=""></option>
									<?php if (is_array($brands)): ?>
										<?php foreach ($brands as $value): ?>
											<option value='<?= $value->id ?>'><?= $value->brand ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="price">Price</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="price" id="price" placeholder="0.00"
									step="0.01" style="margin-bottom: 1rem">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="quantity">Quantity</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" value="1" name="quantity" id="quantity"
									style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label" for="image">Image</label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="image" onchange="display_image(this.files[0],this.mame)" id="image" placeholder="Image"
								style="margin-bottom: 1rem">
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="image2">Image2 (optional)</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="image2" onchange="display_image(this.files[0],this.name)" id="image2"
									placeholder="Image2" style="margin-bottom: 1rem">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="image3">Image3 (optional)</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="image3" onchange="display_image(this.files[0],this.name)" id="image3"
									placeholder="Image3" style="margin-bottom: 1rem">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="image4">Image4 (optional)</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="image4" onchange="display_image(this.files[0],this.name)" id="image4"
									placeholder="Image4" style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="js_images edit_product_images"></div>
					
						<button type="button" class="btn btn-danger" onclick="hide_add_new(event)">Close</button>

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
		<h2 style="text-align: center">No product.</h2>
	</div>

<?php endif; ?>
</div><!-- /content-panel -->




<script>
	let EDIT_ID = "";

	const show_add_box 		 			= document.querySelector(".add_new");
	const button_edit_onform 		= document.querySelector(".js_button_edit");
	const button_add_onform  		= document.querySelector(".js_button_add");
	const button_filter_onform  = document.querySelector(".js_button_filter");
	const js_images 						= document.querySelector(".js_images");
	const error_div 		 				= document.querySelector("#error");

	const table				 = document.querySelector(".js_table");

	const description_input  = document.querySelector("#description");
	const category_input	 = document.querySelector("#category");
	const option_input		 = category_input.querySelectorAll("option");
	const brand_input		 	 = document.querySelector("#brand");
	const quantity_input 	 = document.querySelector("#quantity");
	const price_input 	 	 = document.querySelector("#price");
	const image_input 	 	 = document.querySelector("#image");
	const image2_input 		 = document.querySelector("#image2");
	const image3_input 		 = document.querySelector("#image3");
	const image4_input 		 = document.querySelector("#image4");
	const slag_input 		 	 = document.querySelector("#slag");
	

	const add_new_inputs = document.querySelectorAll(".add_new select, .add_new input");

	// console.log(option_input);


	function show_add_new(obj = {}) {

		js_images.innerHTML = `<img src="<?= ROOT ?>${obj.image}" >`;
		js_images.innerHTML += `<img src="<?= ROOT ?>${obj.image2}" >`;
		js_images.innerHTML += `<img src="<?= ROOT ?>${obj.image3}" >`;
		js_images.innerHTML += `<img src="<?= ROOT ?>${obj.image4}" >`;

		
			show_add_box.classList.remove("hide");
			button_add_onform.classList.remove("hide");
			add_new_inputs[0].focus();

			if(obj.button_type == "edit") {
				button_edit_onform.classList.remove("hide");
				button_add_onform.classList.add("hide");
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
		error_div.classList.add("hide");
		error_div.innerHTML = "";
		}

	function display_image(file, name) {

		let index = 0;
		if(name == "image2") {
			index = 1;
		}else if(name == "image3") {
			index = 2;
		}else if(name == "image4") {
			index = 3;
		}

		let images = js_images.querySelectorAll("img");

		images[index].src = URL.createObjectURL(file);
	}

	function collect_data(obj = {}) {

		const data = {};

		data.description = 	description_input.value.trim();
		// data.category 	 = 	category_input.value;
		data.category 	 = 	[...category_input.options]
							.filter(option => option.selected)
							.map(option => option.value);
	
		// console.log("category");
		// console.log(data.category);

		data.brand 	 	 = 	brand_input.value.trim();
		data.quantity	 = 	quantity_input.value.trim();
		data.price 		 =	price_input.value.trim();

		data.id 		 =	EDIT_ID;

		// console.log(data);

		const formdata = new FormData();

		if(obj.data_type != "filter") {

			image  = image_input.files;
			image2 = image2_input.files;
			image3 = image3_input.files;
			image4 = image4_input.files;

			// console.log("data", data);
			// console.log("data_type", obj.data_type);
			// console.log("EDIT_ID", EDIT_ID);

			// prazdny retezec nebo neni cislo
			if (data.description == "" || !isNaN(data.description)) {
				alert("Please enter a valid product description");
				return;
			}

			// if (data.category == "" || isNaN(data.category)) {
			// 	alert("Please enter a valid product category js" + data.category);
			// 	return;
			// }

			if (data.brand == "" || isNaN(data.brand)) {
				alert("Please enter a valid product category js" + data.category);
				return;
			}

			if (data.price == "" || isNaN(data.price)) {
				alert("Please enter a valid price");
				return;
			}

			if (data.quantity == "" || isNaN(data.quantity)) {
				alert("Please enter a valid quantity");
				return;
			}

			if (image.length == 0 && obj.data_type != "edit_row") {
				alert("Please enter a valid main image");
				return;
			} 


			if (image.length > 0) {
				formdata.append("image", image[0]);
			}

			if (image2.length > 0) {
				formdata.append("image2", image2[0]);
			}

			if (image3.length > 0) {
				formdata.append("image3", image3[0]);
			}

			if (image4.length > 0) {
				formdata.append("image4", image4[0]);
			}

		}
		
		formdata.append("data", JSON.stringify(data));
		formdata.append("data_type", obj.data_type);

		send_data_files(formdata);

		hide_add_new();
	}

	function send_data_files(data) {

		// console.log(data);

		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>ajax_nofiles", true);
		
		data.append("model", "product");
		ajax.send(data);
	}

	function handle_result(result) {

		console.log(result);

		if (result != "") {
			const obj = JSON.parse(result);
			// console.log(obj);

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
		
		console.log(option_input);

		description_input.value = obj.description;

		obj.all_cat_id.forEach(e_cat => {
			console.log(e_cat);
			option_input.forEach(e_option => {
				
				if(e_cat == e_option.value) {
					console.log(e_option);
					e_option.selected = true;
					console.log(e_option);
				}
			});
		});


		brand_input.value 		= obj.brand;
		quantity_input.value 	= obj.quantity;
		price_input.value 	 	= obj.price;
		EDIT_ID 				= obj.id;

		show_add_new(obj);
	}

	function delete_row(obj) {
		// console.log(obj);

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