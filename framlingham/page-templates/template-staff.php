<?php 
/*
 * Template Name: Staff
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
				<div class="uk-width-medium-3-4 uk-block-muted white-bg tm-staff">
					<div class="uk-panel uk-panel-space">
						<h2><?php the_title(); ?></h2>
						<div class="featured-image-panel section-faq">
						<!-- Switcher Start -->
							<ul class="uk-grid uk-grid-large" data-uk-switcher="{connect:'#faq-id'}" data-uk-margin>
							<?php if( have_rows('tabs_staff') ): ?>
									<?php $i=1;  ?>	   
								<?php while( have_rows('tabs_staff') ): the_row(); ?>
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
							<?php if( have_rows('tabs_staff') ): ?>	   
								<?php while( have_rows('tabs_staff') ): the_row(); ?>
								<div>
									<div class="uk-margin-top uk-clearfix  tm-page-content">
										
										<?php if( have_rows('staff_content') ): ?>
											<?php while( have_rows('staff_content') ): the_row(); ?>
										<div class="uk-grid">
											<div class="uk-width-medium-3-10">
												<?php
												$sf_image = get_sub_field('image');
												$sf_image  = wp_get_attachment_image_src( $sf_image, array(270,300));
												$sf_image = $sf_image[0];
												?>
												
												 <img src="<?php echo $sf_image; ?>" alt="">
											</div>

											<div class="uk-width-medium-7-10">
												<h2 class="uk-h3"><?php the_sub_field('title'); ?></h2>
												<h6><?php the_sub_field('position'); ?></h6>
												<?php the_sub_field('content'); ?>
											</div>
										</div>
										<hr class="uk-grid-divider">
											<?php endwhile; ?>
										<?php endif; ?>
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
