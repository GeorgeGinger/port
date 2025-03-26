<?php $this->view("header", $data); ?>

<!-- <?php show($data); ?> -->

<?php if(isset($data["summary"])) {
	$total = 0;
	$id = 1; 
	extract($data["summary"]);
} ?>

<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
			<h1 class="">Na váš email byla odeslána rekapitulace objednávky a platební údaje. </h1>
		</div>
	</div>
</div>
<br>

	

<?php $this->view("footer", $data); ?>