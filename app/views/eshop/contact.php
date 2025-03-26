<?php $this->view("header", $data);?>

	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d97135.96036196654!2d13.989327161643802!3d50.22581543173282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470bc94ed23c856b%3A0x55feb9a97f4cf02a!2zU2xhbsO9!5e0!3m2!1scs!2scz!4v1725615476529!5m2!1scs!2scz" width="100%" height="400" style="border:0; margin-bottom:2rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>			 		
			</div>   

			<div>
			</div>


    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
						<?php if(isset($error)): ?>
						<?php foreach($error as $value): ?>
	    				<div class="status alert alert-danger" style=""><?=$value?></div>
						<?php endforeach;?>
						<?php endif;?>

						<?php if(array_key_exists("success" ,$_GET)): ?>
	    				<div class="status alert alert-success">Message was send successfuly</div>
						<?php endif;?>

				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="<?=old_value("name")?>">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email" value="<?=old_value("email")?>">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject" value="<?=old_value("subject")?>">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"><?=old_value("message")?></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit_contact" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p><?=$company_name?></p>
	    					<p><?=$company_address?></p>
	    					<p><?=$company_state?></p>
							<p>Mobile: <?=$company_phone?></p>
							<p>Email: <?=$email?></p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="<?=$facebook_link;?>"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="<?=$twiter_link;?>"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="<?=$google_plus_link;?>"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
								<a href="<?=$linkedin_link;?>" target="blank"><i class="fa fa-linkedin"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
	<?php $this->view("footer", $data);?>