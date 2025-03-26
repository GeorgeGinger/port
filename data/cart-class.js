class Cart {
	// cartItems =  undefined;
	cartItems;
	// localStorageKey = undefined;
	// private properti
	#localStorageKey;

	constructor(localStorageKey) {
		this.#localStorageKey = localStorageKey;
		this.loadFromStorage();
	}

	#loadFromStorage() {
		this.cartItems = JSON.parse(localStorage.getItem(this.#localStorageKey)) || [];
	
		// [{
		// 	productId: "e43638ce-6aa0-4b85-b27f-e1d07eb678c6",
		// 	quantity: 2,
		// 	deliveryOptionId: '2'
		// },{
		// 	productId: "15b6fc6f-327a-4ec4-896f-486349e85a3d",
		// 	quantity: 10,
		// 	deliveryOptionId: '1'
		// }];
	}

	saveToStorage() {
		localStorage.setItem(this.#localStorageKey, JSON.stringify(this.cartItems));
	}

	addToCart(productId, quantity) {
  
		//  vyulovani matchingItem pri kliknuti na Add to cart
		let matchingItem;
	  
		// prohledani kosiku zdali v nem pridavany produkt uz je
		 this.cartItems.forEach((cartItem) => {
		  if(productId === cartItem.productId) {
			// ulozime refelenci item do matchingItem
			matchingItem = cartItem;
		  }
		 });
	  
		 if(matchingItem) {
		  // protoze matchingItem a item odkazuji na stejne pole v pameti matchingItemm.quantity++ znamena ze i item.quantity zvetsi o 1
		  matchingItem.quantity += quantity;
		 }else {
			this.cartItems.push({
			  productId,
			  quantity
			});
		 }
	
		 this.saveToStorage();
	}

	removeFromCart(productId) {
		const newCart = [];
	
		this.cartItems.forEach((cartItem, index) => {
			if(cartItem.productId !== productId) {
			  newCart.push(cartItem);
			}
		  });
	
		  this.cartItems = newCart;
	
		  this.saveToStorage();
	}

	  updateDeliveryOption(productId, deliveryOptionId) {

		//  vyulovani matchingItem pri kliknuti na Add to cart
		let matchingItem;
		
		// prohledani kosiku zdali v nem pridavany produkt uz je
		this.cartItems.forEach((cartItem) => {
		if(productId === cartItem.productId) {
			// ulozime refelenci item do matchingItem
			matchingItem = cartItem;
		}
		});
	
		matchingItem.deliveryOptionId = deliveryOptionId;
	
		this.saveToStorage();
	}

	editQuantityItem(productId, quantity) {
  
		//  vyulovani matchingItem pri kliknuti na Add to cart
		let matchingItem;
	  
		// prohledani kosiku zdali v nem pridavany produkt uz je
		 this.cartItems.forEach((cartItem) => {
		  if(productId === cartItem.productId) {
			// ulozime refelenci item do matchingItem
			matchingItem = cartItem;
		  }
		 });
	  
		 if(matchingItem) {
		  // protoze matchingItem a item odkazuji na stejne pole v pameti matchingItemm.quantity++ znamena ze i item.quantity zvetsi o 1
		  matchingItem.quantity = quantity;
		 }else {
			this.cartItems.push({
			  productId,
			  quantity,
			  deliveryOptionId: 1
			});
		 }
	
		 this.saveToStorage();
	}

	updateCartQuantity() {
		//  vynulovani quantity pred spocitanim
		let cartQuantity = 0;
		this.cartItems.forEach((cartItem) => {
		cartQuantity += cartItem.quantity;
		});

		return cartQuantity;
	}
}

const cart =new Cart('cart-oop');
const businessCart =new Cart('cart-business');


 
console.log(cart);
console.log(businessCart);





