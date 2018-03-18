<?php
/**
 Template Name: Technical Main Page
 */

$url = get_field('page_redirect',$post->ID);
if($url):
wp_redirect($url);
exit();
endif;

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $menu_id = get_field('display_menu'); ?>
		<div id="menu-offcanvas" class="uk-offcanvas tm-offcanvas">
			<div class="uk-offcanvas-bar side-bar">
				<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space' ) ); ?>
			</div>
		</div>

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
						<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space', 'walker' => new Framlingham_Sublevel_Walker ) ); ?>
					</div>
				</div>
				<div class="uk-width-medium-3-4 uk-block-muted">
					<div class="uk-panel uk-panel-space">
						<h2><?php the_title(); ?></h2>
						<div class="featured-image-panel">
							<?php if(has_post_thumbnail()) :?>
								<div class="featured-image"><?php the_post_thumbnail('large'); ?></div>
								<br>
							<?php endif; ?>
							<div class="uk-margin-top uk-clearfix">
								<?php the_content(); ?>
							</div>
						</div>
							<?php $check = get_field('testimonial');?>
							<?php if($check):?>
							<div class="uk-slidenav-position fram-testimonial-block uk-margin-large-top uk-text-center" data-uk-slideshow="{autoplay:true}">
								<?php $id = get_field('testimonial_posts');?>
								<?php $the_query = new WP_Query( array('posts_per_page' =>-1,
		        				'post_type' => 'testimonial','post__in' => $id)); ?> 
		        				<?php if( $the_query->have_posts() ): ?>
						        <ul class="uk-slideshow uk-overlay-active">
						        	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
								    <li>
								    	<div class="uk-width-medium-8-10 uk-container-center quote uk-position-relative">
									    	<p>
									    		"<?php the_field('content_testimonial');?>"
									    	</p>
								    	</div>
								    	<div class="author">
								    		<p><?php the_author(); ?></p>
								    	</div>
								    </li>
									<?php endwhile; ?>
								</ul>
								<?php endif;?>
							</div>
							<?php endif;?>

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
