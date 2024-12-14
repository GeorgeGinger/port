export function formatCurrency(priceCents) {
	return (Math.round(priceCents) / 100).toFixed(2);
}

// umoznuje exportovat pouze jednu vec
export default formatCurrency;