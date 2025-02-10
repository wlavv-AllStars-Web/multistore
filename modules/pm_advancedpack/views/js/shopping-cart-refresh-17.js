$(document).ready(function() {
	// console.log("shopping-cart-refresh.js")
	$('.js-cart').data('refresh-url', ap5_cartRefreshUrl);
	if (!(new String(window.location).match(/updatedTransaction/))) {
		prestashop.emit('updateCart', { reason: { cart: null }, resp: { cart: null } });
	}
});
$(document).ajaxSuccess(function(e, ajaxOptions, ajaxData) {
	// console.log("shopping-cart-refresh.js")
	$('.js-cart').data('refresh-url', ap5_cartRefreshUrl);
});
