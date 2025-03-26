	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><?= isset($footer_logo[0]->shelf) ? $footer_logo[0]->shelf : "" ?></h2>
							<p><?= isset($logo_paragraph[0]->shelf) ? $logo_paragraph[0]->shelf : "" ?></p>
						</div>
					</div>
					<div class="col-sm-7">
						
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?= ASSETS . THEME ?>images/home/map.png" alt="" />
							<p><?= isset($img_text[0]->shelf) ? $img_text[0]->shelf : "" ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
					
							<?php if(is_array($service_menu)):?>

								<?php foreach($service_menu as $value):?>
									<?php if($value->type == "service_title"):?>
										<h2><?=$value->shelf?></h2>
									<?php endif; ?>
								<?php endforeach; ?>

								<!-- <h2>Policies</h2> -->
								<ul class="nav nav-pills nav-stacked">
									
									<?php foreach($service_menu as $value):?>
										<?php if($value->place == "service" && ($value->type == "" || $value->type == "user_login")):?>

											<?php if(isset($data["user_data"]) && $data["user_data"]->rank == "admin"):?>
												<li><a href="<?=ROOT.$value->url?>" class="<?= $page_title == ucfirst($value->url) ? "active" : ""; ?>" target="blank"><?= $value->shelf ?></a></li>
											<?php else: ?>

												<?php if($value->type != "user_login"): ?> 
													<li><a href="<?=ROOT.$value->url?>" class="<?= $page_title == ucfirst($value->url) ? "active" : ""; ?>"><?= $value->shelf ?></a></li>
												<?php endif; ?>

											<?php endif; ?>

										<?php endif; ?>
									<?php endforeach; ?>
									
								</ul>
							<?php endif; ?>

						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<?php if(is_array($policies_menu)):?>

								<?php foreach($policies_menu as $value):?>
									<?php if($value->type == "policies_title"):?>
										<h2><?=$value->shelf?></h2>
									<?php endif; ?>
								<?php endforeach; ?>

							<!-- <h2>Policies</h2> -->
								<ul class="nav nav-pills nav-stacked">
									
									<?php foreach($policies_menu as $value):?>
										<?php if($value->place == "policies" && $value->type == ""):?>
											<li><a href="<?=ROOT.$value->url?>" class="<?= $page_title == ucfirst($value->url) ? "active" : ""; ?>"><?= $value->shelf ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
									
								</ul>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
						
							<?php if(is_array($about_menu)):?>

							<?php foreach($about_menu as $value):?>
								<?php if($value->type == "about_shoper_titile"):?>
									<h2><?=$value->shelf?></h2>
								<?php endif; ?>
							<?php endforeach; ?>

							<!-- <h2>Policies</h2> -->
							<ul class="nav nav-pills nav-stacked">
								
								<?php foreach($about_menu as $value):?>
									<?php if($value->place == "about_shoper" && $value->type == ""):?>
										<li><a href="<?=ROOT.$value->url?>" class="<?= $page_title == ucfirst($value->url) ? "active" : ""; ?>"><?= $value->shelf ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								
							</ul>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left"><?= isset($footer_down_left[0]->shelf) ? $footer_down_left[0]->shelf : "" ?></p>
					<p class="pull-right"><?= isset($footer_down_right[0]->shelf) ? $footer_down_right[0]->shelf : "" ?> 
					<span><a target="_blank" href="<?= isset($footer_down_right[0]->url) ? $footer_down_right[0]->url : "" ?>">
					<?= isset($footer_down_right_text[0]->shelf) ? $footer_down_right_text[0]->shelf : "" ?></a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	
	<script>


		const single_productAll = document.querySelectorAll(".js_img_singleproduct");
		const overlay_productAll = document.querySelectorAll(".product-overlay");

		single_productAll.forEach((element)=>{
			// console.log("foreach",element);
			element.addEventListener("mouseenter", overlayDown);
		});
	

		overlay_productAll.forEach((element)=>{
			// console.log("foreach",element);
			element.addEventListener("mouseleave", overlayUp);
		});
		

		function overlayDown(e) {
			// console.log(e.target);

			overlay_productAll.forEach((element)=>{
				element.style.height = 0+"px";
			});
		
			const single_img = e.currentTarget;
			// console.log("single_product",single_product);

			const img_height = single_img.offsetHeight;
			// console.log("img_heght",img_height);

			// nejde ovwrlay k obrazku, parentNode aby vyskocil o dva divi nahoru
			const owerlay = single_img.parentNode.parentNode.querySelector(".product-overlay");

			owerlay.style.height = img_height+"px";
		}
		
		function overlayUp(e) {
			// console.log("up");
			const product = e.currentTarget;
			const owerlay = product.parentNode.parentNode.querySelector(".product-overlay");
			owerlay.style = 0+"px";
		}

	</script>

  
    <script src="<?= ASSETS . THEME ?>js/jquery.js"></script>
	<script src="<?= ASSETS . THEME ?>js/bootstrap.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/price-range.js"></script>
    <script src="<?= ASSETS . THEME ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?= ASSETS . THEME ?>js/main.js"></script>
</body>
</html>