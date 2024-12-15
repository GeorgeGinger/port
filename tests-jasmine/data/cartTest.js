import {addToCart, cart, loadFromStorage} from '../../data/cart.js';

describe('test suite: addToCard',() => {

	it('adds an axisting product in the cart', () => {
		// spusobi ze se do localStorage nic neulozi
		spyOn(localStorage, 'setItem');

		// pokud se pouzije nekde v prog localStorage.getItem preda se prazdne pole
		spyOn(localStorage, 'getItem').and.callFake(() => {
			return JSON.stringify([{
				productId: "e43638ce-6aa0-4b85-b27f-e1d07eb678c6",
				quantity: 1,
				deliveryOptionId: '2'
			}]);
		});
		// nacteni cart z prazdneho localStorage
		loadFromStorage();

		console.log(localStorage.getItem('cart'));

		addToCart('e43638ce-6aa0-4b85-b27f-e1d07eb678c6', 1);
		expect(cart.length).toEqual(1);
		// spocita kolikrat byla dana metoda volana musi byt predtim magt wdth spyOn
		expect(localStorage.setItem).toHaveBeenCalledTimes(1);
		expect(cart[0].productId).toEqual('e43638ce-6aa0-4b85-b27f-e1d07eb678c6');
		expect(cart[0].quantity).toEqual(2);
		
	});

	it('adds a new product to the cart', () => {

		// spusobi ze se do localStorage nic neulozi
		spyOn(localStorage, 'setItem');

		// pokud se pouzije nekde v prog localStorage.getItem preda se prazdne pole
		spyOn(localStorage, 'getItem').and.callFake(() => {
			return JSON.stringify([]);
		});
		// nacteni cart z prazdneho localStorage
		loadFromStorage();

		addToCart('e43638ce-6aa0-4b85-b27f-e1d07eb678c6', 1);
		expect(cart.length).toEqual(1);
		// spocita kolikrat byla dana metoda volana musi byt predtim magt wdth spyOn
		expect(localStorage.setItem).toHaveBeenCalledTimes(1);
		expect(cart[0].productId).toEqual('e43638ce-6aa0-4b85-b27f-e1d07eb678c6');
		expect(cart[0].quantity).toEqual(1);
	});
});