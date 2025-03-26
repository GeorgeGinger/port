<!--recommended_items-->

<div class="recommended_items">
	<h2 class="title text-center">recommended items</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<!-- <div class="item active">	 -->

					<?php foreach($product_carusel as $key => $product_group):?>
						<?php if(is_array($product_group)): ?>
						<div class="item <?php if($key == 0) {echo "active";}?>">
							<?php foreach($product_group as $value):?>
								<?php $this->view("inc_product_recomnded", $value);?>
							<?php endforeach ?>
						</div>
						<?php endif ?>
					<?php endforeach ?>
		</div>
			<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
			</a>
			<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
			</a>			
	</div>
<!--/recommended_items-->
</div>