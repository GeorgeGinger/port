<?php $this->view("header", $data);?>
<?php $this->view("slider", $data);?>

	<section>
		<div class="container">
			<div class="row">
				
			<?php $this->view("sidebar.inc", $data);?>
				
				<div class="col-sm-9">
					
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?= isset($features_items->shelf) ? $features_items->shelf : "" ?></h2>

							<?php if(is_array($products)):?>
							<?php foreach($products as $value):?>
								
								<?php $this->view("inc_product", $value);?>
				
							<?php endforeach ?>
							<?php else: ?>
								<br>
								<br>
								<h2 class="text-center">Žádný produkt</h2>
								<br>
								<br>
							<?php endif; ?>
						
					</div><!--features_items-->
					
					<?php Page::show_links(4)?>

					<!--category-tab-->
					<?php if(is_array($segment_data) && count($segment_data) > 0): ?>
						<?php $this->view("tab_category", ["tab_category"=>$segment_data]);?>
					<?php endif; ?>
					
					
					<!--recommended_items-->
					<?php if(isset($product_carusel)):?>
						<?php $this->view("tab_recomended", ["product_carusel"=>$product_carusel]);?>
					<?php endif ?>
					
				</div>
			</div><!--/row-->
		</div><!--/container-->
	</section>

	<?php $this->view("footer", $data);?>