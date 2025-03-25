let SELECTED_CELLS = [];
let SELECTED_E = [];
let ACTIVE_CELL = null;
let EDIT_MODE = false;
let DONT_EDIT = [
	"employeesNumber",
];

let thead = document.querySelector(".js-thead");
let tbody = document.querySelector(".js-tbody");
let td = document.querySelector("td");

let sub_menu = document.querySelector(".js-sub-menu");

let input = document.querySelector(".js-input");
let input_holder = document.querySelector(".js-input-holder");

let main_menu_button = document.querySelector(".js-main-menu-button");
let main_menu = document.querySelector(".js-main-menu");

let row_info = document.querySelector(".js-row-info");
let column_info = document.querySelector(".js-column-info");
let column_name = document.querySelector(".js-column-name-info");

let lastTouchTime = 0;
const doubleClickThreshold = 300; // Time in milliseconds



send_data({ data_type: "read" });

	// add eventListeners

	// window.document.body.addEventListener("keypress", key_was_pressed);
	window.document.body.addEventListener("keydown", key_was_pressed);
	tbody.addEventListener("click", tbody_clicked);
	tbody.addEventListener("contextmenu", show_sub_menu);
	main_menu_button.addEventListener("click", show_main_menu);

function show_main_menu(e=false, bol=true) {

	if(bol) {
		main_menu.classList.toggle("hide");
	}else {
		main_menu.classList.add("hide");
	}
	
}

function show_sub_menu(e=false, bol=true) {
	if(bol) {
		console.log(e.currentTarget);
		console.log("show sub mane", e.clientX, e.clientY);
		// zabrání zobrazeni menu prohlizece
		e.preventDefault();
		update_cell();
		select_by_mouse(e);
		// umísteni sub_menu u cursoru
		sub_menu.style = `left: ${e.clientX}px; top: ${e.clientY}px;`;
		sub_menu.classList.remove("hide");
	}else {
		sub_menu.classList.add("hide");
	}
	
	return false;
}

function send_data(data = "") {
	// console.log("send data");
	let ajax = new XMLHttpRequest;
	ajax.addEventListener("readystatechange", function (e) {
		if (ajax.readyState == 4 && ajax.status == 200) {
			// console.log("prijata data");
			return handle_result(ajax.responseText);
			
		}

	});

	ajax.open("POST", "api.php", true);
	ajax.send(JSON.stringify(data));

	show_main_menu(false, false);
}

function handle_result(result) {

// console.log("handle result");
// console.log(result);

	if (result == "") return;

	let OBJ = JSON.parse(result);

	if (OBJ.data_type == "read") {
		refresh_table(OBJ.data);

	}else if (OBJ.data_type == "save") {

		send_data({ data_type: "read" });

	}else if (OBJ.data_type == "prepareNewEmployee") {

		prepareAddNewEmployee(OBJ.data);

	}else if (OBJ.data_type == "delete") {

		send_data({ data_type: "read" });

	}
	
	return OBJ;
}

function refresh_table(data) {
// console.log("refrech table");
	let temp = "";

	tbody.innerHTML = "";

	thead.innerHTML = "";

	temp += "<tr>";

	for (let key in data[0]) {
		temp += "<th>" + key + "</th>";
	}
	temp += "</tr>";

	thead.innerHTML = temp;
	temp = "";
	for (let i = 0; i < data.length; i++) {
		temp += "<tr>";

		let j = 0;
		for (let key in data[i]) {
			temp += `<td class="row_${i} column_${j} js-td" column="${j}" column_name="${key}" row='${i}'>${data[i][key]}</td>`;
			j++;
		}
		temp += "</tr>";
		
	}
	tbody.innerHTML = temp;
}

function prepareAddNewEmployee(data) {

	let temp = "";

	let i =  data.length;
		temp += "<tr tosave='tosave'>";

		let j = 0;
		for (let key in data[0]) {
			temp += `<td class="row_${i} column_${j} js-td" column="${j}" column_name="${key}" row='${i}'>New value</td>`;
			j++;
		}
		temp += "</tr>";
		
	tbody.innerHTML += temp;
}

function addEmployee() {
		// console.log("add employee");
		const OBJ = send_data({ data_type: "read" });
	
}

function deleteRow() {

	// console.log(SELECTED_CELLS.length);

	if(SELECTED_CELLS.length == 0) {
		alert("Nothing selected!");
		show_main_menu(false, false);
		return;
	}
		

	if(!confirm("Would you like to fire this employee? It's your favorite one! ;-))")) {
		return;
	}

	data = [];
	object = {};

	ACTIVE_CELL = SELECTED_CELLS[0];

	// console.log(ACTIVE_CELL.parentElement.children);

	const row = ACTIVE_CELL.parentElement.children;

	for (let i = 0; i < row.length; i++) {
		object[row[i].getAttribute("column_name")] = row[i].innerHTML;
	}
	data.push(object);

	let main_object = {
		data:data,
		data_type: "delete"
	}
	send_data(main_object);
	
}

function refresh_prevent(event) {
	event.preventDefault();
}

function edit() {

	window.addEventListener('beforeunload', refresh_prevent);
	// window.addEventListener('beforeunload', (event) => {
	// 	event.preventDefault();
	// 	event.returnValue = true;
	// });

	if(SELECTED_CELLS[0].length == 0)
		return;

	// first check if cell is editable
	let columnName = SELECTED_CELLS[0].getAttribute("column_name");

	// kontrola zda je bunka editovatelna
	if (DONT_EDIT.includes(columnName)) {
		return;
	}

	if(SELECTED_CELLS[0] != ACTIVE_CELL) {

		console.log("edit");

		ACTIVE_CELL = SELECTED_CELLS[0];

		// zmereni delky okynka tabulky do ktere chceme umistit input
		let delka_pole = (ACTIVE_CELL.offsetWidth-11) + "px";
		let vyska_pole = (ACTIVE_CELL.offsetHeight) + "px";
		let delka_inputu = (ACTIVE_CELL.offsetWidth-10) + "px";
		let vyska_inputu = (ACTIVE_CELL.offsetHeight-5) + "px";

		// nacteni hodnoty co byla v bunce do inputu
		if(ACTIVE_CELL.innerHTML == "New value") {
			input.value = "";
		}else {
			input.value = ACTIVE_CELL.innerHTML;
		}
		
		
		ACTIVE_CELL.innerHTML = "";
		// umisteni inputu do bunky
		ACTIVE_CELL.insertBefore(input, null);

		// aby se zachovaly rozmery okynek tabulky
		input.style.width = delka_inputu;
		ACTIVE_CELL.style.width = vyska_pole;
		input.style.height = vyska_inputu;
		ACTIVE_CELL.style.width = delka_pole;

		// zobrazeni inputu
		input.classList.remove("hide");
		input.focus();

		EDIT_MODE = true;
		show_sub_menu(false, false);
		return;
}

update_cell();
show_sub_menu(false, false)
	// show_sub_menu(false, false)
}

function update_cell() {
console.log("update_cell");
// hodnotu vlazenou do inputu vlozi do bunky
// vrati input z bunky zped do input_holderu
//  vymaze value v inputu
//  do prida class hide

	if(EDIT_MODE) {
		input_holder.insertBefore(input, null);

		ACTIVE_CELL.innerHTML = input.value;

		input.value = "";

		input.classList.add("hide");

	}
	
	EDIT_MODE = false;
}

function key_was_pressed(e) {

	switch (e.key) {
		case "Enter":

			if (!EDIT_MODE && SELECTED_CELLS.length > 0) {

				edit();
	
			} else if (EDIT_MODE && SELECTED_CELLS.length > 0) {
				// console.log("enter update");
				update_cell();
	
			}
			break;
		case "ArrowDown":
			select_by_keyboard("down");
			break;
		case "ArrowUp":
			select_by_keyboard("up");
			break;
		case "ArrowLeft":
			select_by_keyboard("left");
			break;
		case "ArrowRight":
			select_by_keyboard("right");
			break;
		case "Delete":
			delete_content();
			break;
	}
}

function delete_content() {
	for (let i = 0; i < SELECTED_CELLS.length; i++) {
			
		// first check if cell is editable
		let columnName = SELECTED_CELLS[i].getAttribute("columnName");

		if (DONT_EDIT.includes(columnName)) {
			continue;
		}

		SELECTED_CELLS[i].innerHTML = "";

	}
	sub_menu.classList.add("hide");
}

function tbody_clicked(e) {
	console.log("tbody_clicked");
	update_cell();
	show_main_menu(false, false);
	show_sub_menu(false, false);
	select_by_mouse(e);

}

function selectSellInfo() {
// zobrazi hodnoty o bunce na strance vlevo nahore
row_info.innerHTML = SELECTED_CELLS[0].getAttribute("row") ;
column_info.innerHTML = SELECTED_CELLS[0].getAttribute("column");
column_name.innerHTML = SELECTED_CELLS[0].getAttribute("column_name");
}

function select_by_mouse(e) {
	console.log("selected_by_mouse", e.target);

	if(e.target.classList.contains("js-td")) {
	// zruseni minule selectovane bunky
	let td_selected = document.querySelector(".selected");
	if (td_selected != null) {
		td_selected.classList.remove("selected");
	}

	// oznaceni nove selectovane bunky
		e.target.classList.add("selected");
		SELECTED_CELLS = [];
		SELECTED_CELLS.push(e.target);
		
		selectSellInfo();
	}

	console.log("SELECTED SELL",SELECTED_CELLS);
};

function select_by_keyboard(mode) {

	// console.log(mode);
	// console.log(SELECTED_CELLS);

	if (SELECTED_CELLS.length == 0) {
		return;
	}

	let to_select = cell_to_select(SELECTED_CELLS[0], mode);

	// console.log(to_select);

	if (to_select != null) {
		// zruseni minule se lectovane bunky
		let td_selected = document.querySelector(".selected");
		if (td_selected != null) {
			td_selected.classList.remove("selected");
		}

		// oznaceni nove selectovane bunky
		to_select.classList.add("selected");
		SELECTED_CELLS = [];
		SELECTED_CELLS.push(to_select);
		selectSellInfo();
	}
}

function cell_to_select(SELECTED_CELLS, mode) {

	// console.log(SELECTED_CELLS.classList);
	let row = SELECTED_CELLS.getAttribute("row");
	let column = SELECTED_CELLS.getAttribute("column");

	switch (mode) {
		case "up":
			row--;
			break;
		case "down":
			row++;
			break;
		case "left":
			column--;
			break;
		case "right":
			column++;
			break;
	}

	let td_selected = document.querySelector(".row_" + row + ".column_" + column);

	// console.log(td_selected);

	update_cell();

	return td_selected;
}

function colection_data() {

	if(!confirm("Are you sure you want to save this data?")) {
		return;
	}

	let data = [[],[]];
	let object = {};

	const toSave = tbody.querySelectorAll('[tosave]');
	// console.log("toSave",toSave);



	for (let i = 0; i < tbody.children.length; i++) {

		// console.log(tbody.children[i].getAttribute('tosave'));

		object = {};

		for (let x = 0; x < tbody.children[i].children.length; x++) {
			let column_name = tbody.children[i].children[x].getAttribute("column_name");
			
			// pokud zvolim save s inputem v bunce
			if(tbody.children[i].children[x].children[0]) {
				// console.log( tbody.children[i].children[x].children[0].value);
				object[column_name] = tbody.children[i].children[x].children[0].value;
			}else {
				// console.log( tbody.children[i].children[x].innerHTML);
				object[column_name] = tbody.children[i].children[x].innerHTML;
			}

		}

		if(tbody.children[i].getAttribute("tosave") == 'tosave') {
			// console.log('tosave obj push');
			// data pro insert
			data[1].push(object);

		}else {
			// data pro update
			data[0].push(object);
		}
	}
	
	// protoze v api.php ocekavame object
	// console.log("data save object", data);
	let main_object = {
		data:data,
		data_type:"save"
	}

	window.removeEventListener('beforeunload', refresh_prevent);
		
	send_data(main_object);
	show_main_menu(false, false);
}