<?php 
/*
 * Template Name: Key Dates
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
						<div class="featured-image-panel section-faq">

							<div class="featured-image uk-margin-bottom ">
								<div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
									<?php if( have_rows('slider_image_default') ): ?>
									<ul class="uk-slideshow">
										<?php $i = 0; ?>
										<?php while( have_rows('slider_image_default') ): the_row(); ?>
										<?php $sf_image  = wp_get_attachment_image_src( get_sub_field('image'), 'full');?>
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
						<!-- Switcher Start -->
							<ul class="uk-grid uk-grid-large" data-uk-switcher="{connect:'#faq-id'}" data-uk-margin>
							<?php if( have_rows('tabs_key') ): ?>
									<?php $i=1;  ?>	   
								<?php while( have_rows('tabs_key') ): the_row(); ?>
								<li class="uk-width-medium-1-2"><a class="uk-button 
									<?php if($i == 1): ?>
									tm-button
									<?php elseif($i == 2):?>
									uk-button-primary 
									<?php endif; ?> uk-width-1-1"><?php the_sub_field('title'); ?></a></li>
									<?php $i++; ?>
								<?php endwhile; ?>
							<?php endif; ?>	
								
							</ul>

							<!-- This is the container of the content items -->
							<div id="faq-id" class="uk-switcher faq-index">
							<?php if( have_rows('tabs_key') ): ?>	   
								<?php while( have_rows('tabs_key') ): the_row(); ?>

								<div>
									<div class="uk-margin-top uk-clearfix  tm-page-content">
										<table class="uk-table uk-margin-remove" border="0">
											<tbody>
											<?php if( have_rows('content') ): ?>
												<?php while( have_rows('content') ): the_row(); ?>
													<?php $sfheading = get_sub_field('serif_heading'); ?>
													
											<tr>
											<td class="uk-width-1-1 <?php if($sfheading) {?>serif_heading<?php } ?>">
											<div class="new_sub_heading">
												<?php the_sub_field('heading'); ?>
											</div>
											<span><?php the_sub_field('content_table',false, false); ?></span></td>
											</tr>
												<?php endwhile; ?>
											<?php endif; ?>	
											
											
											</tbody>
										</table>
									</div>
								</div>
								<?php endwhile; ?>
							<?php endif; ?>
								
							</div>
						<!-- End Switcher -->
						</div>

						

						
						<!---dwonload area-->
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
