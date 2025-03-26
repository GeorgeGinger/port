</main>


<div class="container">


  <footer class="d-flex flex-column flex-wrap justify-content-center align-items-center py-3 my-4 border-top">

 <h2>KONTAKTY pro objednání:</h2>


    <ul class="nav col-md-4 justify-content-center list-unstyled d-flex flex-column">

		<?php if(isset($socials_footer)): ?>
            <?php foreach($socials_footer as $key => $value): ?>

				<li class="text-center mb-1">
					<a class="text-body-secondary link-dark link-offset-3 link-underline-opacity-25 link-underline-opacity-100-hover" href="<?= $value->url ?>" target="<?= $value->type ?>"><?= $value->class ?><?= $value->shelf ?></a>
				</li>

			<?php endforeach; ?>
		<?php endif; ?>

		<li class="text-center d-flex justify-content-center gap-2 fs-1">

			<?php if(isset($socials_footer_icon)): ?>
				<?php foreach($socials_footer_icon as $key => $value): ?>

					<a class="text-body-secondary link-dark" href="<?= $value->url ?>" target="<?= $value->type ?>"><?= $value->class ?></a>

				<?php endforeach; ?>
			<?php endif; ?>

		</li>

    </ul>

	<div class="col-md-4 d-flex align-items-center justify-content-center">

		<?php if(isset($logo_footer)): ?>
            <?php foreach($logo_footer as $key => $value): ?>

				<a href="<?=ROOT.$value->url?>" class="mb-3 mb-md-0 text-body-secondary text-decoration-none lh-1 link-dark">
					<span class="<?= $value->class ?>">&copy; <?= $value->shelf ?></span>
				</a>

			<?php endforeach; ?>
		<?php endif; ?>

    </div>
  </footer>
</div>


	<script src="<?=ROOT?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=ROOT?>assets/js/moje.js"></script>
	<script src="<?=ROOT?>assets/js/moje-css-bootstrap.js"></script>

</body>
</html>

