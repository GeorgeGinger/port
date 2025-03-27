<?php $this->view("header", $data);?>

	<section id="advertisement">
		<div class="container">
			<img src="<?=ASSETS.THEME?>images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				
			<?php $this->view("sidebar.inc", $data);?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						

						<?php if(is_array($products)):?>
						<?php foreach($products as $value):?>
							
							<?php $this->view("inc_product", $value);?>
			
						<?php endforeach ?>
						<?php endif ?>
						
					</div><!--features_items-->

					<?php Page::show_links(4)?>
					
				</div>
			</div>
		</div>
	</section>

	<?php $this->view("footer", $data);?>

	