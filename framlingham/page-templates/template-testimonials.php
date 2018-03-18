<?php 
/**
 Template Name: Testimonials
 */
get_header(); ?>
<?php if ( have_posts() ) : ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $page_id_for_menu = $post->post_parent ? $post->post_parent : $post->id; ?>
		<?php $menu_id = get_field('display_menu', $page_id_for_menu); ?>		
		<?php if ($menu_id ) : ?>
		<div id="menu-offcanvas" class="uk-offcanvas tm-offcanvas">
			<div class="uk-offcanvas-bar side-bar">
				<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space' ) ); ?>
			</div>
		</div>
		<?php endif; ?>

		<!--============================
		=            Main Section      =
		=============================-->
		<div class="uk-container uk-container-center article-type1">
			<?php if($menu_id):?>
			<div class="uk-visible-small top-bar uk-margin-bottom">
				<a class="uk-button uk-button-primary uk-width-1-1 uk-margin-bottom" data-uk-offcanvas="{target:'#menu-offcanvas'}"><i class="uk-icon-caret-left"></i> pages within this section </a>
			</div>
			<?php endif;?>
			<div class="uk-grid uk-grid-collapse">
				<div class="uk-width-medium-1-4 side-bar uk-hidden-small">
					<div class="uk-panel uk-height-1-1">
						<?php if ($menu_id ) : ?>
							<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space', 'walker' => new Framlingham_Sublevel_Walker ) ); ?>
					<?php endif; ?>
					</div>
				</div>
				<div class="uk-width-medium-3-4 uk-block-muted white-bg">
					<div class="uk-panel uk-panel-space">
						<h2><?php the_title(); ?></h2>
						<div class="featured-image-panel">
							
								<div class="featured-image">
									<div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
										<?php if( have_rows('slider_image_default',$post->ID) ): ?>
									    <ul class="uk-slideshow">
									    	<?php $i = 0; ?>
									    	<?php while( have_rows('slider_image_default',$post->ID) ): the_row(); ?>
									    	<?php $sf_image  = wp_get_attachment_image_src( get_sub_field('image'), 'large');?>
									        <li><img src="<?php echo $sf_image[0]; ?>"></li>
									        <?php $i++; ?>
									        <?php endwhile; ?>
									    </ul>

										<?php endif; ?>
										<?php if($i > 1): ?>
									    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
									    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
									    <?php endif; ?>

									</div>
								</div>
								<br>
							
							<div class="uk-clearfix uk-text-center quotes_block">
								<?php $the_query = new WP_Query( array('posts_per_page' =>-1,
								'post_type' => 'testimonial')); ?> 
								<?php if( $the_query->have_posts() ): ?>
								<h3><?php the_field('heading_testimonials',$post->ID);?></h3>
									<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<div class="quotes_block_content">
									<p>"<?php the_field('content_testimonial');?>"</p>
									<h5 class="uk-margin-bottom-remove"><?php the_title();?></h5>
									<h6 class="uk-margin-top-remove"><?php the_field('position_testimonial');?></h6>
								</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
							

					</div>
				</div>
			</div>
		</div>
		<!--================================
		=            Section end           =
		=================================-->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
