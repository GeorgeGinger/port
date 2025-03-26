<?php $this->view("header", $data);?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					
			<div class="danger">
					<?php check_error() ?>
				</div>
<div>
	<p>admin email address: retez600@gmail.com</p>
	<p>admin password: 1234</p>
	<p>Po přihlášení v SERVICE menu v levo v zápatí stránky kolonka admin </p>
</div>
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" method="POST">
							<input type="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ""; ?>" name="email" placeholder="Email Address" />
							<input type="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : ""; ?>" name="password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						<br>
							<a href="<?= ROOT ?>signup">Dont have an account? Signup here</a>
					</div><!--/login form-->
				</div>
				
			</div>
		</div>
	</section><!--/form-->
	
	<?php $this->view("footer", $data);?>
