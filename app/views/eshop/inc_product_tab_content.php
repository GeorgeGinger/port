

<div class="col-sm-3 col-xs-5">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				<a href="<?=ROOT?>product_details/<?=$data["slag"]?>" style="diaplay:flex;">
					<img src="<?= ROOT.$data["image"] ?>" alt="" />
					<h2><?= $data["description"] ?></h2>
				</a>
				<a href="<?=ROOT?>add_to_cart/<?=$data["id"]?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
			</div>
			
		</div>
	</div>
</div>