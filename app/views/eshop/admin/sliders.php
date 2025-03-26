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
		flex: 1;
		width: 10px;
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
			<form class="form-horizontal style-form" method="get">

				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label" for="header">Header</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="header" id="header"
							placeholder="Enter product header" style="margin-bottom: 1rem">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label" for="header1">Header1</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="header1" id="header1"
							placeholder="Enter product header1" style="margin-bottom: 1rem">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label" for="text">Text</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="text" id="text"
							placeholder="Enter product text" style="margin-bottom: 1rem">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label" for="link">Link</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="link" id="link"
							placeholder="Enter product link" style="margin-bottom: 1rem">
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
					<label class="col-sm-2 col-sm-2 control-label" for="image1">Image1 (optional)</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="image1" onchange="display_image(this.files[0],this.name)" id="image1"
							placeholder="Image1" style="margin-bottom: 1rem">
					</div>
				</div>

				<div class="js_images edit_product_images">

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
			
<div class="js_table_div">
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

	const header_input  	 = document.querySelector("#header");
	const header1_input	 	 = document.querySelector("#header1");
	const text_input 		 = document.querySelector("#text");
	const link_input 	 	 = document.querySelector("#link");
	const image_input 	 	 = document.querySelector("#image");
	const image1_input 		 = document.querySelector("#image1");

	const add_new_inputs = document.querySelectorAll(".add_row input,select");

	function show_add_new(obj = {}) {

		js_images.innerHTML = `<img src="<?= ROOT ?>${obj.image}" >`;
		js_images.innerHTML += `<img src="<?= ROOT ?>${obj.image1}" >`;

		if (show_add_box.classList.contains("hide")) {
			show_add_box.classList.remove("hide");
			button_add_onform.classList.remove("hide");
			add_new_inputs[0].focus();

			if(obj.button_type == "edit") {
				button_edit_onform.classList.remove("hide");
				button_add_onform.classList.add("hide");
			}

		} else {
			show_add_box.classList.add("hide");
			button_edit_onform.classList.add("hide");
			add_new_inputs[0].value = "";
		}
	}

	function display_image(file, name) {

		let index = 0;
		if(name == "image1") {
			index = 1;
		}

		let images = js_images.querySelectorAll("img");

		images[index].src = URL.createObjectURL(file);
	}

	function collect_data(obj = {}) {

		const data = {};

		data.header  = 	header_input.value.trim();
		data.header1 = 	header1_input.value.trim();
		data.text	 = 	text_input.value.trim();
		data.link 	 =	link_input.value.trim();
		
		data.id 	 =	EDIT_ID;

		image  = image_input.files;
		image1 = image1_input.files;
		

		console.log("data", data);
		console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.header == "" || !isNaN(data.header)) {
			alert("Please enter a valid product header");
			return;
		}

		if (data.header1 == "" || !isNaN(data.header1)) {
			alert("Please enter a valid header1 js" + data.header1);
			return;
		}

		if (data.text == "" || !isNaN(data.text)) {
			alert("Please enter a valid text");
			return;
		}

		if (data.link == "" || !isNaN(data.link)) {
			alert("Please enter a valid link");
			return;
		}

		if (image.length == 0 && obj.data_type != "edit_row") {
			alert("Please enter a valid main image");
			return;
		} 
	
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

		show_add_new();
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

		data.append("model", "sliders");
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

		header_input.value = obj.header;
		header1_input.value 	= obj.header1_input;
		text_input.value 	= obj.text;
		link_input.value 	 	= obj.link;
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