<div class="d-flex justify-content-center flex-wrap mb-2">

<?php if(isset($home_body_shortcut)): ?>
                <?php foreach($home_body_shortcut as $key => $value): ?>

					<div class="card border rounded m-1  shadow-sm">
			<a class="link-body-emphasis" href='<?= ROOT.$value->url ?>'>
				<div class="card-body text-center py-1 p-0">
					<h6 class="card-title"><?= $value->shelf ?></h6>
				</div>
			</a>
		</div>

                <?php endforeach; ?>
              <?php endif; ?>
		
	</div>