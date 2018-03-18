<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Framlingham
 */

?>

		<?php global $post; $parent_id = ''; ?>

		<?php if ($post->post_parent) : ?>
			<?php $parent_id = $post->post_parent; ?>
		<?php elseif($post->ID == 9) : ?>
			<?php $parent_id = 9; ?>
		<?php endif; ?>

		<?php if ($parent_id) : ?>
		<!--======================================
		=         Category type-two section      =
		=======================================-->
		<?php $check = get_field('page_section', $parent_id); ?>
		<?php if($check[0] == 'grid'):?>
			<?php $small = get_field('check_to_show_small_size_text', $parent_id); ?>
		<div class="uk-block drama-gallery <?php if($small):?>tm-thumb<?php endif;?>">
			
			<div class="uk-container-center uk-text-center">
				<!--<h4><?php the_field('grid_heading_bottom', $parent_id);?></h4>-->
				<?php if( have_rows('grid_content', $parent_id) ): ?>
				<div class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-small-1-2 uk-grid-collapse">
				<?php while( have_rows('grid_content', $parent_id) ): the_row(); ?>
					<?php
					$sf_image = get_sub_field('image');
					$sf_image  = wp_get_attachment_image_src( $sf_image,array(540,620)); 
					$sf_image = $sf_image[0];
					?>
						<div class="uk-overlay">
							<img class="uk-width-1-1" src="<?php echo $sf_image; ?>">
							<div class="uk-overlay-panel uk-overlay-background  uk-flex uk-flex-middle uk-flex-center">
							   <a  class="uk-button-large uk-width-1-1 uk-flex uk-flex-middle uk-flex-center"><?php echo get_sub_field('title'); ?></a>
							</div>
							 <a href="<?php the_sub_field('link');?>" class="uk-position-cover"></a>
						</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
		<?php endif;?>
		<!--================================
		=            Section end           =
		=================================-->

		<!--==================================
		=            News section            =
		===================================-->
		<?php if($check[1] == 'tweet' || $check[0] == 'tweet'):?>
		<div class="uk-margin-large-bottom tweet-block">
			<div class="uk-container uk-container-center">
				<div class="uk-grid uk-grid-match" data-uk-margin="" data-uk-grid-match="{target:'.tm-content'}">
					<div class="uk-width-medium-1-2 uk-text-center">
						<div class="uk-panel uk-panel-box">
							<div class="uk-width-medium-9-10 uk-container-center">
							<?php $college = get_field('twitter_framcollege', 'option') ?>

									<?php $tweets = getTweets(3,$college,array("trim_user" => false)); ?>

								<h5 class="uk-margin-top">latest tweets from @<?php echo $tweets[0]['user']['screen_name'];?></h5>
								<div class="tm-content" style="min-height: 312px;">
									
									<?php foreach($tweets as $tweet) : ?>

									<div class="tweet-card">
										<p>
										<?php echo $tweet['text'];?>
										<?php $dt = DateTime::createFromFormat('D M d H:i:s P Y', $tweet['created_at']); ?>
										<?php echo $dt->format('Y-m-d H:i:s'); ?>
										</p>
										<span>@<?php echo $tweet['user']['screen_name'];?> <?php echo $dt->format('j M'); ?></span>
									</div>
									<?php endforeach; ?>
									
									
								</div>  
								<a href="https://twitter.com/<?php echo $college;?>" target="_blank"  class="uk-button uk-margin-bottom"><i class="uk-icon-twitter"></i> follow @<?php echo $tweets[0]['user']['screen_name'];?></a>
							</div>
						</div>
					</div>
					<div class="uk-width-medium-1-2 uk-text-center">
						<div class="uk-panel uk-panel-box type-two">
							<div class="uk-width-medium-9-10 uk-container-center">
							<?php $prep = get_field('twitter_framprep', 'option') ?>
									<?php $tweets = getTweets(3,$prep,array("trim_user" => false)); ?>

								<h5 class="uk-margin-top">latest tweets from @<?php echo $tweets[0]['user']['screen_name'];?></h5>
								<div class="tm-content" style="min-height: 312px;">
									
									<?php foreach($tweets as $tweet) : ?>

									<div class="tweet-card">
										<p>
										<?php echo $tweet['text'];?>
										<?php $dt = DateTime::createFromFormat('D M d H:i:s P Y', $tweet['created_at']); ?>
										<?php echo $dt->format('Y-m-d H:i:s'); ?>
										</p>
										<span>@<?php echo $tweet['user']['screen_name'];?> <?php echo $dt->format('j M'); ?></span>
									</div>
									<?php endforeach; ?>									
								</div>
								<a href="https://twitter.com/<?php echo $prep;?>" target="_blank" class="uk-button uk-margin-bottom"><i class="uk-icon-twitter"></i> follow @<?php echo $tweets[0]['user']['screen_name'];?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>
		<!--==================================
		=             Section End            =
		===================================-->
		<?php endif;?>		
		<footer>
			<div class="uk-block">
				<div class="uk-container uk-container-center uk-text-center">
					<div class="uk-grid uk-width-medium-9-10 uk-container-center" data-uk-margin="{cls:'uk-margin-large-top'}">
						<div class="uk-width-medium-4-10">
							<h5><?php the_field('title_left_section','option'); ?></h5>
							<p>
								<?php the_field('address_Left_section','option'); ?>
							</p>
							<span>
								<?php the_field('phone_left_section','option'); ?>
							</span>
							<span>
								<a href="mailto:<?php the_field('email_left_section','option'); ?>">
								<?php the_field('email_left_section','option'); ?>
								</a>
								
							</span>
						</div>
						<div class="uk-width-medium-4-10 uk-padding-remove uk-push-2-10">
							<h5><?php the_field('right_section_title','option'); ?></h5>
							<p>
								<?php the_field('right_section_address','option'); ?>
							</p>
							<span>
								<?php the_field('right_section_phone_number','option'); ?>
							</span>
							<span>
								<a href="mailto:<?php the_field('right_section_email','option'); ?>"><?php the_field('right_section_email','option'); ?>
								</a>
								
							</span>
						</div>
						<div class="uk-width-medium-2-10 uk-padding-remove uk-pull-4-10">
							<a href="<?php echo home_url( '/' ); ?>"><img src="<?php the_field('footer_logo','option'); ?>" data-uk-svg=""></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom uk-text-center uk-margin-top">
				<span><a target="_black" href="<?php the_field('designed_by_firebrand_link','option'); ?>"><?php the_field('designed_by_firebrand','option'); ?></a> | <a target="_black" href="<?php the_field('made_by_fuse_url','option'); ?>"><?php the_field('made_by_fuse_text','option'); ?></a> <span>©<?php echo date("Y"); ?> <?php the_field('copyright_text','option'); ?></span></span>
				<a class="uk-button-small uk-button-primary" href="#header" data-uk-smooth-scroll>scroll up</a>
			</div>
		</footer>
	<?php wp_footer(); ?>
</body>
</html>
