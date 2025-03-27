<?php $this->view("header", $data);?>

<!-- <?php show($data["post"]) ?> -->

	<section>
		<div class="container">
			<div class="row">
							
				<div class="col-sm-9">

					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3><?= htmlspecialchars($post->title) ?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> <?=htmlspecialchars($post->blog_owner)?></li>
									<li><i class="fa fa-clock-o"></i> <?= date("H:i:s",strtotime($post->date))?></li>
									<li><i class="fa fa-calendar"></i> <?= date("M jS, Y",strtotime($post->date))?></li>
								</ul>
							</div>
							<a href="">
							<img src="<?=ROOT.$post->image?>" style="width: 100%;" alt="">
							</a>
							<p><?=nl2br(htmlspecialchars($post->post)) ?> ...</p>

							<div class="pager-area">
								<div class="pager pull-right">
									<?php Page::show_links(4)?>
								</div>
							</div>
						</div>
					</div><!--/blog-post-area-->
					
				</div>	
			</div>
		</div>
		
	<?php $this->view("footer", $data);?>