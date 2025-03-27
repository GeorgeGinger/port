<?php $this->view("header", $data);?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<a href="<?= ROOT ?>signup" class="btn btn-success btn-lg col-lg-12">Start new game</a>
					<br>
					<br>
					<br>
						
						<div class="danger">
							<?php check_error() ?>
						</div>

						<div class="login-form my-login-form"><!--login form-->
							<h2>Login to your game</h2>
							<form action="#" method="POST">
								<input type="text" value="<?= isset($_POST["name"]) ? $_POST["name"] : ""; ?>" name="name" placeholder="Name" />
								<input type="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : ""; ?>" name="password" placeholder="Password" />
								<button type="submit" class="btn btn-default">Login</button>
							</form>
						</div><!--/login form-->
				</div><!-- col -->
			</div><!-- row end -->
		</div><!-- container end -->
	</section><!--/form-->
	
	<?php $this->view("footer", $data);?>
