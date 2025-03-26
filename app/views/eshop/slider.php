<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php if(is_array($sliders_row) && count($sliders_row) > 0):?>
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">

								<?php foreach($sliders_row as $key => $value):?>
									<li data-target="#slider-carousel" data-slide-to="<?=$key?>" class="active <?=$key == 0 ? 'active' : ''?>"></li>
								<?php endforeach; ?>
						</ol>
						
						<div class="carousel-inner">
							<?php foreach($sliders_row as $key => $value):?>

							<div class="item <?=$key == 0 ? 'active' : ''?>">
								<div class="row" style="display: flex; align-items:center">
									<div class="col-xs-6">
									<h1><span><?= isset(explode("-",$value->header)[0]) ? explode("-",$value->header)[0]: "neni" ?></span><?= isset(explode("-",$value->header)[1]) ? '-'.explode("-",$value->header)[1]: "" ?></h1>
									<h2><?=$value->header1?></h2>
									<p style="height: 8rem;"><?=$value->text?></p>
									<a href="<?=$value->link?>">
										<button type="button" class="btn btn-default get">Get it now</button>
									</a>
									
									</div>
									<div class="col-xs-6">
										<img src="<?= ROOT.$value->image ?>" class="girl img-responsive" alt="" />
										<!-- <img src="<?= ROOT.$value->image1 ?>"  class="pricing" alt="" /> -->
										<img src="<?= ASSETS ?>eshop/images/home/pricing.png"  class="pricing" alt="" />
									</div>
								</div>
								
							</div>

							<?php endforeach; ?>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

					<?php endif; ?>
					
				</div><!--/col-sm-12-->
			</div><!--/row-->
		</div><!--/container-->
	</section><!--/slider-->
