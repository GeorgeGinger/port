<?php $this->view("header", $data);?>

	<section>
		<div class="container">
			<div class="row">
				
			<?php $this->view("sidebar.inc", $data);?>

				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>

						<?php if(is_array($blogs) && count($blogs) > 0): ?>
							
						<?php foreach($blogs as $value): ?>

						

							<div class="single-blog-post">
								<h3><?= htmlspecialchars($value->title) ?></h3>
								<div class="post-meta">
									<ul>
										<li><i class="fa fa-user"></i> <?=htmlspecialchars($value->blog_owner)?></li>
										<li><i class="fa fa-clock-o"></i> <?= date("H:i:s",strtotime($value->date))?></li>
										<li><i class="fa fa-calendar"></i> <?= date("M jS, Y",strtotime($value->date))?></li>
									</ul>
								</div>
								<a href="<?=ROOT?>post/<?=$value->slug?>">
									<img src="<?=ROOT.$value->image?>" alt="">
								</a>
								
								<p><?=nl2br(htmlspecialchars(substr($value->post, 0, 300))) ?> ...</p>
								
								<a  class="btn btn-primary" href="<?=ROOT?>post/<?=$value->slug?>">Read More</a>
							</div>

						<?php endforeach; ?>
						<?php endif; ?>

						<!-- end blog-post-area -->
					</div>

						<?php Page::show_links(4)?>

				</div>
			</div>
		</div>
	</section>

	<?php $this->view("footer", $data);?>