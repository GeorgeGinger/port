<?php 
$data["stranka"]="kudyknam";
$this->view("home/header.view", $data) ?>

<div class="card border rounded mb-4  shadow-sm">
	<div class="card-body text-center py-4">
		<h3 class="card-title">Plechového miláčka můžete zaparkovat na náměstí nebo v přilehlých ulicích po 17. hodině
			parkování zdarma</h3>

	</div>
</div>

<div class="card border rounded mb-4  shadow-sm">
	<div class="card-body text-center py-4">
		<iframe style="border: none;" src="https://frame.mapy.cz/s/cosumanana" height="380" width="100%"
			frameborder="0"></iframe>
	</div>
</div>

<?php $this->view("home/footer.view") ?>