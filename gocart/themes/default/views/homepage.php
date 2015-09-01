<body data-spy="scroll" data-target=".navbar-default">

  	<!-- begin:navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand visible-xs" href="#home">Jack Lee & Chloe Fong</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#home">Home</a></li>
          	<li><a href="#about">About</a></li>
          	<li><a href="#ceremony">Ceremony</a></li>
          	<li><a href="#photos">Photos</a></li>
          	<li><a href="#story">Story</a></li>
          	<li><a href="#contact">Contact</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <!-- end:navbar -->

    <!-- begin:home -->
    <section id="home" style="background: url(<?php echo theme_img('img01.jpg') ?>);">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12">
    				<h1>Jack Lee & Chloe Fong</h1>
					<h3><span>Are getting</span></h3>
					<!-- <div class="line"><h3>Are getting</h3></div> -->
					<h2><i class="fa fa-heart-o"></i> MARRIED! <i class="fa fa-heart-o"></i></h2>
					<h4>And They are please to </h4>
					<h5><span>~ Invite you ~</span></h5>
    			</div>
    		</div>
    	</div>
    </section>
    <!-- end:home -->
	
	<!-- begin:about -->
	<section id="about">
		<div class="about-inner">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<h2><?php echo $rs_setting['husband_name']?></h2>
						<p><?php echo $rs_setting['husband_description']?></p>
						<blockquote>
							Huat a ~
						<small><?php echo $rs_setting['husband_name']?></small>
						</blockquote>
					</div>
					<!-- break -->

					<div class="col-md-4">
						<div class="about-img-container" style="background: url(<?php echo theme_img('img05.jpg')?> center;"></div>
						<img src="<?php echo theme_img('bottom.png') ?>" class="about-img img-responsive">
					</div>
					<!-- break -->

					<div class="col-md-4">
						<h2><?php echo $rs_setting['wife_name']?></h2>
						<p><?php echo $rs_setting['wife_description']?></p>
						<blockquote>
							Ong a ~
							<small><?php echo $rs_setting['wife_name']?></small>
						</blockquote>
					</div>
					<!-- break -->

				</div>
			</div>
		</div>
	</section>
	<!-- end:about -->

	<!-- begin:ceremony -->
	<section id="ceremony" style="background: url(<?php echo theme_img('img04.jpg') ?>);">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>The Ceremony</h1>
					<h3><span>Will Be Held On</span></h3>
					<h2>17 - 10 - 2015</h2>
					<h5><span>~ October ~</span></h5>
					<h4>Dynasty Dragon Seafood Restaurant</h4>
				</div>
			</div>
		</div>
	</section>
	<!-- end:ceremony -->

	<!-- begin:photos -->
	<section id="photos">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="<?php echo theme_img('bottom.png') ?>" class="about-img img-responsive">
					<h2>Wedding Gallery</h2>
					<p>Show Time</p>
				</div>
				<!-- break -->

				<div class="col-md-8">
					<div id="wedding-photo" class="carousel slide" data-ride="carousel">
				      <div class="carousel-inner">				      
				      	<?php 
				      		$row = 1;
				      		$row_content = '';
				      		$total_row = 1;
				      		$active = '';				      						      		
				      		foreach($rs_gallery as $gallery):				      						      		
					      		if($row == 1):
					      			if($total_row < 3):
					      				$active = 'active';
					      			else:
					      				$active = '';
					      			endif;
					      			
					      			$row_content .= '<div class="item '.$active.'"><div class="row">';
					      			
					      		endif;
					      		
					      		$effect = array("fadeInLeftBig","fadeInDownBig","fadeInRightBig","fadeInUpBig");
					      		$random_keys = array_rand($effect,1);
					      		
					      		$row_content .= '<div class="col-md-4 col-sm-4 col-xs-12 animated '.$effect[$random_keys].'">';
	          					$row_content .= '<a href="'.gallery_img($gallery['image']).'" class="gallery-images">';
	          					$row_content .= '<div class="photo-gallery" style="background: url('.gallery_img($gallery['image']).');"></div>';
	          					$row_content .= '</a></div>';
					      			          						          					
								if($total_row == sizeof($rs_gallery) || $row == 3):				      											
					      			$row_content .= '</div></div>';
					      			$row = 0;				      							      			
					      		endif;				      						      	
					      	
					      		$total_row ++;
					      		$row ++;
				      		endforeach;
				      		
				      		echo $row_content;				      		 
				      	?>
				       	
				      </div>
				      <a class="left carousel-control" href="#wedding-photo" data-slide="prev">
				        <span class="glyphicon glyphicon-chevron-left"></span>
				      </a>
				      <a class="right carousel-control" href="#wedding-photo" data-slide="next">
				        <span class="glyphicon glyphicon-chevron-right"></span>
				      </a>
				    </div>
				</div>
			</div>
		</div>
	</section>
	<!-- end:photos -->

	<!-- begin:story -->
	<section id="story">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>The Story</h2>
					<ul class="content">
						<li>
							<h3 class="content-avatar avatar-top">
								<div class="img-avatar" style="background: url(<?php echo gallery_img($rs_setting['wife_image']) ?>);"></div>
							</h3>
							<ul>
							
							
								<!-- begin:content-text -->
								<!--li class="content-item content-text">
									<h3>Jack :"></h3>
									<div class="text">I meet you at the first time. I smile, and you don't smile back to me. I was silent, and you laugh out loud alone. It's so romantic epic. :))</div>
									<time datetime=""><i class="fa fa-calendar"></i> December, 19 2004</time>
								</li-->
								<!-- end:content-text -->

								
							
								<?php foreach($rs_story as $story):?>
																
								<li class="content-item content-photo">
									<img src="<?php echo gallery_img($story['image']) ?>" alt="ditinggal rabi - together">	
									<p class="caption"><?php echo $story['title']?></p>
									<!-- time datetime=""><i class="fa fa-calendar"></i> January, 19 2005</time-->
								</li>
								
								<?php endforeach;?>
							
								<!-- begin:content-photo -->
								<!--li class="content-item content-photo">
									<img src="<?php echo base_url('uploads/gallery/full/romantic_2.jpg') ?>" alt="ditinggal rabi - together">	
									<p class="caption">At the first date, we ate ice cream together. We enjoyed the evening. Sitting on the Waja along the way back to home. Telling each other ....</p>
									<time datetime=""><i class="fa fa-calendar"></i> January, 19 2005</time>
								</li-->
								<!-- end:content-photo -->

								
								<!-- begin:content-photo -->
								<!--li class="content-item content-photo">
									<img src="<?php echo base_url('uploads/gallery/full/romantic_1.jpg') ?>" alt="ditinggal rabi - sleep together">
									<time datetime=""><i class="fa fa-calendar"></i> October, 17 2015</time>	
								</li-->
								<!-- end:content-photo -->

								<!-- begin:content-chat -->
								<!--li class="content-item content-chat">
									<p class="text chat odd">A : Sist..</p>
									<p class="text chat even">B : Yeah..</p>
									<p class="text chat odd">A : Sist..</p>
									<p class="text chat even">B : Yeahh broth..</p>
									<p class="text chat odd">A : Would you be..</p>
									And then silence....
									<time datetime=""><i class="fa fa-calendar"></i> January, 26 2005</time>
								</li-->
								<!-- end:content-chat -->

								<!-- begin:content-quote -->
								<!--li class="content-item content-quote">
									<blockquote>
										<p>I do not promise anything, I can only promise one thing. I would still handsome until tomorrow... <small>Jack Lee</small></p>
										<time datetime=""><i class="fa fa-calendar"></i> March, 26 2014</time>
									</blockquote>
								</li-->
								<!-- end:content-quote -->

								<!-- begin:content-photo -->
								<!--li class="content-item content-photo">
									<img src="<?php echo theme_img('img07.jpg') ?>" alt="ditinggal rabi - wedding ring">
									<p class="caption">And finally, we are now getting married. :')</p>
									<time datetime=""><i class="fa fa-calendar"></i> September, 09 2015</time>
								</li-->
								<!-- end:content-photo -->

								
							</ul>
						</li>

						<li class="content-end">
							<h3 class="content-avatar avatar-end">
								<div class="img-avatar" style="background: url(<?php echo gallery_img($rs_setting['husband_image']) ?>);"></div>
							</h3>							
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- end:story -->
	<section>
					
		<?php if ($this->session->flashdata('message')):?>
		<div class="alert alert-info">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $this->session->flashdata('message');?>
		</div>
		<?php endif;?>
		
		<?php if ($this->session->flashdata('error')):?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $this->session->flashdata('error');?>
		</div>
		<?php endif;?>
		
		<?php if (!empty($error)):?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $error;?>
		</div>
		<?php endif;?>
	</section>
		
	<!-- begin:contact -->
		<section id="contact">
		
	
		<div id="maps"></div>
		<input type="hidden" class="form-control" id="gps" value="<?php echo $rs_setting['gps'] ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Contact Us</h2>
					<div class="contact-container">
						<div class="row">
							<?php echo form_open('cart/contact'); ?>
							<div class="col-md-6 col-sm-6">
								<textarea name="message" class="form-control " placeholder="Message" required rows="6"><?php echo set_value('message')?></textarea>								
							</div>
							<!-- break -->

							<div class="col-md-6 col-sm-6">
								<input name="name" id="name" type="text" placeholder="Name" required class="form-control" value="<?php echo set_value('name')?>">
								<input name="email" id="email" type="email" placeholder="Email" required class="form-control" value="<?php echo set_value('email')?>">								
								<input type="submit" value="Submit" class="btn btn-lg btn-green" />
								<input type="hidden" value="submitted" name="submitted"/>
								
							</div>
							</form>
						</div>
					</div>
					<h5><span>~ Thank you ~</span></h5>
				</div>
			</div>
		</div>
	</section>
	<!-- end:contact -->

	<!-- begin:copyright -->
	<section id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Jack Lee & Chloe Fong</h2>
					<h3>Yang sangat berbahagia</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<ul class="list-inline social-icon">
						<!--li><a href="#" class="icon-twitter" rel="tooltip" title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a></li-->
						<li><a href="https://www.facebook.com/waichoon.lee/" target="_blank" class="icon-facebook" rel="tooltip" title="Facebook" data-placement="top"><i class="fa fa-facebook-square"></i></a></li>
						<!--li><a href="#" class="icon-google" rel="tooltip" title="Google Plus" data-placement="top"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#" class="icon-instagram" rel="tooltip" title="Instagram" data-placement="top"><i class="fa fa-instagram"></i></a></li-->
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<p>Jack Lee & Chloe Fong's Wedding Invitation built with <i class="fa fa-heart-o"></i> by <a href="https://www.facebook.com/waichoon.lee/" target="_blank">@Jack Lee</a></p>
					<p>Copyright &copy; 2015 All Right Reserved.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- end:copyright -->
