<?php
/**
 Template Name: Commercial
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="uk-container uk-container-center uk-text-center">
        	<h2><?php the_title();?></h2>
        </div>
        <!--======================================
        =            Portfolio section            =
        =======================================-->
        <div class="uk-block commercial">
	        <div class="uk-container uk-container-center">
	        	<div class="uk-grid uk-grid-width-medium-1-3 uk-grid-width-1-1" data-uk-grid-margin="">
	        		<?php if( have_rows('commercial_content') ): ?>	   
						<?php while( have_rows('commercial_content') ): the_row(); ?>
							<?php
							$sf_image =  get_sub_field('image');
							$sf_image  = wp_get_attachment_image_src( $sf_image, array(372,315)); 
							$sf_image = $sf_image[0];
							?>
		        	<div>
			        	<div class="uk-overlay uk-animation-hover">
						    <img class="uk-width-1-1" src="<?php echo $sf_image;?>">
						    <div class="uk-overlay-panel tm-overlay uk-overlay-background uk-animation-reverse uk-animation-fade uk-flex uk-flex-middle uk-flex-center">
						    	<a  class="uk-button-large uk-width-1-1 uk-flex uk-flex-center uk-flex-middle" href="<?php the_sub_field('link'); ?>"><?php the_sub_field('title'); ?></a>
						    </div>
						</div>
					</div>
						<?php endwhile; ?>
					<?php endif; ?>	
					
	        	</div>
	        </div>
        </div>
        </div>
        
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
