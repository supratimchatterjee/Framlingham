<?php 
/**
 Template Name: Governor
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
				<div class="uk-width-medium-3-4 uk-block-muted">
					<div class="uk-panel uk-panel-space">
						<h2><?php the_title(); ?></h2>
						<div class="featured-image-panel uk-grid governor-panel">
							<?php if( have_rows('content_gov') ): ?>    
								<?php while( have_rows('content_gov') ): the_row(); ?>
									<?php
										$sf_image = get_sub_field('image_governeror');
										$sf_image  = wp_get_attachment_image_src( $sf_image, array(400,450));
										$sf_image = $sf_image[0];
										$subtitle = get_sub_field('sub_title_governeror');
									?>
								<div class="uk-width-medium-1-3 uk-text-center">
									<img src="<?php echo $sf_image; ?>">
									<h5><?php the_sub_field('title_governeror'); ?></h5>
									<?php if($subtitle): ?>
									<h5><i><?php echo $subtitle ; ?></i></h5>
									<?php endif; ?>
									<h6><?php the_sub_field('position_governeror'); ?></h6>
								</div>	
								<?php endwhile; ?>
							<?php endif; ?>
													
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
