<?php 
/**
 Template Name: Employment Opportunities
 */
get_header(); ?>
<?php if ( have_posts() ) : ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $page_id_for_menu = $post->post_parent ? $post->post_parent : $post->id; ?>
		<?php $menu_id = get_field('display_menu', $page_id_for_menu); ?>
		<?php $menu_content = get_field('content_sidebar'); ?>		
		<?php if ($menu_id ) : ?>
		<div id="menu-offcanvas" class="uk-offcanvas tm-offcanvas">
			<div class="uk-offcanvas-bar side-bar">
				<?php wp_nav_menu( array('menu' => $menu_id, 'container' => false, 'menu_class' => 'uk-list-space' ) ); ?>
				<div class="new-menu-content">
				<?php echo $menu_content; ?>
				</div>
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
							<div class="featured-image uk-margin-bottom">
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

							<?php if( have_rows('content_gov') ): ?>   
								<div class="uk-grid governor-panel"> 
								<?php while( have_rows('content_gov') ): the_row(); ?>
									<?php $sf_image = get_sub_field('image_governeror'); ?>
									<?php $sf_image  = wp_get_attachment_image_src( $sf_image, array(400,450)); ?>
									<?php $sf_image = $sf_image[0]; ?>
									<?php $subtitle = get_sub_field('sub_title_governeror'); ?>
									<div class="uk-width-medium-1-3 uk-text-center">
										<img src="<?php echo $sf_image; ?>">
										<h5><?php the_sub_field('title_governeror'); ?></h5>
										<?php if($subtitle): ?>
										<h5><i><?php echo $subtitle ; ?></i></h5>
										<?php endif; ?>
										<h6><?php the_sub_field('position_governeror'); ?></h6>
									</div>	
								<?php endwhile; ?>
								</div>
							<?php endif; ?>

							<?php if(get_the_content()) : ?>
								<div class="uk-margin-top uk-clearfix tm-page-content">
									<?php the_content(); ?>

								</div>
							<?php endif; ?>
							<div class="employment-content uk-margin-large-bottom">
								<h3>
									<?php the_field('sub_title_employment'); ?>
								</h3>
									<?php $id = get_field('select');?>
									
								<?php $the_query = new WP_Query( array('posts_per_page' =>-1, 'post_type' => 'vacancy','post__in' => $id)); ?> 
									<?php if( $the_query->have_posts() ): ?>
										
								<div class="uk-grid uk-margin uk-grid-large" data-uk-margin>
									<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<div class="uk-width-medium-1-2">
										<div class="em-base">
											<h4><?php the_title(); ?></h4>
											<div class="em-new-content">
											<p><?php the_field('staff_deperment_name'); ?> <br> CLOSING DATE: <?php the_field('closing_date'); ?></p>
											</div>
											<a class="employment-button" href="<?php the_permalink(); ?>">More</a>
										</div>
										
									</div>
									<?php endwhile; ?>
									
								</div>
										
									<?php endif; ?>
									<?php wp_reset_postdata(); ?>
								<div class="uk-width-medium-1-2 uk-margin-large-top">
									<h4><?php the_field('more_details_title'); ?></h4>
										<?php the_field('more_details_content'); ?>
								</div>
							</div>

							<?php $testimonial_ids = get_field('testimonial_posts'); ?>
							<?php if($testimonial_ids): ?>
								<?php $is_not_slider = get_field('testimonial_alternate'); ?>
								<?php if($is_not_slider) : ?>
									<div class="uk-clearfix uk-text-center quotes_block">
										<?php $the_query = new WP_Query( array('posts_per_page' =>-1, 'post_type' => 'testimonial','post__in' => $testimonial_ids)); ?> 
										<?php if( $the_query->have_posts() ): ?>
											<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
												<div class="quotes_block_content">
													<p>"<?php the_field('content_testimonial');?>"</p>
													<h5 class="uk-margin-bottom-remove"><?php the_title();?></h5>
													<h6 class="uk-margin-top-remove"><?php the_field('position_testimonial');?></h6>
												</div>
											<?php endwhile; ?>
										<?php endif; ?>
									</div>
								<?php else: ?>
									<div class="uk-slidenav-position fram-testimonial-block uk-margin-large-top uk-text-center" data-uk-slideshow="{autoplay:true}">
										<?php $id = get_field('testimonial_posts');?>
										<?php $the_query = new WP_Query( array('posts_per_page' =>-1, 'post_type' => 'testimonial','post__in' => $testimonial_ids)); ?> 
										<?php if( $the_query->have_posts() ): ?>
										<ul class="uk-slideshow uk-overlay-active">
											<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
											<li>
												<div class="uk-width-medium-8-10 uk-container-center quote uk-position-relative">
													<p>"<?php the_field('content_testimonial');?>"</p>
												</div>
												<div class="author">
													<p><?php the_title(); ?></p>
												</div>
											</li>
											<?php endwhile; ?>
										</ul>
										<?php endif; wp_reset_query(); ?>
									</div>
								<?php endif;?>
							<?php endif;?>

							<?php if( have_rows('module_options') ):?>
								<?php while ( have_rows('module_options') ) : the_row();?>
									<?php if( get_row_layout() == 'section_heading' ):?>
										<h3 class="tm-download-heading"> <?php the_sub_field('dwn_heading'); ?> </h3>
									<?php elseif( get_row_layout() == 'simple_content'): ?>
										<div class="uk-margin-top uk-clearfix  tm-page-content"><?php the_sub_field('dwn_content'); ?></div>
									<?php elseif( get_row_layout() == 'one_colum'): ?>
										<div class="download-one-coloumn">
											<div class=" uk-grid tm-dowload-area uk-grid-collapse uk-position-relative">
												<div class=" uk-width-medium-9-10">
													<?php $button_label = get_sub_field('button_label'); ?>    
													<h6 class="tm-download-content"><?php echo $button_label; ?></h6>
													<span class="tm-download-content">PDF</span>
												</div>
												<div class="uk-width-medium-1-10 uk-text-center download-image">
													<?php $file = get_sub_field('downloadable_pdf'); ?>
													<a target="_blank" href="<?php echo $file;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg></a>
													<a class="uk-position-cover" href="<?php echo $file;?>"></a>
												</div>	
											</div>
										</div>
									<?php elseif( get_row_layout() == 'two_column'): ?>
										<div class="download-two-coloumn">
											<div class="uk-grid uk-grid-width-1-2">	
												<div class="uk-position-relative">
													<div class=" uk-grid tm-dowload-area uk-grid-collapse">
														<div class=" uk-width-medium-9-10">
															<h6 class="tm-download-content"><?php the_sub_field('first_label'); ?></h6>
															<span class="tm-download-content">PDF</span>
														</div>
														<div class="uk-width-medium-1-10 uk-text-center download-image">
															<a target="_blank" href="<?php the_sub_field('first_pdf');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg>	</a>
															<a class="uk-position-cover" href="<?php echo $file;?>"></a>
														</div>	
													</div>
												</div>
												<div>
													<div class=" uk-grid tm-dowload-area uk-grid-collapse">
														<div class=" uk-width-medium-9-10">
															<h6 class="tm-download-content"><?php the_sub_field('second_label'); ?></h6>
															<span class="tm-download-content">PDF</span>
														</div>
														<div class="uk-width-medium-1-10 uk-text-center download-image">
															<a target="_blank" href="<?php the_sub_field('second_pdf');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg>	</a>
														</div>	
													</div>
												</div>	
											</div>
										</div>
									<?php endif;?>
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
