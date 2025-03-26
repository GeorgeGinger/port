		<style>
			.hide {
				display: none;
			}
			
		</style>

<div class="row d-lg-flex justify-content-center col-xl-12">
			<?php if(isset($vzkazy)): ?>
				<?php foreach($vzkazy as $key => $value): ?>

			
					<div class="col-xl-6">

						<div onclick="add_hidde(event)" class="card border rounded mb-4 mx-1 shadow-sm" style="cursor: pointer;">
							<div class="card-body text-center py-4 js_obraz">

								<?php if($value->title1 != "" || $value->post1 != "" || $value->image1 != ""): ?>
									<div class="position-absolute end-0 top-0 m-2">
										<i class="bi bi-body-text"></i>
									</div>
								<?php endif; ?>

								<h3 class="card-title"><?= $value->title ?></h3>
								<h4></h4>
								<p><?= $value->post ?></p>
								<div class="">
									<?php if($value->image != ""): ?>
										<img class="card-img-top" src='<?= ROOT.$value->image ?>'>
									<?php endif; ?>
								</div>
							</div>

							<?php if($value->title1 != "" || $value->post1 != "" || $value->image1 != ""): ?>

								<div class="card-body text-center py-4 hide js_hide">

										<div class="position-absolute end-0 top-0 m-2">
											<i class="bi bi-x-square"></i>
										</div>

									<h3 class="card-title"><?= $value->title1 ?></h3>
									<h4></h4>
									<p><?= $value->post1 ?></p>
									<div class="">
										<?php if($value->image1 != ""): ?>
											<img class="card-img-top" src='<?= ROOT.$value->image1 ?>'>
										<?php endif; ?>
									</div>
								</div>

							<?php endif; ?>
						</div>

					</div>
			

			<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<script>
			function add_hidde(e) {

				let obraz = e.currentTarget;
				let js_obraz = obraz.querySelector(".js_obraz");
				let js_hide = obraz.querySelector(".js_hide");

				if(js_hide.classList.contains("hide")) {
					js_obraz.classList.add("hide");
					js_hide.classList.remove("hide");
				}else {
					js_obraz.classList.remove("hide");
					js_hide.classList.add("hide");
				}
			}
		</script>