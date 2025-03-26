

<div class="category-tab"><!--category-tab-->
	<!-- <div class="col-sm-12"> -->
		<ul class="nav nav-tabs">
				<?php $i=0; foreach($tab_category as $key => $cat): ?>
					<?php if(is_array($cat)): ?>
						<li class="<?php if($i == 0) {echo 'active';} $i++; ?>"><a href="#<?=$cat["id_item"]?>" data-toggle="tab"><?=$key?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
		</ul>
	<!-- </div> -->

	<div class="tab-content">
		<?php  $j=0; foreach($tab_category as $key => $cat): ?>
			<?php if(is_array($cat)): ?>
				<div class="tab-pane fade <?php if($j == 0) {echo 'active'; $j++;} ?> in" id="<?=$cat["id_item"]?>" >

					<?php if(is_array($cat["prod"]) && count($cat["prod"]) > 0): ?>
						<?php $i=0; foreach($cat["prod"] as $prod): ?>

							<?php $this->view("inc_product_tab_content", $prod);?>

						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div><!--/category-tab-->