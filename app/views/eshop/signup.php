<?php $this->view("header", $data);?>

	<section id="form"><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						
				<div class="text-danger">
				<!-- <div class="text-danger bg-primary border-primary rounded-3"> -->
					<?php check_error() ?>
				</div>
						<div class="signup-form"><!--sign up form-->
							<h2>New User Signup!</h2>
							<form action="" method="post">
								<input type="text" value="<?= isset($_POST["name"]) ? $_POST["name"] : ""; ?>" name="name" placeholder="Name"/>
								<input type="text" value="<?= isset($_POST["last_name"]) ? $_POST["last_name"] : ""; ?>" name="last_name" placeholder="Last name"/>
								<input type="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ""; ?>" name="email" placeholder="Email Address"/>
								<input type="password" value="" name="password" placeholder="Password"/>
								<input type="password" value="" name="password2" placeholder="Retype password"/>
								<button type="submit" class="btn btn-default" name="submit_signup">Signup</button>
							</form>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
		</section><!--/form-->
	
<?php $this->view("footer", $data);?>
