let EDIT_ID = "";

	const show_add_box 		 = document.querySelector(".add_new");
	const button_edit_onform = document.querySelector(".js_button_edit");
	const button_add_onform  = document.querySelector(".js_button_add");

	const table				 = document.querySelector(".js_table");

	const name_input 		 = document.querySelector("#name");

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
		}
	}

	function collect_data(obj = {}) {

		const data = {};

		data.name  = name_input.value.trim();
		data.id		= EDIT_ID;

		// console.log("name", data.name);
		// console.log("data", data.email);
		// console.log("data_type", obj.data_type);
		// console.log("EDIT_ID", EDIT_ID);

		// prazdny retezec nebo neni cislo
		if (data.name == "" || !isNaN(data.name)) {
			alert("Please enter a valid name name js");
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

		ajax.open("POST", "ajax_nofiles", true);
    // pokud je script umisten v prislusnem souboru wiev
		// ajax.open("POST", "<?=ROOT?>ajax_nofiles", true);

		data.append("core", "game_core");
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
				
				} else if (obj.data_type == "refresh_table") {

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

	const	obj = JSON.parse(e.currentTarget.getAttribute("info"));

		name_input.value = obj.name;
		EDIT_ID				 = parseInt(obj.id);

		show_add_new(obj);
	}

	function refresh_table() {
		
		const formdata = new FormData();

		const data = {};

		formdata.append("data", JSON.stringify(data));
		formdata.append("data_type",  "refresh_table");

		send_data_files(formdata);
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
		formdata.append("data_type", "change_status_player");
		send_data_files(formdata);

	}

	setInterval(() => {
		refresh_table();
		// window.location.href = '<?=ROOT?>home';
	}, 1000*10);