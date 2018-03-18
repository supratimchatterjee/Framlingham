<?php 
/**
 Template Name: Full Width
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
				<div class="uk-width-medium-1-1 uk-block-muted">
					<div class="uk-panel uk-panel-space">
						<h2><?php the_title(); ?></h2>
						<div class="featured-image-panel">
							<?php the_content(); ?>
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
