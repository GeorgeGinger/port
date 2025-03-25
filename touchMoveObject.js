class TouchMoveElement {
	modifier = 5;
	touchPointX = null;
	touchPointY = null;
	styleL = null;
	styleT = null;


	constructor(target) {
		this.target = target;

		const { style } = this.target;

		style.boxSizing = "border-box";

		style.position = "relative";

		this.styleT = parseInt(getComputedStyle(this.target).top.replace("px",""));
		this.styleL = parseInt(getComputedStyle(this.target).left.replace("px",""));
		style.top   = getComputedStyle(this.target).top;
		style.left  = getComputedStyle(this.target).left;
			
		
		this.rect    = this.target.getBoundingClientRect();
		style.width  = `${this.rect.width}px`;
		style.height = `${this.rect.height}px`;

		this.touchPointCoordinates = this.touchPointCoordinates.bind(this);
		this.moveElementDrag = this.moveElementDrag.bind(this);
		
		window.addEventListener("touchmove", this.moveElementDrag, { passive: false });
		
	}

	removeListener() {
		console.log("remove touchmove");
		window.removeEventListener("touchmove", this.moveElementDrag);
	}

	touchPointCoordinates(event) {
		const touch = event.touches[0];
		this.touchPointX = touch.clientX;
		this.touchPointY = touch.clientY;
		console.log("x",this.touchPointX,"y",this.touchPointY);
		console.log("rect x",event.target.getBoundingClientRect().left,"rect y",event.target.getBoundingClientRect().top);

	}

	moveElementDrag(event) {
		event.preventDefault();
		
		const { style } = this.target;

		console.log("x",this.touchPointX,"y",this.touchPointY);
		console.log("move L ",event.touches[0].clientX);
		console.log("move T ",event.touches[0].clientY);
		console.log("rect L ",this.rect.left);
		console.log("rect T ",this.rect.top);
		console.log("posun L",this.touchPointX - this.rect.left);
		console.log("posun T",this.touchPointY - this.rect.top);

		console.log("style before",this.styleL, this.styleT);

		style.left = `${this.styleL + event.touches[0].clientX - this.rect.left - (this.touchPointX - this.rect.left)}px`; 	
		style.top = `${this.styleT + event.touches[0].clientY - this.rect.top - (this.touchPointY - this.rect.top)}px`; 	
		

		console.log("style after",style.left, style.top);
	}

	static applyMove(target) {
		return new TouchMoveElement(target);
	}
}

let OLD_TOUCH_MOVE_ELEMENT = null;
let ELEMENT_TOUCH_MOVE_STATUS = false;

function elementTouchMove() {
	if(ELEMENT_TOUCH_MOVE_STATUS) {
		console.log("remove touchstart")
		window.removeEventListener("touchstart", touchstartEvent);

		if(OLD_TOUCH_MOVE_ELEMENT != null ) {
			OLD_TOUCH_MOVE_ELEMENT.removeListener();
		}

		ELEMENT_TOUCH_MOVE_STATUS = false;
	}else {
		console.log("add touchstart");
		window.addEventListener("touchstart", touchstartEvent);
		ELEMENT_TOUCH_MOVE_STATUS = true;
	}
}

function touchstartEvent(event) {
	// console.log(event.target);
			
	if(event.target != window) {
		console.log("vytvorena clasa TouchMoveElement");

		let new_TOUCH_MOVE_ELEMENT = TouchMoveElement.applyMove(event.target);
		new_TOUCH_MOVE_ELEMENT.touchPointCoordinates(event);

		if(OLD_TOUCH_MOVE_ELEMENT != null ) {
			OLD_TOUCH_MOVE_ELEMENT.removeListener();
		}

		OLD_TOUCH_MOVE_ELEMENT = new_TOUCH_MOVE_ELEMENT;
	}

}


