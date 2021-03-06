<?php
/**
 Template Name: Home 2
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

	    <!--============================
        =            Banner            =
        =============================--> 
   
        <div class="uk-container-center home-banner">
            
        	<div class="flexslider banner" data-uk-slideshow="{autoplay:true, duration:800}">
        	 	<?php if( have_rows('slider_home') ): ?>
		        <ul class="slides uk-overlay-active">
					<?php while( have_rows('slider_home') ): the_row(); ?>
						<?php $choose = get_sub_field('choose_option');?>
						<?php if ($choose == 'image'): ?>
				   	 	<li class="uk-position-relative">
					    	<?php
							$sf_image = get_sub_field('image');
							$sf_image  = wp_get_attachment_image_src( $sf_image, array(1300,600)); 
							$sf_image = $sf_image[0];
							?>
					        <img src="<?php echo $sf_image; ?>">
					        <div class="uk-overlay-panel uk-overlay-fade uk-flex uk-flex-bottom uk-flex-center uk-overlay-active">
					        	<?php $check = get_sub_field('check_to_show_book_now_section'); ?>
					        		<?php $button_link = get_sub_field('button_link');?>
					        		<?php $button_text = get_sub_field('button_text_home');?>
					        		<?php if($button_link && $button_text): ?>
						        	<div class="uk-margin-large-bottom">
						        		<a href="<?php echo $button_link; ?>" class="uk-button tm-button"><?php echo $button_text; ?></a>
						        	</div>
						        	<?php endif;?>
					        </div>
				        		<?php if($check): ?>
					        	<div class="uk-position-absolute flex-card flex-open">
						        	<div class="flex-content">
						        		<img class="uk-position-absolute" src="<?php echo get_template_directory_uri(); ?>/images/label.svg" data-uk-svg="">
						        		<h1><?php the_sub_field('book_now_heading'); ?></h1>
						        		<h4 class="uk-margin-top-remove"><?php the_sub_field('book_now_sub_heading'); ?></h4>
						        		<h6 class="uk-margin-top-remove">
						        			<?php the_sub_field('book_now_date_&_time'); ?>
						        		</h6>
						        			<?php the_sub_field('book_now_content'); ?>
						        		<a href="<?php the_sub_field('book_now_button_link'); ?>" class="uk-button uk-button-secondary"><?php the_sub_field('book_now_button_text'); ?></a>
					        		</div>
					       		 </div>
				   		 <?php endif;?>
				   	 	</li>
				   	 	<?php else:?>
				    	<li class="video-slide uk-position-relative">
					    	
					        <?php //<img src="http://placehold.it/1228x544"> ?>
				    		<?php $video = get_sub_field('video');?>
				    		<div class="videoWrapper">
								<iframe id="player_1" src="<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe>                            
                            </div>
				    		<span class="uk-position-cover"></span>
				    		<?php /*
					        <!--<div class="uk-overlay-panel uk-overlay-fade uk-flex uk-flex-bottom uk-flex-center">
					        	<?php $check = get_sub_field('check_to_show_book_now_section'); ?>
					        		<?php $button_link = get_sub_field('button_link');?>
					        		<?php $button_text = get_sub_field('button_text_home');?>
					        		<?php if($button_link && $button_text): ?>
						        	<div class="uk-margin-large-bottom">
						        		<a href="<?php echo $button_link; ?>" class="uk-button tm-button"><?php echo $button_text; ?></a>
						        	</div>
						        	<?php endif;?>
					        </div>-->
				        	<?php if($check): ?>
					        <div class="uk-position-absolute flex-card flex-open">
					        	<div class="flex-content">
					        		<img class="uk-position-absolute" src="<?php echo get_template_directory_uri(); ?>/images/label.svg" data-uk-svg="">
					        		<h1><?php the_sub_field('book_now_heading'); ?></h1>
					        		<h4 class="uk-margin-top-remove"><?php the_sub_field('book_now_sub_heading'); ?></h4>
					        		<h6 class="uk-margin-top-remove">
					        			<?php the_sub_field('book_now_date_&_time'); ?>
					        		</h6>
					        			<?php the_sub_field('book_now_content'); ?>
					        		<a href="<?php the_sub_field('book_now_button_link'); ?>" class="uk-button uk-button-secondary"><?php the_sub_field('book_now_button_text'); ?></a>
				        		</div>
					        </div>
				   		 	<?php endif;?>
				   		 	*/?>
				   		</li>
				   		<?php endif; ?>

				 	<?php endwhile;?>
				</ul>
				<?php endif; ?>
				<?php /*
			 	<?php if( have_rows('slider_home') ): ?>
				<ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
					<?php $i = 0; ?>
					<?php while( have_rows('slider_home') ): the_row(); ?>
			        <li data-uk-slideshow-item="<?php echo $i;?>"><a href=""></a></li>
			        <?php $i++; ?>
			        <?php endwhile;?>
			    </ul>
			    <?php endif; ?>
			    */?>

			</div>
			<div class="uk-text-center">
				<a href="#intro" class="uk-button-small uk-button-primary" data-uk-smooth-scroll>scroll down</a>
			</div>
		</div>
        <!--================================
        =            Banner end            =
        =================================-->
        <!--=====================================
        =            Page Intro           =
        ======================================-->
        <div id="intro" class="uk-block">
        	<div class="uk-container uk-container-center">
        		<div class="uk-grid uk-flex-top" data-uk-margin="{cls:'uk-margin-top'}">
        			<div class="uk-width-medium-1-2 uk-text-right uk-text-center-medium">
        				<?php
						$sf_image = get_field('image_home_top_module');
						$sf_image  = wp_get_attachment_image_src( $sf_image, array(270,330)); 
						$sf_image = $sf_image[0];
						?>
        				<img src="<?php echo $sf_image;?>">
        			</div>
        			<div class="uk-width-medium-1-3">
        				<h2><?php the_field('title_home_top_module'); ?></h2>
        				<p>
        					<?php the_field('content_home_top_module'); ?>
						</p>
						<?php $text = get_field('button_text_home_top_module'); ?>
						<?php $link = get_field('button_text_home_top_module_link'); ?>
						<?php if($text && $link ): ?>
        				<a href="<?php echo $link; ?>" class="uk-button"><span><?php echo $text; ?></span></a>
        				<?php endif;  ?>
        			</div>
        		</div>
        	</div>
        </div>
        <!--===============================
        =            Intro end            =
        ================================-->

        <!--======================================
        =            Category section            =
        =======================================-->
        <?php if( have_rows('school_content') ): ?>
        <div class="class-category uk-container-center  uk-padding-bottom-remove">
        	<div class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-small-1-2 uk-grid-width-1-1 uk-grid-collapse">
				<?php while( have_rows('school_content') ): the_row(); ?>
	        	<div class="uk-overlay">
			      	<?php
					$sf_image = get_sub_field('image');
					$sf_image  = wp_get_attachment_image_src( $sf_image,array(270,270)); 
					$sf_image = $sf_image[0];
					?>
				    <img class="uk-width-1-1" src="<?php echo $sf_image; ?>">
				    <div class="uk-overlay-panel tm-overlay uk-overlay-background uk-flex uk-flex-middle uk-flex-center">
				    	<a class="uk-button-large uk-width-1-1 uk-flex uk-flex-middle uk-flex-center"><div><?php the_sub_field('title');?><span><?php the_sub_field('sub_title');?></span></div></a>
				    </div>
				    <a href="<?php the_sub_field('link');?>" class="uk-position-cover"></a>
				</div>
				<?php endwhile; ?>
        	</div>
        </div>
        <?php endif; ?>	
        <!--====================================
        =            End of section            =
        =====================================-->

        <!--==================================
        =            News section            =
        ===================================-->
        <div class="uk-block news-area">
        	<div class="uk-container uk-container-center">
        		<div class="uk-grid" data-uk-margin="{cls:'uk-margin-top'}" data-uk-grid-match="{target:'.uk-panel'}">
        			<div class="uk-width-medium-1-2 uk-text-center">
        				<div class="uk-panel uk-panel-box uk-position-relative tm-cust-padding">
	        				<div class="uk-width-medium-7-10 uk-container-center ">
		        				<h5 class="uk-margin-top">latest tweet</h5>
		        				<img src="<?php echo get_template_directory_uri(); ?>/images/news_1.png">
		        				<figcaption class="uk-margin-top tm-post-title">
		        					<?php $college = get_field('twitter_framcollege','option'); ?>

									<?php $tweets = getTweets(1, $college,array("trim_user" => false)); ?>
									<?php foreach($tweets as $tweet) : ?>
										<?php $tweet_desc =  $tweet['text'];?>
										
										<?php $tweet_desc = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1">$1</a>',$tweet_desc);?>
										<?php $tweet_desc = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $tweet_desc);?>
										<?php $tweet_desc = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $tweet_desc);	?>
										<?php echo $tweet_desc;?>
										<?php $dt = DateTime::createFromFormat('D M d H:i:s P Y', $tweet['created_at']); ?>
										<?php echo $dt->format('Y-m-d H:i:s'); ?>
									
		        				</figcaption>
		        				<div class="uk-position-absolute uk-width-medium-7-10 uk-width-9-10 uk-text-center uk-position-bottom uk-container-center">
			        				<hr>
			        				<div class="author uk-margin-bottom">
			        					By @<?php echo $tweet['user']['screen_name'];?>
			        				</div>
		        				</div>
		        				<?php endforeach; ?>
		        				<!--<a class="uk-position-cover" href="#"></a>-->
	        				</div>
        				</div>
        			</div>
                  
        			<div class="uk-width-medium-1-2 uk-text-center">
        				<div class="uk-panel uk-panel-box uk-position-relative tm-cust-padding">
	        				<div class="uk-width-medium-7-10 uk-container-center ">
	        				<?php $the_query = new WP_Query( array('posts_per_page' => 1,
	        				'post_type' => 'post')); ?> 
	        				<?php if( $the_query->have_posts() ): ?>
		        				<h5 class="uk-margin-top">latest news</h5>
		        				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		        					<?php the_post_thumbnail(array(370,260)); ?>
		        				<figcaption class="uk-margin-top tm-post-title">
		        					<?php the_title(); ?>
		        				</figcaption>
		        				<div class="uk-position-absolute uk-width-medium-7-10 uk-width-9-10 uk-text-center uk-position-bottom uk-container-center">
			        				<hr>
			        				<div class="author uk-margin-bottom">
			        					<?php the_date('l j M Y' ); ?>
			        				</div>
		        				</div>
		        					<a class="uk-position-cover" href="<?php the_permalink(); ?>"></a>
		        				<?php endwhile; ?>
		        			<?php endif;?>

	        				</div>

        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <!--=================================
        =            End section            =
        ==================================-->


	
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
