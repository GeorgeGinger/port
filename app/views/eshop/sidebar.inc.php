<style>
	.table {
		background-color: lightgrey;
	}
</style>



<div class="col-sm-3">
	<div class="left-sidebar">

		<?php if(isset($categories)):?>

			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title" style="margin: 0 auto 0px;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseCategories">
								<?= isset($title_category) ? $title_category->shelf : "" ?>
								<span class="glyphicon glyphicon-th-list" style="margin-left: 2rem;"></span>
							</a>
						</h2>
					</div>
					<div id="collapseCategories" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="panel-group category-products" id="accordian"><!--acordian-->
								
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
										<a href="<?=ROOT.$data["page_title"]?>">Všechno</a>
							
										</a>
									</h4>
								</div>
								<!-- <div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Nike </a></li>
											<li><a href="#">Under Armour </a></li>
											<li><a href="#">Adidas </a></li>
											<li><a href="#">Puma</a></li>
											<li><a href="#">ASICS </a></li>
										</ul>
									</div>
								</div> -->
							</div>

								<?=$categories ?>

							</div><!--/acordian-->     
						</div>
					</div>
				</div>
			</div>
				
		<?php endif;?>

		<!-- searchbox -->
		<div class="panel-group" id="accordion">
		
		<div class="panel panel-default">
			<div class="panel-heading">
			<h2 class="panel-title" style="margin: 0 auto 0px;">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
				<?= isset($title_search) ? $title_search->shelf : "" ?>
				<span class="glyphicon glyphicon-search" style="margin-left: 2rem;"></span>
				</a>
			</h2>
			</div>
			<div id="collapseThree" class="panel-collapse collapse">
			<div class="panel-body">
					
			<form action="" class="">
					<table class="table">
						<tr>
							<td>
								<input type="text" name="description" class="form-control" autofocus="true" placeholder="<?= isset($product_description) ? $product_description->shelf : "" ?>" value="<?=old_value("description", "", "GET")?>">
							</td>
						</tr>
						<tr>
							<td>
								<select name="category" class="form-control">
									<option value=""><?= isset($select_category) ? $select_category->shelf : "" ?></option>
									<?php  $search = new Search; $search->get_categories(); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<div>
								<?= isset($quantity) ? $quantity->shelf : "" ?>
								</div>
								<!--range_slider-->
								<div class="well text-center js_range">
									<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="2000" data-slider-step="5" data-slider-value="[<?=old_value("min_quantity", 0, "GET")?>,<?=old_value("max_quantity", 2000, "GET")?>]" id="sl3" ><br />
									<b class="pull-left"><?=old_value("min_quantity", 0, "GET")?> ks</b> <b class="pull-right"><?=old_value("max_quantity", 2000, "GET")?> ks</b>
									<input class="form-control js_min_value" id="min_quantity" type="hidden" step="1" name="min_quantity" value="<?=old_value("min_quantity", 0, "GET")?>">
									<input class="form-control js_max_value" id="max_quantity" type="hidden" step="1" name="max_quantity" value="<?=old_value("max_quantity", 2000, "GET")?>">
								</div>
								<!--/range_slider-->
							</td>
						</tr>
						<tr>
							<td>
								<div>
								<?= isset($price_range) ? $price_range->shelf : "" ?>
								</div>
								<!--range_slider-->
									<div class="well text-center js_range">
										<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="20000" data-slider-step="5" data-slider-value="[<?=old_value("min_price", 0, "GET")?>,<?=old_value("max_price", 20000, "GET")?>]" id="sl2" ><br />
										<b class="pull-left"><?=old_value("min_price", 0, "GET")?> Kč</b> <b class="pull-right"><?=old_value("max_price", 20000, "GET")?> Kč</b>
										<input class="form-control js_min_value" id="min_price" type="hidden" step="1" name="min_price" value="<?=old_value("min_price", 0, "GET")?>">
										<input class="form-control js_max_value" id="max_price" type="hidden" step="1" name="max_price" value="<?=old_value("max_price", 20000, "GET")?>">
									</div>
								<!--/range_slider-->
							</td>
						</tr>
						<tr>
							<td>
								<select name="year" class="form-control">
									<option><?= isset($year) ? $year->shelf : "" ?></option>
									<?php $search->get_year(); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<?php $search->get_brand() ?>
							</td>
						</tr>
						<tr>
							<td>
								<input class="btn btn-success pull-right" type="submit" name="search_submit" value="Search">
							</td>
						</tr>
					</table>
				</form>
			
				</div>
			</div>
		</div>
		</div>
		<!--end searchbox -->  
		<br>

		

		<div class="shipping text-center hidden-xs"><!--shipping-->
			<img src="<?= ASSETS ?>eshop/images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->

	</div>
</div>

<script>
	//uprava slideru
	const js_range = document.querySelectorAll(".js_range");
	
	js_range.forEach((e)=>{e.addEventListener("mousemove", change_range)});
	function change_range(e) {
		
		const tooltip = e.currentTarget.querySelector(".tooltip-inner");
		const min_value = e.currentTarget.querySelector(".js_min_value");
		const max_value = e.currentTarget.querySelector(".js_max_value");
		const pull_left = e.currentTarget.querySelector(".pull-left");
		const pull_right = e.currentTarget.querySelector(".pull-right");

	

		let values = tooltip.innerText;
		let parts = values.split(":");
		min_value.value = Number(parts[0]);
		max_value.value = Number(parts[1]);
		min_value.value = parts[0].trim();
		max_value.value = parts[1].trim();

		const jednotka_left = pull_left.innerText.split(" ")[1];
		const jednotka_right = pull_right.innerText.split(" ")[1];
		
		pull_left.innerText = parts[0].trim()+" "+jednotka_left;
		pull_right.innerText = parts[1].trim()+" "+jednotka_right;

	}

</script>