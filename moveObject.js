// let modifier = 5;

// window.addEventListener('keydown', (event) => {

// 	const { style } = myButton;

// 	switch (event.key) {
// 		case 'ArrowUp': style.top = `${parseInt(style.top) - modifier}px`; 	
// 		break;

// 		case 'ArrowDown': style.top = `${parseInt(style.top) + modifier}px`; 
// 		break;

// 		case 'ArrowLeft': style.left = `${parseInt(style.left) - modifier}px`; 
// 		break;

// 		case 'ArrowRight': style.left = `${parseInt(style.left) + modifier}px`; 
// 		break;
// 	}
// });

class MoveElement {
	modifier = 5;

	constructor(target) {
		this.target = target;

		const { style } = this.target;

		this.rect = this.target.getBoundingClientRect();

		style.boxSizing= "border-box";

		style.position = "relative";

		if((getComputedStyle(this.target).position == "relative")) {
			style.top = getComputedStyle(this.target).top;
			style.left = getComputedStyle(this.target).left;
		}
		
		// style.left = `${rect.left}px`;
		// style.top = `${rect.top}px`;
		style.width = `${this.rect.width}px`;
		style.height = `${this.rect.height}px`;

		// aby bylo mozno odstranit listener
		this.moveElement = this.moveElement.bind(this);

		window.addEventListener("keydown", this.moveElement);

	}

	removeListener() {
		console.log("remove keydown");
		window.removeEventListener("keydown", this.moveElement);
	}

	moveElement(event) {
		const { style } = this.target;

		switch (event.key) {
			case 'ArrowUp': style.top = `${parseInt(style.top) - this.modifier}px`; 	
			break;

			case 'ArrowDown': style.top = `${parseInt(style.top) + this.modifier}px`; 
			break;

			case 'ArrowLeft': style.left = `${parseInt(style.left) - this.modifier}px`; 
			break;

			case 'ArrowRight': style.left = `${parseInt(style.left) + this.modifier}px`; 
			break;
	}
	}

	static applyMove(target) {
		return new MoveElement(target);
	}
}

let ELEMENT_MOVE_STATUS = false;
let OLD_MOVE_ELEMENT = null;

function elementMove() {
	if(ELEMENT_MOVE_STATUS) {
		console.log("remove click");
		window.removeEventListener("click", mouseClickEvent);

		if(OLD_MOVE_ELEMENT != null ) {
			OLD_MOVE_ELEMENT.removeListener();
		}

		ELEMENT_MOVE_STATUS = false;
	}else {
		console.log("add click")
		window.addEventListener("click", mouseClickEvent);
		ELEMENT_MOVE_STATUS = true;
	}
}

function mouseClickEvent(event) {
// console.log(event.target);
		
if(event.target != window) {
	console.log("vytvorena clasa MoveElement");

	let new_MOVE_ELEMENT = MoveElement.applyMove(event.target);

	if(OLD_MOVE_ELEMENT != null ) {
		OLD_MOVE_ELEMENT.removeListener();
	}

	OLD_MOVE_ELEMENT = new_MOVE_ELEMENT;
}
// console.log("MOVE_ELEMENT ", OLD_MOVE_ELEMENT);
// console.log("arr len", moveElementArr);
}


