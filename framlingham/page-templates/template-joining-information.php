<?php 
/*
 * Template Name: Joining Information
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
						<!-- Switcher Start -->
							<ul class="uk-grid uk-grid-large" data-uk-switcher="{connect:'#faq-id'}" data-uk-margin>
							<?php if( have_rows('tabs_information') ): ?>
									<?php $i=1;  ?>	   
								<?php while( have_rows('tabs_information') ): the_row(); ?>
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
							<?php if( have_rows('tabs_information') ): ?>	   
								<?php while( have_rows('tabs_information') ): the_row(); ?>
								<div>
									<div class="uk-margin-top uk-clearfix  tm-page-content">
									<?php the_sub_field('title_&_content'); ?>
									</div>

								<?php if( have_rows('manage_downloads_information') ):?>
									<?php while ( have_rows('manage_downloads_information') ) : the_row();?>
										<?php if( get_row_layout() == 'section_heading' ):?>
									<h3 class="tm-download-heading"> <?php the_sub_field('heading'); ?> </h3>
										<?php elseif( get_row_layout() == 'simple_content'): ?>
										<div class="uk-margin-top uk-clearfix  tm-page-content">
											<?php the_sub_field('content'); ?>
										</div>
									<?php elseif( get_row_layout() == 'one_colum'): ?>
									<div class="download-one-coloumn">
										<div class=" uk-grid tm-dowload-area uk-grid-collapse uk-position-relative">
												<div class=" uk-width-9-10">
													<?php $button_label = get_sub_field('button_label'); ?>    
													<h6 class="tm-download-content"><?php echo $button_label; ?></h6>
													<span class="tm-download-content">PDF</span>
												</div>
												<div class="uk-width-1-10 uk-text-center download-image">
													<?php $file = get_sub_field('downloadable_pdf'); ?>
													<a target="_blank" href="<?php echo $file;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg></a>
													<a class="uk-position-cover" href="<?php echo $file;?>"></a>
												</div>	
											</div>
										</div>
										<?php elseif( get_row_layout() == 'two_column'): ?>
										<div class="download-two-coloumn">
											<div class="uk-grid uk-grid-width-medium-1-2">	
												<div class="uk-position-relative">
													<div class=" uk-grid tm-dowload-area uk-grid-collapse">
														<div class=" uk-width-9-10">
															<h6 class="tm-download-content">Information for parents</h6>
															<span class="tm-download-content">PDF</span>
														</div>
														<div class="uk-width-1-10 uk-text-center download-image">
															<a target="_blank" href="<?php the_sub_field('first_pdf');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg>	</a>
															<a class="uk-position-cover" href="<?php echo $file;?>"></a>
														</div>	
													</div>
												</div>
												<div>
													<div class=" uk-grid tm-dowload-area uk-grid-collapse">
														<div class=" uk-width-9-10">
															<h6 class="tm-download-content">Information for parents2</h6>
															<span class="tm-download-content">PDF</span>
														</div>
														<div class="uk-width-1-10 uk-text-center download-image">
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
