export const orders = JSON.parse(localStorage.getItem('orders')) || [];

export function addOrder(order) {
	// unshift prida order na zacatek orders
	orders.unshift(order);
	saveToStorage();
}

function saveToStorage() {
	localStorage.setItem('orders', JSON.stringify(orders));
}