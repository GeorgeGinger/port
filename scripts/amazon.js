import {products} from '../data/products.js';
import {cart} from '../data/cart.js';


let priductsHTML = '';

products.forEach((product) => {
	 priductsHTML += `
		<div class="product-container">
          <div class="product-image-container">
            <img class="product-image"
              src="${product.image}">
          </div>

          <div class="product-name limit-text-to-2-lines">
            ${product.name}
          </div>

          <div class="product-rating-container">
            <img class="product-rating-stars"
              src="images/ratings/rating-${product.rating.stars * 10}.png">
            <div class="product-rating-count link-primary">
              ${product.rating.count}
            </div>
          </div>

          <div class="product-price">
            $${(product.priceCents / 100).toFixed(2)}
          </div>

          <div class="product-quantity-container">
            <select class="js-quantity-selector-${product.id}">
              <option selected value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>

          <div class="product-spacer"></div>

          <div class="added-to-cart js-added-to-cart-${product.id}">
            <img src="images/icons/checkmark.png">
            Added
          </div>

          <button class="add-to-cart-button button-primary js-add-to-cart" data-product-id="${product.id}">
            Add to Cart
          </button>
        </div>`;
});

document.querySelector('.js-product-grid').innerHTML = priductsHTML;

let timeOut = false;
let timeOutId;

document.querySelectorAll('.js-add-to-cart').forEach((button) => {

 

  button.addEventListener('click', () => {
    // toto se stane kdyz kliknu na Add to cart

   const { productId } = button.dataset;
   
   quantity = Number(document.querySelector(`.js-quantity-selector-${productId}`).value);

   messageElement = document.querySelector(`.js-added-to-cart-${productId}`);

   messageElement.classList.add('added-to-cart-visible');

// vymazani minule pusteneho timeoutu aby mohlo dojit k vy
  if(timeOut == true) {
    clearTimeout(timeOutId);
    timeOut = false;
  }

  if(timeOut == false) {
    timeOutId = setTimeout(() => {
      timeOut = true;
      messageElement.classList.remove('added-to-cart-visible');
    }, 3000);
  }


  //  vyulovani matchingItem pri kliknuti na Add to cart
   let matchingItem;

  // prohledani kosiku zdali v nem pridavany produkt uz je
   cart.forEach((item) => {
    if(productId === item.productId) {
      // ulozime refelenci item do matchingItem
      matchingItem = item;
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

  //  vynulovani quantity pred spocitanim
   let cartQuantity = 0;
   cart.forEach((item) => {
    cartQuantity += item.quantity;
   });
   
   document.querySelector('.js-cart-quantity').innerHTML = cartQuantity;

  //  end event listener
  });

});


