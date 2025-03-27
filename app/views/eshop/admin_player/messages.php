<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">
	
</style>

<div class="content-panel">
<?php if(isset($table_rows) && $table_rows != ""): ?> 
		
		<?=$table_rows ?>


	<?php else: ?>

		<div>
			<h2 style="text-align: center">Nothing is ordered.</h2>
		</div>

	<?php endif; ?>
</div><!-- /content-panel -->

<script>
	function show_dateils(e) {

let all_js_order_details = document.querySelectorAll(".js_order_details");
all_js_order_details.forEach((elemen) => {elemen.classList.add("hide")});

let row = e.target.parentNode;

let details = row.querySelector(".js_order_details");

// pokud kliknu na close pak details == null protoze parent pro div s close neobsahuje .js_order_details
if(details) {
	details.classList.remove("hide");
}
}
</script>

<?php $this->view("admin/footer", $data); ?>