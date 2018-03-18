<?php
/**
 Template Name: Contact
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		 <div class="uk-container uk-container-center article-type1">
			<div class="uk-block uk-block-muted uk-margin-bottom">
				<h2 class="uk-text-center"><?php the_title(); ?></h2>
				
				<?php if( have_rows('coordinates') ): ?>
				<div class="uk-margin-top map-section uk-width-9-10 uk-container-center">
					<div class="acf-map">
						<?php while ( have_rows('coordinates') ) : the_row(); 
							$location = get_sub_field('location');
						?>
						
						<div class="marker" data-icon="<?php the_sub_field('merker_icon');?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
							<strong><?php the_sub_field('place');?></strong>
							<?php the_sub_field('address_maps');?>
						</div>
					
					<?php endwhile; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="uk-margin-top map-section uk-width-9-10 uk-container-center uk-margin-large-top">
					<div class="featured-image-panel section-faq">
						<!-- Switcher Start -->
							<ul class="uk-grid uk-grid-large" data-uk-switcher="{connect:'#faq-id'}" data-uk-margin>
							<?php if( have_rows('tabs_contact') ): ?>
									<?php $i=1;  ?>	   
								<?php while( have_rows('tabs_contact') ): the_row(); ?>
								<li class="uk-width-medium-1-2"><a class="uk-button 
									<?php if($i == 1): ?>
									tm-button
									<?php elseif($i == 2):?>
									uk-button-primary 
									<?php endif; ?> uk-width-1-1"><?php the_sub_field('tab_title'); ?></a></li>
									<?php $i++; ?>
								<?php endwhile; ?>
							<?php endif; ?>	
								
							</ul>

							<!-- This is the container of the content items -->
							<div id="faq-id" class="uk-switcher faq-index">
							<?php if( have_rows('tabs_contact') ): ?>	   
								<?php while( have_rows('tabs_contact') ): the_row(); ?>
								<div>
									<div class="uk-margin-top uk-clearfix  tm-page-content">
										<?php the_sub_field('tab_content'); ?>
										
									</div>
								</div>
								<?php endwhile; ?>
							<?php endif; ?>
								
							</div>
							<!-- End Switcher -->
					</div>
				</div>




				<?php /*
				<div class="uk-margin-large-top uk-width-9-10 uk-container-center">
					<div class="contact-from uk-position-relative">
						<?php $code = get_field('short_code_contact');?>
						<?php echo do_shortcode($code);?>
						<div class="social-link-section uk-width-1-1 uk-position-absolute">
							<div class="uk-grid uk-grid-width-medium-1-2 uk-grid-collapse">
								<div class="uk-hidden-small"></div>
								<div class="tm-social-bar">
									<ul class="uk-grid">
										<li class="uk-width-1-10">
											<a href="https://twitter.com/"><span class="uk-border-circle mod-icon"><i class="uk-icon-twitter"></i></span></a>
										</li>
										<li class="uk-width-1-10">
											<a href="Facebook.com/framcollege"><span class="uk-border-circle mod-icon"><i class="uk-icon-facebook"></i></span></a>
										</li>
										<li class="uk-width-1-10">
											<a href="Twitter.com/framprep"><span class="uk-border-circle mod-icon type-two"><i class="uk-icon-twitter"></i></span></a>
										</li>
										<li class="uk-width-1-10">
											<a href="Instagram.com/framcollege"><span class="uk-border-circle mod-icon"><i class="uk-icon-instagram"></i></span></a>
										</li>
										<li class="uk-width-1-10">
											<a href="Youtube.com/framlinghamcollege"><span class="uk-border-circle mod-icon"><i class="uk-icon-youtube"></i></span></a>
										</li>
										<li class="uk-width-1-10">
											<a href="Flickr.com/framcollege"><span class="uk-border-circle mod-icon"><i class="uk-icon-flickr"></i></span></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div>
						</div>
					</div>
				</div>
				*/?>
			</div>
		</div>
		
	<?php endwhile; ?>
<?php endif; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRkdu8wrMItyL86EZ1puWx4zrHqdH0PFc"></script>

<?php get_footer();
