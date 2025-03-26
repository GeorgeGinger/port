<div class="col-sm-4 col-xs-4 my_card">
	<div class="product-image-wrapper">
		<div class="single-products">
		<!-- <div class="single-products" onmouseover="overlayDown(event)"> -->

				<div class="productinfo text-center">
					<img src="<?= ROOT.$data["image"] ?>" class="js_img_singleproduct" alt=""/>
					<h2><?= nf($data["cenaProdej"], "Kč") ?></h2>
					<p class="productinfo_description"><?= $data["description"] ?></p>
					<p class="productinfo_description">skladem: <?= $data["pocet_prodejnych_kusu"]?> ks</p>
					<a href="<?=ROOT?>add_to_cart/<?=$data["id"]?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= isset($card_add_buttons->shelf) ? $card_add_buttons->shelf : "" ?></a>
				</div>
	
				<div class="product-overlay">
					<div class="overlay-content">
						<a href="<?=ROOT?>product_details/<?=$data["slag"]?>" style="diaplay:flex;">
							<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid mollitia sed dolorem tempora nemo exercitationem rem voluptatibus fugit quasi debitis tenetur quibusdam amet quis sit ex praesentium ipsam nesciunt quas, blanditiis eius ut at numquam magni. Facilis quisquam illo quas, quasi explicabo ad blanditiis cupiditate omnis veniam. Voluptas, iure vel.</p>
						</a>
					</div>
				</div>

		</div>
	</div>
</div>
