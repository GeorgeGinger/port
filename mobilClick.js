class ClickAndHold {
	/*
	@param {EventTarget} target The HTML element to applay the event to 
	@param {Function} callback The function to run once the target is clicked and held 
	*/
	constructor(target, callback) {
		this.target = target;
		this.callback = callback;
		this.isHeld = false;
		this.activeHoldTimeout = null;

		["mousedown", "touchstart"].forEach(type => {
			// bind(this) pouzije this jako instance ClickAndHold
			this.target.addEventListener(type, this._onHoldStart.bind(this));
		});

		["mouseup", "mouseleave", "mouseout", "touchend", "touchcancel"].forEach(type => {
			// bind(this) pouzije this jako instance ClickAndHold
			this.target.addEventListener(type, this._onHoldEnd.bind(this));
		});
	}

	_onHoldStart() {
		this.isHeld = true;

		this.activeHoldTimeout = setTimeout(()=>{
			if(this.isHeld) {
				this.callback();
			}
		}, 1000);
	}

	_onHoldEnd() {
		this.isHeld = false;
		clearTimeout(this.activeHoldTimeout);
	}

	/*
	@param {EventTarget} target The HTML element to applay the event to 
	@param {Function} callback The function to run once the target is clicked and held 
	*/
	static apply(target, callback) {
		new ClickAndHold(target, callback);
	}
}

class Touch {
	/*
	@param {EventTarget} target The HTML element to applay the event to 
	@param {Function} callback The function to run once the target is clicked and held 
	*/
	constructor(target, callback) {
		this.target = target;
		this.callback = callback;
		this.isHeld = false;
		this.activeHoldTimeout = null;

		["touchstart"].forEach(type => {
			// bind(this) pouzije this jako instance ClickAndHold
			this.target.addEventListener(type, this._onHoldStart.bind(this), { passive: false });
		});

		["touchend", "touchcancel"].forEach(type => {
			// bind(this) pouzije this jako instance ClickAndHold
			this.target.addEventListener(type, this._onHoldEnd.bind(this));
		});
	}

	_onHoldStart(event) {
		event.preventDefault();
		this.isHeld = true;

		this.activeHoldTimeout = setTimeout(()=>{
			if(this.isHeld) {
				this.callback();
			}
		}, 1000);
	}

	_onHoldEnd() {
		this.isHeld = false;
		clearTimeout(this.activeHoldTimeout);
	}

	/*
	@param {EventTarget} target The HTML element to applay the event to 
	@param {Function} callback The function to run once the target is clicked and held 
	*/
	static apply(target, callback) {
		new ClickAndHold(target, callback);
	}
}

const myButton = document.getElementById("myButton");

// event listenr pro mobil
ClickAndHold.apply(myButton, () => {
	alert("Baff!!");
});

// ClickAndHold.apply(myButton, () => {
// 	elementMove();
// });
