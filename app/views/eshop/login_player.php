<?php $this->view("header", $data);?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<a href="<?= ROOT ?>signup_player" class="btn btn-success btn-lg col-lg-12" title="Umožní vytvořit nového hráče">New Killer</a>
							<br>
							<br>
							<br>
					<div class="login-form my-login-form-player"><!--login form-->
						

						<div class="danger">
							<?php check_error() ?>
						</div>

						<h2>Zadej jméno a heslo vaší postavy</h2>
						<form action="" method="POST">
							<input type="text" value="<?= isset($_POST["name"]) ? $_POST["name"] : ""; ?>" name="name" placeholder="Player name" />
							<input type="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : ""; ?>" name="password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				
			</div>
		</div>
	</section><!--/form-->
	
	<?php $this->view("footer", $data);?>
