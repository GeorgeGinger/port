<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">
	.add_row {
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
		width: 70px;
		height: 70px;
		margin: 3px; 
	}
</style>
<div class="content-panel">

	<!-- add new product -->
	<div class="add_row hide">

		<!-- BASIC FORM ELELEMNTS -->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<h4 class="mb"><i class="fa fa-angle-right"></i> Form Elements</h4>

					<div class="status alert alert-danger hide" id="error"></div>

					<form class="form-horizontal style-form" method="post">

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="title">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" id="title"
									placeholder="Enter blog title " style="margin-bottom: 1rem" value="<?= old_value("title")?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="post">Post</label>
							<div class="col-sm-10">
								<textarea name="post" class="form-control" id="post" style="margin-bottom: 1rem" placeholder="Enter blog post"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="title1">Title1</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title1" id="title1"
									placeholder="Enter blog title " style="margin-bottom: 1rem" value="<?= old_value("title1")?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="post1">Post1</label>
							<div class="col-sm-10">
								<textarea name="post1" class="form-control" id="post1" style="margin-bottom: 1rem" placeholder="Enter blog post"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="vzkazy_order">Pořadí</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="vzkazy_order" id="vzkazy_order"
									placeholder="Enter blog title " style="margin-bottom: 1rem" value="<?= old_value("vzkazy_order", $last_vzkaz)?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="image">Image</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="image" onchange="display_image(this.files[0],this.name)" id="image" placeholder="Image"
									style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="image1">Image1</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="image1" onchange="display_image(this.files[0],this.name)" id="image1" placeholder="Image1"
									style="margin-bottom: 1rem">
							</div>
						</div>

						<div class="js_images edit_product_images">
						</div>

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

	<div class="js_table_div" >
		<?= $table_rows ?>
	</div>


</div><!-- /content-panel -->

<script>
	let EDIT_ID = "";

	const show_add_box 		 = document.querySelector(".add_row");
	const button_edit_onform = document.querySelector(".js_button_edit");
	const button_add_onform  = document.querySelector(".js_button_add");
	const js_images 		 = document.querySelector(".js_images");
	const js_table_div 		 = document.querySelector(".js_table_div");
	const error_div 		 = document.querySelector("#error");

	const title_input  	 	 = document.querySelector("#title");
	const title1_input  	 = document.querySelector("#title1");
	const post_input	 	 = document.querySelector("#post");
	const post1_input	 	 = document.querySelector("#post1");
	const vzkazy_order_input = document.querySelector("#vzkazy_order");
	const image_input 	 	 = document.querySelector("#image");
	const image1_input 	 	 = document.querySelector("#image1");

	const add_new_inputs = document.querySelectorAll(".add_row input,select,textarea");


	function show_add_new(obj = {}) {

		js_images.innerHTML = `<img src="<?= ROOT ?>${obj.image}">`;
		js_images.innerHTML += `<img src="<?= ROOT ?>${obj.image1}">`;
	
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
			error_div.classList.add("hide");
			error_div.innerHTML = "";
	}

	function display_image(file, name) {
		// zobrazeni nahledu ve formulari
		console.log(file);
		console.log(name);

		let index = 0;
		if(name == "image1") {
			index = 1;
		}

		let images = js_images.querySelectorAll("img");

		images[index].src = URL.createObjectURL(file);
	}

	function collect_data(obj = {}) {

		const data = {};

		data.title  = 	title_input.value.trim();
		data.title1  = 	title1_input.value.trim();
		data.post = 	post_input.value.trim();
		data.post1 = 	post1_input.value.trim();
		data.vzkazy_order = vzkazy_order_input.value.trim();
		
		
		data.id 	 =	EDIT_ID;

		image  = image_input.files;
		image1  = image1_input.files;
		

		
		console.log(image);
		console.log(image1);

		// console.log("data", data);
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.title != "") 
			if (!isNaN(data.title)) {
				alert("Please enter title js");
				return;
			}

		if (data.title1 != "") 
			if (!isNaN(data.title1)) {
				alert("Please enter title1 js");
				return;
			}

		if (data.post != "") 
			if (!isNaN(data.post)) {
				alert("Please enter a valid post js");
				return;
			}

		if (data.post1 != "") 
			if (!isNaN(data.post1)) {
				alert("Please enter a valid post1 js");
				return;
			}

		// if (image.length == 0 && obj.data_type != "edit_row") {
		// 	alert("Please enter a valid main image");
		// 	return;
		// } 
	
		const formdata = new FormData();

		if (image.length > 0) {
			formdata.append("image", image[0]);
		}

		if (image1.length > 0) {
			formdata.append("image1", image1[0]);
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

		data.append("model", "vzkazy");
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

						js_table_div.innerHTML = obj.data;
					} else {
						show_add_new();
						error_div.classList.remove("hide");
						error_div.innerHTML = obj.message;

						// vraceni hodnot do formulare pri erroru
						title_input.value 	= obj.data.title;
						post_input.value 	= obj.data.post;
						// alert(obj.message);
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
						show_add_new();
						error_div.classList.remove("hide");
						error_div.innerHTML = obj.message;

						// vraceni hodnot do formulare pri erroru
						title_input.value 	= obj.data.title;
						post_input.value 	= obj.data.post;
						// alert(obj.message);
					}
				}
			}
		}
	}

	function edit_row(e) {

		obj = JSON.parse(e.currentTarget.getAttribute("info"));
		// console.log(obj);

		title_input.value 	= obj.title;
		title1_input.value 	= obj.title1;
		post_input.value 	= obj.post;
		post1_input.value 	= obj.post1;
		vzkazy_order_input.value 	= obj.vzkazy_order;
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
		console.log(obj);

		obj.disabled = obj.disabled ? 0 : 1;

		const formdata = new FormData();
		formdata.append("data", JSON.stringify(obj));
		formdata.append("data_type", "change_status_row");
		send_data_files(formdata);
	}

</script>

<?php $this->view("admin/footer", $data); ?>