
<style type="text/css">
	.add_new {
		width: 500px;
		/* height: 300px; */
		background-color: #cecccc;
		box-shadow: 0px 0px 10px #aaa;
		position: absolute;
		padding: 6px;
		z-index: 10;
	}

	.show {
		display: block;
	}

	.hide {
		display: none;
	}
</style>

<div class="content-panel">

	<!-- add new product -->
	<div class="add_new hide">
		<!-- BASIC FORM ELELEMNTS -->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<h4 class="mb"><i class="fa fa-angle-right"></i> Form Elements</h4>
					<form class="form-horizontal style-form" method="get">

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label" for="name">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" id="name"
									placeholder="Enter product name" style="margin-bottom: 1rem">
							</div>
						</div>
						
						<button type="button" class="btn btn-danger" onclick="show_add_new(event)">Close</button>
						<button type="button" class="btn btn-primary js_button_add hide"
							onclick="collect_data({data_type:'add_row'})">Save</button>
						<button type="button" class="btn btn-primary js_button_edit hide"
							onclick="collect_data({data_type:'edit_row'})">Edit</button>
					</form>
				</div>
			</div><!-- col-lg-12-->
		</div><!-- /row -->
	</div>

	<?php if(isset($player_data) && $player_data->rank == "admin"): ?>
	<form action="" method="post">
		<button name="zamichat_button" class="btn btn-success">Zamíchat</button>
	</form>
	<?php endif; ?>

	<div class="container">
		<div class="row">

			<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
				
						<div class="row">
								<div class="js_table col-md-8">
									<?php if(isset($table_row) && $table_row != ""): ?> 
										<?=$table_row ?>
									<?php else: ?>
										<div>
											<h2 style="text-align: center">Who are you?</h2>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-md-4">
									<?php if(isset($players_list_tab) && $players_list_tab != ""): ?> 
										<?=$players_list_tab ?>
									<?php else: ?>
										<div>
											<h2 style="text-align: center">No players in the game</h2>
										</div>
									<?php endif; ?>
								</div>
						</div>
			</div>

		</div>
	</div>
	
		

</div><!-- /content-panel -->

<script src="<?= ASSETS . THEME ?>js/players.js"></script>

