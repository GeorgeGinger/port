import { renderOrderSummary } from "../../scripts/checkout/orderSummary.js";
import {loadFromStorage, cart} from '../../data/cart.js';


describe('Test suite: renderOrderSummary', () => {

	// test vzhledu stranky
	it('displays the cart', () => {
		const testContainer = document.querySelector('.js-test-container');
		testContainer.innerHTML = 
		`
		<div class="js-order-summary"></div>
		<div class="js-return-to-home-link"></div>
		`;

		const productId1 = "e43638ce-6aa0-4b85-b27f-e1d07eb678c6";
		const productId2 = "15b6fc6f-327a-4ec4-896f-486349e85a3d";
		spyOn(localStorage, 'getItem').and.callFake(() => {
			return JSON.stringify([{
				productId: productId1,
				quantity: 2,
				deliveryOptionId: '2'
			},{
				productId: "15b6fc6f-327a-4ec4-896f-486349e85a3d",
				quantity: 10,
				deliveryOptionId: '1'
			}]);
		});
		// nacteni cart z prazdneho localStorage
		loadFromStorage();

		console.log(JSON.parse(localStorage.getItem('cart')));

		renderOrderSummary();

		expect(
			document.querySelectorAll('.js-cart-item-container').length
		).toEqual(2);

		expect(
		document.querySelector(`.js-product-quantity-${productId1}`).innerText
		).toContain('Quantity: 2');
		expect(
		document.querySelector(`.js-product-quantity-${productId2}`).innerText
		).toContain('Quantity: 10');

		// vymazani textu ktery se zobrazuje pred vysledky testu
		testContainer.innerHTML = '';
	});

	it('removes a product',() => {

		spyOn(localStorage, 'setItem');

		const testContainer = document.querySelector('.js-test-container');
		testContainer.innerHTML = 
		`
			<div class="js-order-summary"></div>
			<div class="js-return-to-home-link"></div>
			<div class="js-payment-summary"></div>
		`;

		const productId1 = "e43638ce-6aa0-4b85-b27f-e1d07eb678c6";
		const productId2 = "15b6fc6f-327a-4ec4-896f-486349e85a3d";
		spyOn(localStorage, 'getItem').and.callFake(() => {
			return JSON.stringify([{
				productId: productId1,
				quantity: 2,
				deliveryOptionId: '2'
			},{
				productId: "15b6fc6f-327a-4ec4-896f-486349e85a3d",
				quantity: 10,
				deliveryOptionId: '1'
			}]);
		});
		// nacteni cart z prazdneho localStorage
		loadFromStorage();

		renderOrderSummary();

		// vymazeme product 1
		document.querySelector(`.js-delete-link-${productId1}`).click();

		// zkontrolujeme mnozstvi productu na strance
		expect(
			document.querySelectorAll('.js-cart-item-container').length
		).toEqual(1);

		// vymazali jsme spravny product ze stranky?
		expect(
			document.querySelector(`.js-cart-item-container-${productId1}`)
		).toEqual(null);

		// zustal na strance spravny product?
		expect(
			document.querySelector(`.js-cart-item-container-${productId2}`)
		).not.toEqual(null);

		// v cartu by mel zustat jeden product
		expect(
			cart.length
		).toEqual(1);

		// zustal v cartu spravny product?
		expect(
			cart[0].productId
		).toEqual(productId2);

		testContainer.innerHTML = '';
	});
});