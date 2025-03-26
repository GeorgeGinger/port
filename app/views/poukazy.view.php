		<style>
			.hide {
				display: none;
			}

			
		</style>

			<div onclick="add_hidde(event)" class="card border rounded mb-4 mx-1 shadow-sm col-lg-6" style="cursor: pointer;">
				<div class="card-body text-center py-4 js_obraz">
					<div class="position-absolute end-0 top-0 m-2">
						<i class="bi bi-body-text"></i>
					</div>
					<h3 class="card-title">Dárkové poukazy</h3>
					<div class="">
						<img class="card-img-top" src='<?= ROOT ?>/assets/images/poukazy.png'>
					</div>
				</div>

				<div class="card-body text-center py-4 hide js_hide">

					<div class="position-absolute end-0 top-0 m-2">
						<i class="bi bi-x-square"></i>
					</div>

					<h3 class="card-title">Dárkové poukazy</h3>
					<div class="">
						<!-- <img class="card-img-top" src='<?= ROOT ?>/assets/images/poukazy.png'> -->
						<p>10x vstup do finské sauny 2000 Kč</p>
						<p>1x privátní sauna pro dvě osoby 60min + (20min převlečení) 1000Kč</p>
						<p>1x privátní sauna 90min + (20min převlečení)  1250Kč</p>
						<p>1x privátní sauna 120min + (20min převlečení)  1500Kč</p>
						<p>Přírodní hnědá obálka zdarma</p>
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
				// let js_obraz = document.querySelector(".js_obraz");
				// let js_hide = document.querySelector(".js_hide");

				if(js_hide.classList.contains("hide")) {
					js_obraz.classList.add("hide");
					js_hide.classList.remove("hide");
				}else {
					js_obraz.classList.remove("hide");
					js_hide.classList.add("hide");
				}
			}
		</script>