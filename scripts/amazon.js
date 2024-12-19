import {cart, addToCart, updateCartQuantity} from '../data/cart.js';
import {products, loadProducts} from '../data/products.js';
import {formatCurrency} from './utils/money.js';

loadProducts(renderProductGrid);

function renderProductGrid() {
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
                src="${product.getStarUrl()}">
              <div class="product-rating-count link-primary">
                ${product.rating.count}
              </div>
            </div>
  
            <div class="product-price">
              $${product.getPrice()}
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
  
            ${product.extraInfoHTML()}
  
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
  
  function displayCartQuantity() {
     document.querySelector('.js-cart-quantity').innerHTML = updateCartQuantity();
  }
  
  displayCartQuantity();
  
  
  function addAddedMsg(productId) {
    const messageElement = document.querySelector(`.js-added-to-cart-${productId}`);
  
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
      }, 2000);
    }
  }
  
  document.querySelectorAll('.js-add-to-cart').forEach((button) => {
    button.addEventListener('click', () => {
      // toto se stane kdyz kliknu na Add to cart
  
    const { productId } = button.dataset;
  
    addAddedMsg(productId);
  
    const quantity = Number(document.querySelector(`.js-quantity-selector-${productId}`).value);
    addToCart(productId , quantity);
    displayCartQuantity();
   
    //  end event listener
    });
  });
  
}

