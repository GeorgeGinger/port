<?php
// show($data);
$data["stranka"] = "home";
$this->view("home/header.view", $data) ?>

<div class="container px-1">
	
	<?php $this->view("home/shortcut_body_navbar.view", $data) ?>
	
	<?php $this->view("home/vzkaz.view", $data) ?>
	

</div>

<?php $this->view("home/footer.view") ?>