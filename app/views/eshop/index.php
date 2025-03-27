<?php $this->view("header", $data);?>

	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-lg-12">
					
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?= isset($features_items->shelf) ? $features_items->shelf : "" ?></h2>
						<div>
							<?php $this->view("game_why", $data);?>
						</div>
						
					</div><!--features_items-->

				</div>
			</div><!--/row-->
		</div><!--/container-->
	</section>

	<?php $this->view("footer", $data);?>