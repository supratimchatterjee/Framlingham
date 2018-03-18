<?php
/**
 Template Name: News
 */

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
		<div class="uk-container uk-container-center  article-type1 <?php if(is_page(341)):?>uk-margin-large-bottom<?php endif; ?>">
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
				<?php $category = get_field('choose_category');?>
				
				<?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>
				<?php $the_query = new WP_Query( array('posts_per_page' => 6,'post_type' => 'post',
				 'paged' => $paged,'cat' => $category,'orderby' => 'post_date','order'=> 'DESC' )); ?> 
				<?php if( $the_query->have_posts() ): ?>
				<div class="uk-width-medium-3-4 uk-block-muted ">
					<div class="uk-panel uk-panel-space">
						<?php global $post?>
						<h2 class="uk-text-center"><?php echo get_the_title($post->ID);?></h2>
						<div class="news-post tm-thumb">
							<div id="post-list">
								<div class="uk-grid uk-grid-medium uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-width-small-1-2"  data-uk-margin>
									<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<div id="post-<?php the_ID(); ?>" class="uk-margin-bottom news-card">
										<div class="uk-panel uk-position-relative">
											<div class="uk-panel-teaser">
												<?php the_post_thumbnail(array(270,186));?>
											</div>
											<h3><?php the_title();?></h3>
											<p> <?php the_time('l j M Y' ); ?></p>
											<a class="uk-position-cover" href="<?php the_permalink();?>"></a>
											<a class="uk-button-small uk-button-secondary uk-flex uk-flex-center uk-flex-middle uk-margin-bottom" href="<?php the_permalink();?>"><span>READ MORE</span></a>
										</div>
									</div>
									<?php endwhile;?>	
								</div>
								<?php if($the_query->max_num_pages > 1) :?>
								<div class="next-trigger uk-hidden">
									<?php next_posts_link( 'Older Entries »', $the_query->max_num_pages ); ?>
								</div>
							<?php endif; ?>
							</div>
							<a class="uk-button tm-button2 uk-width-1-1 uk-margin-top load-more-button uk-margin-bottom">+ LOAD MORE <i class="uk-icon-refresh uk-icon-spin uk-float-right"></i></a>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<div class="uk-hidden" id="temp-posts">
					
				</div>
				<?php wp_reset_query();  ?>
			</div>
		</div>
		<!--================================
		=            Section end           =
		=================================-->
		

		
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
