export let cart = JSON.parse(localStorage.getItem('cart')) || [];

// [{
// 	productId: "e43638ce-6aa0-4b85-b27f-e1d07eb678c6",
// 	quantity: 2
// },{
// 	productId: "15b6fc6f-327a-4ec4-896f-486349e85a3d",
// 	quantity: 10
// }];

export function saveToStorage() {
	localStorage.setItem('cart', JSON.stringify(cart));
}

export function addToCart(productId) {
  
	//  vyulovani matchingItem pri kliknuti na Add to cart
	let matchingItem;
  
	const quantity = Number(document.querySelector(`.js-quantity-selector-${productId}`).value);
  
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