// named export
import {cart, removeFromCart, updateCartQuantity, editQuantityItem, updateDeliveryOption} from '../data/cart.js';
import {products} from '../data/products.js';
import {formatCurrency} from './utils/money.js';
import {deliveryOptions} from '../data/deliveryoptions.js'
// default export esm library
import dayjs from 'https://unpkg.com/dayjs@1.11.10/esm/index.js';




let cartSummaryHTML;

cart.forEach((cartItem) => {

	const productId = cartItem.productId;

	let matchingProduct;

	products.forEach((product) => {
		
		if(product.id === productId) {
			matchingProduct = product;
		}
	});

  let deliveryDate;
  const today = dayjs();

  deliveryOptions.forEach((deliveryOption) => {
    if(deliveryOption.id === cartItem.deliveryOptionId) {
      deliveryDate = today.add(deliveryOption.deliveryDays, 'days');
    }
  })

  
  const dateString = deliveryDate.format('dddd, MMMM D');



	cartSummaryHTML +=
	`
	    <div class="cart-item-container js-cart-item-container-${matchingProduct.id}">
            <div class="delivery-date">
              Delivery date: ${dateString}
            </div>

            <div class="cart-item-details-grid">
              <img class="product-image"
                src="${matchingProduct.image}">

              <div class="cart-item-details">
                <div class="product-name">
                  ${matchingProduct.name}
                </div>

                <div class="product-price">
                  $${formatCurrency(matchingProduct.priceCents)}
                </div>

                <div class="product-quantity">

                
                    Quantity: <span class="quantity-label js-quantity-label-${matchingProduct.id}">${cartItem.quantity}</span>
                 

                  <span class="update-quantity-link link-primary js-update-quantity-link" data-product-id="${matchingProduct.id}">
                    Update
                  </span>

                  <input class="quantity-input js-quantity-input-${matchingProduct.id}" value="${cartItem.quantity}">

                  <span class="js-save-quantity-link link-primary save-quantity-link" data-product-id="${matchingProduct.id}">Save</span>

                  <span class="delete-quantity-link link-primary js-delete-link" data-product-id="${matchingProduct.id}">
                    Delete
                  </span>

                </div>
              </div>

              <div class="delivery-options">
                <div class="delivery-options-title">
                  Choose a delivery option:
                </div>
              ${deliveryOptionHTML(matchingProduct, cartItem)}
              </div>
            </div>
          </div>
	`;
});


function deliveryOptionHTML(matchingProduct, cartItem) {
  let html;

  deliveryOptions.forEach((deliveryOption) => {

    const today = dayjs();
    const deliveryDate = today.add(
      deliveryOption.deliveryDays,
      'days'
    );
    const dateString = deliveryDate.format(
      'dddd, MMMM D'
    );

    const priceString = deliveryOption.priceCents 
    === 0 
    ? 'FREE' 
    : `${formatCurrency(deliveryOption.priceCents / 100)}`;


    const isChecked = deliveryOption.id === cartItem.deliveryOptionId;
    

    html += `
     <div class="delivery-option js-delivery-option"
      data-product-id="${matchingProduct.id}" 
      data-delivery-option-id="${deliveryOption.id}" >
        <input type="radio"
         ${isChecked ? 'checked' : ''}
          class="delivery-option-input"
          name="delivery-option-${matchingProduct.id}">
        <div>
          <div class="delivery-option-date">
            ${dateString}
          </div>
          <div class="delivery-option-price">
            $${priceString} - Shipping
          </div>
        </div>
      </div>
    `
  });

  return html;
}

function displayCartQuantity() {
  document.querySelector('.js-return-to-home-link').innerHTML = updateCartQuantity()+' items';
}

document.querySelector('.js-order-summary').innerHTML = cartSummaryHTML;

document.querySelectorAll('.js-delete-link').forEach((link) => {
  link.addEventListener('click', () => {
    const productId = link.dataset.productId;
    removeFromCart(productId);

    const container = document.querySelector(
        `.js-cart-item-container-${productId}
      `);

    container.remove();
    displayCartQuantity();
    
  });
}); 

const updateButtons = document.querySelectorAll('.js-update-quantity-link');
updateButtons.forEach((updateButton) => {
  updateButton.addEventListener('click', () => {
    let productId = updateButton.dataset.productId; 

    document.querySelector(`.js-cart-item-container-${productId}`).classList.add('is-editing-quantity');
  });
});


const saveButtons = document.querySelectorAll('.js-save-quantity-link');
saveButtons.forEach((saveButton) => {
  saveButton.addEventListener('click', () => {
    let productId = saveButton.dataset.productId;

      let quantity = Number(document.querySelector(`.js-quantity-input-${productId}`).value);

      document.querySelector(`.js-cart-item-container-${productId}`).classList.remove('is-editing-quantity');

      // editovani hodnoty v cart
      editQuantityItem(productId , quantity);
      // aktualizace celkove zmeny mnozstvi v kosiku
      displayCartQuantity();
      // aktualizaca mnozstvi u danne polozky
      document.querySelector(`.js-quantity-label-${productId}`).innerHTML = quantity;
  });
});

document.querySelectorAll('.js-delivery-option').forEach((element) => {
  element.addEventListener('click', () => {
    const {productId, deliveryOptionId} = element.dataset;
    updateDeliveryOption(productId, deliveryOptionId);
  });
});



  displayCartQuantity();