<?php $this->view("header", $data); ?>

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>

					<?php if (is_array($products) && count($products) > 0): ?>
						<?php foreach ($products as $key => $value): ?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?= ROOT . $value->image ?>" alt="" style="width:100px"></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?= $value->description ?></a></h4>
									<p>prod. ID: <?= $value->id ?></p>
								</td>
								<td class="cart_price">
									<p><?= nf($value->cenaProdej) ?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="<?= ROOT ?>add_to_cart/add/<?= $value->id ?>"> + </a>
										<input onchange="edit_quantity(this.value, '<?= $value->id ?>')"
											class="cart_quantity_input" type="text" name="quantity" value="<?= $value->qty ?>"
											autocomplete="off" size="2">
										<a class="cart_quantity_down" href="<?= ROOT ?>add_to_cart/subtract/<?= $value->id ?>">
											-
										</a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?= nF($value->item_total_price, "Kč") ?></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete"
										href="<?= ROOT ?>add_to_cart/delete/<?= $value->id ?>/delete"><i
											class="fa fa-times"></i></a>
								</td>
							</tr>

						<?php endforeach; ?>
					<?php else: ?>
						<div style="font-size: 3rem; text-align: center; padding: 6px">No inems were found</div>
					<?php endif; ?>

				</tbody>
			</table>
			<div class="pull-right" style="font-size: 3rem">Sub. Total: <?= nF($subtotal_cart_price, "Kč") ?></div>
		</div>
		<a href="<?= ROOT ?>checkout">
			<input type="button" class="btn btn-success pull-right" value="Checkout >" name="">
		</a>

		<a href="<?= ROOT ?>shop">
			<input type="button" class="btn btn-danger pull-left" value="< Continue shopping" name="">
		</a>
	</div>
</section> <!--/#cart_items-->
<br><br>
<script>
	function edit_quantity(quantity, id) {

		if (isNaN(quantity))
			return;

		send_data({
			"quantity": quantity.trim(),
			"id": id.trim()
		}, "edit_quantity");

	}

	function send_data(data = {}, data_type) {

		const ajax = new XMLHttpRequest();

		ajax.addEventListener("readystatechange", function (a) {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handle_result(ajax.responseText);
			}
		});

		ajax.open("POST", "<?= ROOT ?>ajax_cart/" + data_type + "/" + JSON.stringify(data), true);

		ajax.send();
	}

	function handle_result(result) {

		// console.log(result);
		if (result != "") {

			const obj = JSON.parse(result);
			// console.log(obj.check);

			if (typeof obj.data_type != "undefined") {

				if (obj.data_type == "edit_quantity") {

					// refresch stranky po zneme kvuli prepocitani total price, a cart price
					// mohli ny jsme to udela v js ale trochu by se to komplikovalo
					window.location.href = window.location.href;
				}
			}
		}
	}
</script>

<?php $this->view("footer", $data); ?>