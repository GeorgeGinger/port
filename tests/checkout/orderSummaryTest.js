import { renderOrderSummary } from "../../scripts/checkout/orderSummary.js";
import {loadFromStorage, cart} from '../../data/cart.js';
import {loadProducts} from '../../data/products.js';


describe('Test suite: renderOrderSummary', () => {

	// nektere promenna jsme museli kvuli scope definovat pred funkcemi
	const productId1 = "e43638ce-6aa0-4b85-b27f-e1d07eb678c6";
	const productId2 = "15b6fc6f-327a-4ec4-896f-486349e85a3d";
	let testContainer = '';

	// done je fce ktera zpusobi ze se v kodu bude pokracovat a  se kompletne nacte
	beforeAll((done) => {
		loadProducts(() => {
			done();
		});
		
	});

	// funkce ktera probehne pred kazdym testem
	beforeEach(() => {
		// mock a function
		spyOn(localStorage, 'setItem');

		// test container vytvoreny v tests.html
		testContainer = document.querySelector('.js-test-container');
		// vytvoreni elementu ktere testovany kod vyzaduje ale nevytvari
		testContainer.innerHTML = 
		`
			<div class="js-order-summary"></div>
			<div class="js-return-to-home-link"></div>
			<div class="js-payment-summary"></div>
		`;

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
	});

	afterEach(() => {
		// vymazani textu ktery se zobrazuje pred vysledky testu
		testContainer.innerHTML = '';
	});

	// test vzhledu stranky
	it('displays the cart', () => {

		expect(
			document.querySelectorAll('.js-cart-item-container').length
		).toEqual(2);

		expect(
		document.querySelector(`.js-product-quantity-${productId1}`).innerText
		).toContain('Quantity: 2');
		expect(
		document.querySelector(`.js-product-quantity-${productId2}`).innerText
		).toContain('Quantity: 10');

		
	});

	it('removes a product',() => {

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

	});
});