import { renderOrderSummary } from "./checkout/orderSummary.js";
import { renderPaymentSummary } from "./checkout/paymentSummary.js";
import {loadProducts} from '../data/products.js';
// jina sintaxe spusti cod v zadanem souboru
// import '../data/cart-oop.js';
// import '../data/cart-class.js';
// import '../data/backend-practice.js';

loadProducts(() => {
	renderOrderSummary();
	renderPaymentSummary();
});

