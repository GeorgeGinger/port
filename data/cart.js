export let cart;

loadFromStorage();

export function loadFromStorage() {
	cart = JSON.parse(localStorage.getItem('cart')) || [];

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

export function saveToStorage() {
	localStorage.setItem('cart', JSON.stringify(cart));
}

export function addToCart(productId, quantity) {
  
	//  vyulovani matchingItem pri kliknuti na Add to cart
	let matchingItem;
  
	// prohledani kosiku zdali v nem pridavany produkt uz je
	 cart.forEach((cartItem) => {
	  if(productId === cartItem.productId) {
		// ulozime refelenci item do matchingItem
		matchingItem = cartItem;
	  }
	 });
  
	 if(matchingItem) {
	  // protoze matchingItem a item odkazuji na stejne pole v pameti matchingItemm.quantity++ znamena ze i item.quantity zvetsi o 1
	  matchingItem.quantity += quantity;
	 }else {
		cart.push({
		  productId,
		  quantity
		});
	 }

	 saveToStorage();
  }

export function editQuantityItem(productId, quantity) {
  
	//  vyulovani matchingItem pri kliknuti na Add to cart
	let matchingItem;
  
	// prohledani kosiku zdali v nem pridavany produkt uz je
	 cart.forEach((cartItem) => {
	  if(productId === cartItem.productId) {
		// ulozime refelenci item do matchingItem
		matchingItem = cartItem;
	  }
	 });
  
	 if(matchingItem) {
	  // protoze matchingItem a item odkazuji na stejne pole v pameti matchingItemm.quantity++ znamena ze i item.quantity zvetsi o 1
	  matchingItem.quantity = quantity;
	 }else {
		cart.push({
		  productId,
		  quantity,
		  deliveryOptionId: 1
		});
	 }

	 saveToStorage();
  }

  export function removeFromCart(productId) {
	const newCart = [];

	cart.forEach((cartItem, index) => {
		if(cartItem.productId !== productId) {
		  newCart.push(cartItem);
		}
	  });

	  cart = newCart;

	  saveToStorage();
  }

  export function updateCartQuantity() {
		//  vynulovani quantity pred spocitanim
		let cartQuantity = 0;
		cart.forEach((cartItem) => {
		cartQuantity += cartItem.quantity;
		});

		return cartQuantity;
	}

export function updateDeliveryOption(productId, deliveryOptionId) {

	//  vyulovani matchingItem pri kliknuti na Add to cart
	let matchingItem;
	
	// prohledani kosiku zdali v nem pridavany produkt uz je
	cart.forEach((cartItem) => {
	if(productId === cartItem.productId) {
		// ulozime refelenci item do matchingItem
		matchingItem = cartItem;
	}
	});

	matchingItem.deliveryOptionId = deliveryOptionId;

	saveToStorage();
}

export function loadCart(fun) {
  const xhr = new XMLHttpRequest();

  xhr.addEventListener('load', () => {
    console.log(xhr.response);

    fun();
  });

  xhr.open('GET', 'https://supersimplebackend.dev/cart');
  xhr.send();
}