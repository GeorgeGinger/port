<?php $this->view("header", $data);?>

	<section id="form"><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						
				<div class="danger">
					<?php check_error() ?>
				</div>
						<div class="signup-form my-signup-form-player"><!--sign up form-->
							<h2>New Killer Signup!</h2>
							<form action="" method="post">
								<input type="text" value="<?= old_value('name', "")?>" name="name" placeholder="Killer Name"/>
								<input type="password" value="" name="password" placeholder="Password"/>
								<input type="password" value="" name="password2" placeholder="Retype password"/>
								<button type="submit" class="btn btn-default">Signup</button>
							</form>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
		</section><!--/form-->
	
<?php $this->view("footer");?>
