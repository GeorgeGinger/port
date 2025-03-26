		<style>
			.hide {
				display: none;
			}

			
		</style>

			<div onclick="add_hidde(event)" class="card border rounded mb-4 mx-1 shadow-sm col-lg-12" style="cursor: pointer;">
				<div class="card-body text-center py-4 js_obraz">
					<h3 class="card-title"></h3>
					<h4></h4>
					<div class="">
						<img class="card-img-top" src='<?= ROOT ?>/assets/images/otevíračka_vánoce.png'>
					</div>
				</div>

				<div class="card-body text-center py-4 hide js_hide">
					<h3 class="card-title"></h3>
					<h4></h4>
					<div class="">
						<img class="card-img-top" src='<?= ROOT ?>/assets/images/otevíračka_vánoce.png'>
					</div>
				</div>
			</div>

			<!-- <div class="card border rounded mb-4 mx-1 shadow-sm col-lg-4 hide js_hide hide_text">
				
			</div> -->
		
		

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