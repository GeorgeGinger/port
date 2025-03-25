let SHOW_ELEMENT = null;

// console.log("body",document.querySelector("body").children);

// console.log(document.children);
// console.log(document.children.length);

// console.log(document.children[0].children);
// console.log(document.children[0].children.length);


// console.log(document.children[0].children[1].children);
// console.log(document.children[0].children[1].children.length);

// console.log(("chidren" in document.children[0].children[1].children[0].children));
// console.log(document.children[0].children[1].children[0].children.length);


// const arr = window.document.children;

// for(let i=0; i < arr.length; i++) {
// 	console.log(arr[i]);
// }


// rekurzivni fce preda pole vsech elemntu na strance
// function rek(parentEl) {

// 	let arrElments = [];

// 	// console.log("parentEl ",parentEl);

// 	arrElments.push(parentEl);

// 	if(("children" in parentEl) && parentEl.children.length > 0) {

// 		for(let i=0; i < parentEl.children.length; i++) {
// 			// console.log("for ",parentEl.children[i]);
// 				arrElments = arrElments.concat(rek(parentEl.children[i]));
// 		}
// 	}

// 	return arrElments; 
// }


// console.log(rek(document.querySelector("body")));

// rek(document.querySelector("body")).forEach(element => {
// 	element.addEventListener("mouseover", (event) => {
// 		selectedElement = event.currentTarget;
// 		console.log("mouseenter", selectedElement);
// 		selectedElement.classList.add("showElement");

// 		if(SHOW_ELEMENT != null && SHOW_ELEMENT !=selectedElement) {
// 			SHOW_ELEMENT.classList.remove("showElement");
// 		}

// 		SHOW_ELEMENT = selectedElement;
// 	});
// });

// rek(document.querySelector("body")).forEach(element => {
// 	element.addEventListener("mouseout", (event) => {
// 		selectedElement = SHOW_ELEMENT;
// 		console.log("mouseout", selectedElement);
// 		selectedElement.classList.remove("showElement");
		// selectedElement = event.target;
		// console.log("mouseout", selectedElement);
		// selectedElement.classList.remove("showElement");
// 	});
// });

let OLD_ELEMENT = document.querySelector("body");
let SHOW_ELEMENT_STATUS = false;

function show_element() {
	if(SHOW_ELEMENT_STATUS) {
		// OFF
		window.document.removeEventListener("mousemove", mouseMove);
		SHOW_ELEMENT_STATUS = false;
		OLD_ELEMENT.style.border = "";
		showElement.innerHTML = "Move Element ON";
		showElement.classList.add('buttonOn');
		showElement.classList.remove('buttonOff');
	}else {
		window.document.addEventListener("mousemove", mouseMove);
		SHOW_ELEMENT_STATUS = true;
		showElement.innerHTML = "Move Element OFF";
		showElement.classList.add('buttonOff');
		showElement.classList.remove('buttonOn');
	}
	
}

function mouseMove(event) {
	// console.log(OLD_ELEMENT);
		let selectedElement = event.target;
		if(selectedElement == OLD_ELEMENT) {
			// console.log(selectedElement);
			selectedElement.style.border = "solid 2px red";
		}else {
			OLD_ELEMENT.style.border = "";
	
		}
		
		OLD_ELEMENT = selectedElement;
}
