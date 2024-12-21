import { renderOrderSummary } from "./checkout/orderSummary.js";
import { renderPaymentSummary } from "./checkout/paymentSummary.js";
import {loadProducts, loadProductsFetch} from '../data/products.js';
import {loadCart} from '../data/cart.js';
// jina sintaxe spusti cod v zadanem souboru
// import '../data/cart-oop.js';
// import '../data/cart-class.js';
// import '../data/backend-practice.js';


async function loadPage() {
	try {

		// error si muzeme vytvorit throw vyhodi error prerusi provadeni try vetve a catch error zachyti
		// throw 'error try';

		// awayt muzeme pouzivat pouze uvnitr async function
		await loadProductsFetch();

		const value = await new Promise((resolve) => {
			throw 'error promise'
			loadCart(() => {
			resolve('value3');
			});
		})
	} catch(error) {
		console.log('Unxepected error. Please try again later.', error);
	}
	

	renderOrderSummary();
	renderPaymentSummary();
}

loadPage();

/*
Promise.all([
	loadProductsFetch(),
	new Promise((resolve) => {
		loadCart(() => {
		resolve('value2');
		});
	})

]).then((value) => {
	console.log('zde', value);
	renderOrderSummary();
	renderPaymentSummary();
});
*/

// Promise.all([
// 	new Promise((resolve) => {
// 		loadProducts(() => {
// 			resolve('value1');
// 		});
// 	}),
// 	new Promise((resolve) => {
// 		loadCart(() => {
// 		resolve('value2');
// 		});
// 	})

// ]).then((value) => {
// 	console.log(value);
// 	renderOrderSummary();
// 	renderPaymentSummary();
// });

/*
new Promise((resolve) => {
	loadProducts(() => {
		resolve('value1');
	});

}).then((value) => {
	console.log(value);
	
	return new Promise((resolve) => {
		loadCart(() => {
		resolve();
		});
	});

}).then(() => {
	renderOrderSummary();
	renderPaymentSummary();
});
*/

/*
loadProducts(() => {
	loadCart(() => {
		renderOrderSummary();
		renderPaymentSummary();
	});
});
*/
