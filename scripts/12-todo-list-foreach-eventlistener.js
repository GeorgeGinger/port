

console.log(localStorage.getItem('todoList'));

const todoList = localStorage.getItem('todoList') ? JSON.parse(localStorage.getItem('todoList')) : [];
	
renderTodoList();

function renderTodoList() {
	// vymaze a znovu vyplni prostor pro vypis todo listu
	let todoListHTML = '';

	todoList.forEach((todoObject, i) => {

		const { name, dueDate } = todoObject;

		const html = `
		<div>
			${name} 
		</div>
		<div>
			${dueDate}
		</div>
			<button class="delete-todo-button js-delete-todo-button">Delete</button>
			`;

		todoListHTML += html;
	})

	document.querySelector('.js-todo-list').innerHTML = todoListHTML;

	document.querySelectorAll('.js-delete-todo-button')
	.forEach((deleteButton, i) => {
		deleteButton.addEventListener('click', () => {
			todoList.splice(i,1);
				saveToStorage();
				renderTodoList();
		});
	});
}

document.querySelector('.js-add-todo-button')
	.addEventListener('click', () => {
		addTodo();
	});

deleteListenery();

function addTodo() {
	const nameInputElement = document.querySelector('.js-name-input');
	const name = nameInputElement.value;

	const dateInputElement = document.querySelector('.js_due_date_input');
	const dueDate = dateInputElement.value;
	
	let error = [];

	document.querySelector('.js-name-error').innerHTML = "";
	document.querySelector('.js-date-error').innerHTML = "";

	if(name == "") {
		error.push({name : 'Nezadali jste název položky!'}); 
		document.querySelector('.js-name-error').innerHTML = 'Nezadali jste název položky!';
	}

	if(dueDate == "") {
		error.push({dueDate : 'Nezadali jste datum!'});
		document.querySelector('.js-date-error').innerHTML = 'Nezadali jste datum!';
	}

	if(error.length == 0) {
		todoList.push({
			// name: name,
			// dueDate: dueDate
			name,
			dueDate
		});

		nameInputElement.value = "";
		dateInputElement.value = "";
	}

	saveToStorage();
	renderTodoList();
}

function saveToStorage() {
	localStorage.setItem('todoList', JSON.stringify(todoList));
}