<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Framlingham
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

		<div class="uk-container uk-container-center article-type1">
			<?php if($menu_id):?>
			<div class="uk-visible-small top-bar uk-margin-bottom">
				<a class="uk-button uk-button-primary uk-width-1-1 uk-margin-bottom" data-uk-offcanvas="{target:'#menu-offcanvas'}"><i class="uk-icon-caret-left"></i> pages within this section </a>
			</div>
			<?php endif;?>
			<div class="uk-grid uk-grid-collapse">
				<div class="uk-width-medium-1-4 side-bar uk-hidden-small">
					<div class="uk-panel uk-height-1-1">
					<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space' ) ); ?>
					</div>
				</div>
				<div class="uk-width-medium-3-4 uk-block-muted emp-ind ">
					<div class="uk-panel uk-panel-space">
						<div class="uk-width-medium-1-1">
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field('sub_title_vacancie'); ?></h3>
						</div>
						<div class="featured-image uk-margin-bottom">
							<?php the_post_thumbnail(array(1000,500));?>
						</div>
						<div class="uk-grid uk-margin-large-top" data-uk-grid-margin="">
							<div class="uk-width-large-6-10 right-side-content">

								<h4><?php the_field('job_information_title'); ?></h4>
									<?php the_content(); ?>

								<h4><?php the_field('recruitment_pack'); ?></h4>
									<?php if( have_rows('recruitment_download') ): ?>	   
										<?php while( have_rows('recruitment_download') ): the_row(); ?>
										<div class="download-one-coloumn">
											<div class=" uk-grid tm-dowload-area uk-grid-collapse uk-position-relative">
												<div class=" uk-width-9-10 uk-text-left">
													  
													<h6 class="tm-download-content"><?php the_sub_field('file_name'); ?></h6>
													<span class="tm-download-content"><?php the_sub_field('file_sub_title').' '; ?></span>
												</div>
												<div class="uk-width-1-10 uk-text-center download-image">
													<a target="_blank" href="<?php echo $file;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg></a>
													<a  target="_blank" class="uk-position-cover" href="<?php the_sub_field('file'); ?>"></a>
												</div>	
											</div>
										</div>
										<?php endwhile; ?>
									<?php endif; ?>

										<div class="other-content-new">
										<?php the_field('other_content_new'); ?>
										
										</div>

								<?php $prev_post = get_previous_post(); $next_post = get_next_post(); ?> 
								<div class="uk-flex uk-flex-middle uk-flex-space-between nav">
									
									<div class="uk-width-medium-2-10">
										<?php if(!empty($next_post)):?>
										<a href="<?php echo get_the_permalink($next_post->ID);?>">PREV JOB</a>
										<?php endif;?>
									</div>
									
									<div class="uk-width-medium-5-10 uk-text-center">
										<div class="site-border">
											<a href="<?php echo get_the_permalink(1335); ?>">RETURN TO VACANCIES</a>
										</div>
									</div>
									
									<div class="uk-width-medium-2-10">
										<?php if(!empty($prev_post)):?>
										<a href="<?php echo get_the_permalink($prev_post->ID); ?>">NEXT JOB</a>
										<?php endif;?>
									</div>
									
								</div>
							</div>
							<div class="uk-width-large-4-10 vacancy-sidebar-new">
								<?php if( have_rows('right_side_content') ): ?>
									<?php while( have_rows('right_side_content') ): the_row(); ?>	
								<div class="new-download-content">
									<h4><?php the_sub_field('title'); ?></h4>
									<p><?php the_sub_field('content'); ?></p>
								</div>
									<?php endwhile; ?>
								<?php endif; ?>

								
										
									
							</div>
						</div>
					</div>
					<hr class="uk-invisible">
				</div>
			</div>
		</div>
		<!--================================
		=            Section end           =
		=================================-->
	<?php endwhile; ?>
<?php endif; ?>


<?php
get_footer();
