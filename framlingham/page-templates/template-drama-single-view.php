<?php
/**
 Template Name: Drama Single
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="uk-block uk-block-muted drama-single">
	        <div class="uk-container uk-container-center article-type1 uk-text-center">
	        	<h2><?php the_field('title_drama_single');?></h2>
	        	<?php $images = get_field('image_gallery_drama'); ?>
	        	<?php if($images):?>
		        <div class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-small-1-2" data-uk-grid-margin="">
					<?php foreach( $images as $image ): ?>
						<?php
						$sf_image = $image['ID']; 
						$sf_image  = wp_get_attachment_image_src( $sf_image,array(272,272)); 
						$sf_image = $sf_image[0];
						?>
					<div>
						<div class="uk-overlay uk-animation-hover">
							<img class="uk-width-1-1" src="<?php echo $sf_image;?>">
							<div class="uk-overlay-panel uk-overlay-background uk-animation-reverse uk-animation-fade uk-flex uk-flex-middle uk-flex-center">
								<a href="<?php echo $image['sizes']['large']; ?>" class="uk-position-cover" data-uk-lightbox="{group:'group1'}"></a>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
		        <?php endif;?>

	        </div>
        </div>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
