<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<!-- <?php show($data)?> -->

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
							<label for="min_skladem">Min:</label>
							<input class="form-control" id="min_skladem" type="number" step="1" name="min_skladem" value="<?=old_value("min_skladem", 0, "GET")?>">
							<label for="max_skladem">Max:</label>
							<input class="form-control" id="max_skladem" type="number" step="1" name="max_skladem" value="<?=old_value("max_skladem", 0, "GET")?>">
						</div>
					</td>
					<th>Price</th>
					<td>
						<div class="form-inline">
							<label for="min_cenaNakup">Min:</label>
							<input class="form-control" id="min_cenaNakup" type="number" step="1" name="min_cenaNakup" value="<?=old_value("min_cenaNakup", 0, "GET")?>">
							<label for="max_cenaNakup">Max:</label>
							<input class="form-control" id="max_cenaNakup" type="number" step="1" name="max_cenaNakup" value="<?=old_value("max_cenaNakup", 0, "GET")?>">
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
								<?php if (isset($product)): ?>
										<p><?= $product->description?></p>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="category">Category</label>
							<div class="col-sm-10">
								
									 <?php if (isset($categories)): ?>
										<?php foreach ($categories as $value): ?>
											<p><?= $value?></p>
										<?php endforeach; ?>
									<?php endif; ?>
									
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="brand">Brand</label>
							<div class="col-sm-10">
									<?php if (isset($brand)): ?>
										<p><?=$brand->brand?></p>
									<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="cenaNakup">Cena Nakup</label>
							<div class="col-sm-10">
								<?php if (isset($product_skladem)): ?>
									<p><?=$product_skladem->cenaNakup?> kč</p>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="dph_sklad">dph</label>
							<div class="col-sm-10">
							<?php if (isset($product_skladem)): ?>
									<p><?=$product_skladem->dph_sklad?>%</p>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="skladem">Skladem</label>
							<div class="col-sm-10">
								<?php if (isset($product_skladem)): ?>
									<p><?=$product_skladem->skladem?></p>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="cenaProdej">Cena prodej</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="cenaProdej" id="cenaProdej" placeholder="0.00"
									style="margin-bottom: 1rem" value="<?=old_value("cenaProdej", "0", "GET")?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="dph_prodej">Dph prodej</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="dph_prodej" id="dph_prodej" placeholder="0.00"
									style="margin-bottom: 1rem" value="<?=old_value("dph_prodej", "0", "GET")?>">
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
	let sklad_id_sklad = "";
	// pokud chci naskladnit product
	<?=isset($product_skladem)&&is_object($product_skladem) ? "sklad_id_sklad = ".$product_skladem->id.";" : ""?>

	const show_add_box 		 	= document.querySelector(".add_new");
	const button_edit_onform 	= document.querySelector(".js_button_edit");
	const button_add_onform  	= document.querySelector(".js_button_add");
	const button_filter_onform  = document.querySelector(".js_button_filter");
	const js_images 			= document.querySelector(".js_images");
	const error_div 		 	= document.querySelector("#error");

	const table				 	= document.querySelector(".js_table");

	const cenaProdej_input 	 	= document.querySelector("#cenaProdej");
	const dph_prodej_input 	 	= document.querySelector("#dph_prodej");
	
	const add_new_inputs = document.querySelectorAll(".add_new select, .add_new input");

	function show_add_new(obj = {}) {

			show_add_box.classList.remove("hide");
			button_add_onform.classList.remove("hide");
			add_new_inputs[0].focus();

			if(obj.button_type == "edit") {
				button_edit_onform.classList.remove("hide");
				button_add_onform.classList.add("hide");
			}
		
	}

	function hide_add_new(obj = {}) {
		// console.log(add_new_inputs);
		show_add_box.classList.add("hide");
		button_edit_onform.classList.add("hide");
		add_new_inputs[0].value = "";
		error_div.classList.add("hide");
		error_div.innerHTML = "";
		}

	function collect_data(obj = {}) {

		const data = {};
	
		// console.log("category");
		// console.log(data.category);

		data.cenaProdej = cenaProdej_input.value.trim();
		data.dph_prodej = dph_prodej_input.value.trim();
		data.sklad_id_sklad 		= sklad_id_sklad;
		data.id 		= EDIT_ID;

		console.log(data);

		const formdata = new FormData();

		if(obj.data_type != "filter") {

			// console.log("data", data);
			// console.log("data_type", obj.data_type);
			// console.log("EDIT_ID", EDIT_ID);

			if (data.cenaProdej == "" || isNaN(data.cenaProdej)) {
				alert("Please enter a valid cenaNakup");
				return;
			}

			if (data.dph_prodej == "" || isNaN(data.dph_prodej)) {
				alert("Please enter a valid dph_rodej");
				return;
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
		
		data.append("model", "product_prodej");
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
		
	
		cenaProdej_input.value 	= obj.cenaProdej;
		dph_prodej_input.value 	= obj.dph_prodej;
		
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