<div class="col-sm-4 col-xs-4">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
			<a href="<?=ROOT?>product_details/<?=$data["slag"]?>" style="diaplay:flex;">
				<img src="<?= ROOT.$data["image"] ?>" alt="" />
				<h2><?= nf($data["cenaProdej"], "Kč") ?></h2>
				<p><?= $data["pocet_prodejnych_kusu"] ?></p>
				<p><?= $data["description"] ?></p>
			</a>
				<a href="<?=ROOT?>add_to_cart/<?=$data["id"]?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
			</div>
			
		</div>
	</div>
</div>