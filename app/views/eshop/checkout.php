<?php $this->view("header", $data); ?>

<?php 
if(isset($errors) && count($errors) > 0) {
	foreach($errors as $error) {
		echo "<div class='container'>";
		echo "<div class='alert alert-danger' style='padding: 5px; font-size: 3rem; text-align: center;'>$error</div>";
		echo "</div>";
	}
}
?>
<section id="cart_items">
	<div class="container">

		<?php
		// obseh se zobrazi pokud je neco v kosiku 
		if (is_array($products) && count($products) > 0): ?>
			
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="<?= ROOT ?>home">Home</a></li>
					<li>Check out</li>
					<!-- <li class="active">Check out</li> -->
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				
				<form action="" method="POST">
					<div class="row">
						<div class="col-sm-4 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">
								
								<input id="street" type="text" name="street"  value="<?=old_value("street")?>" required="required" placeholder="Street *">

								<input id="city" type="text" name="city" value="<?=old_value("country")?>" class="js_city" required="required" placeholder="City *" autofocus="autofocus">
									
									<input id="country" type="text" name="country"  value="<?=old_value("country")?>" required="required" placeholder="Country *">

									<input id="zip" type="text" name="zip" value="<?=old_value("zip")?>" required="required" placeholder="p.s.č. *">
										
									<input id="phone" name="phone" value="<?=old_value("phone")?>" type="text" placeholder="Phone" required="required">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="order-message">
								<p>Shipping Order</p>
								<textarea name="message" placeholder="Notes about your order, Special Notes for Delivery"
									rows="16"><?=old_value("message")?></textarea>
							</div>
						</div>
					</div>
					<br>
					<br>
					<div class="row">
						<a href="<?= ROOT ?>cart">
							<input type="button" class="btn btn-danger pull-left" value="< Back to cart" name="">
						</a>

						<input type="submit" class="btn btn-success pull-right" value="Continue >" name="">
					</div>
					<br>
					<br>
					<br>
				</form>
				
			</div>

		<?php else: ?>
			<div style="font-size: 3rem; text-align: center;">
				Please add some items to the cart first.
			</div>
		<?php endif; ?>
	</div>
</section> <!--/#cart_items-->



<?php $this->view("footer", $data); ?>