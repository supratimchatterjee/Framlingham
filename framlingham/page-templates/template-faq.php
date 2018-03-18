<?php 
/*
 * Template Name: FAQ
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
								<li class="uk-width-medium-1-2"><a class="uk-button tm-button uk-width-1-1"><?php the_field('faqs_school_title'); ?></a></li>
								<li class="uk-width-medium-1-2"><a class="uk-button uk-button-primary uk-width-1-1"><?php the_field('faqs_college_title'); ?></a></li>
							</ul>

							<!-- This is the container of the content items -->
							<div id="faq-id" class="uk-switcher faq-index">		    

								<div>
									<h6><?php the_field('question_title_school'); ?></h6>
									<ol>
									<?php if( have_rows('faqs_school') ): ?>
											<?php $i = 1; ?>
      									<?php while ( have_rows('faqs_school') ) : the_row(); ?>

										<li><a href="#f-index1-<?php echo $i ; ?>" data-uk-smooth-scroll="{offset: 109}"><?php the_sub_field('question'); ?></a></li>
											<?php $i++; ?>
										<?php endwhile; ?>
									<?php endif; ?>

										
										
									</ol>
									<ul>
									<?php if( have_rows('faqs_school') ): ?>
											<?php $i = 1; ?>
      									<?php while ( have_rows('faqs_school') ) : the_row(); ?>

										<li id="f-index1-<?php echo $i;?>" class="faq-answer-strap">
											<h3><?php echo $i;?>.<?php the_sub_field('question'); ?></h3>
											<?php the_sub_field('answer'); ?>
										</li>
											<?php $i++; ?>
										<?php endwhile; ?>
									<?php endif; ?>	
																			
									</ul>
								</div>

								<div>
									<h6><?php the_field('faqs_college_question_title'); ?></h6>
									<ol>
									<?php if( have_rows('faqs_college') ): ?>
											<?php $i = 1; ?>
      									<?php while ( have_rows('faqs_college') ) : the_row(); ?>

										<li><a href="#f-index-<?php echo $i ; ?>" data-uk-smooth-scroll="{offset: 109}"><?php the_sub_field('question'); ?></a></li>
											<?php $i++; ?>
										<?php endwhile; ?>
									<?php endif; ?>

										
										
									</ol>
									<ul>
									<?php if( have_rows('faqs_college') ): ?>
											<?php $i = 1; ?>
      									<?php while ( have_rows('faqs_college') ) : the_row(); ?>

										<li id="f-index-<?php echo $i;?>" class="faq-answer-strap">
											<h3><?php echo $i;?>.<?php the_sub_field('question'); ?></h3>
											<?php the_sub_field('answer'); ?>
										</li>
											<?php $i++; ?>
										<?php endwhile; ?>
									<?php endif; ?>	
																			
									</ul>
								</div>
							</div>
						<!-- End Switcher -->
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
										<p><?php the_title(); ?></p>
									</div>
								</li>
								<?php endwhile; ?>
							</ul>
							<?php endif; wp_reset_query(); ?>
						</div>
						<?php endif;?>

						<!---dwonload area-->
						<?php if( have_rows('faxciable_downloads_module') ):?>
							<?php while ( have_rows('faxciable_downloads_module') ) : the_row();?>
								<?php if( get_row_layout() == 'one_colum' ):?>	
								<div class="download-one-coloumn">
									<h3 class="tm-download-heading"> <?php the_sub_field('title'); ?> </h3>
									<?php if( have_rows('file') ): ?>	   
										<?php while( have_rows('file') ): the_row(); ?>
										<div class=" uk-grid tm-dowload-area uk-grid-collapse">
											<div class=" uk-width-medium-9-10">
													<?php $file = get_sub_field('file'); ?>
												<h6 class="tm-download-content"><?php echo $file['filename'];?></h6>
												<span class="tm-download-content">PDF</span>
											</div>
											<div class="uk-width-medium-1-10 uk-text-center download-image">
												<a target="_blank" href="<?php echo $file['url'];?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg>	</a>
											</div>	
										</div>			
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
								<?php elseif( get_row_layout() == 'two_column'): ?>
									<div class="download-two-coloumn uk-margin-top">
										<h3 class="tm-download-heading"> <?php the_sub_field('title_two'); ?></h3>
										<div class="uk-grid uk-grid-width-1-2">
										<?php if( have_rows('file_upload_two') ): ?>	   
											<?php while( have_rows('file_upload_two') ): the_row(); ?>

											<div>
												<div class=" uk-grid tm-dowload-area uk-grid-collapse">
													<div class=" uk-width-medium-9-10">
														<?php $file = get_sub_field('file_two'); ?>
														<h6 class="tm-download-content"><?php echo $file['filename'] ;?></h6>
														<span class="tm-download-content">PDF</span>
													</div>
													<div class="uk-width-medium-1-10 uk-text-center download-image">
														<a target="_blank" href="<?php echo $file['url'] ;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/download-icon.svg" alt="" data-uk-svg>	</a>
													</div>	
												</div>
											</div>
												<?php endwhile; ?>	
											<?php endif;?>							
										</div>	
									</div>
								<?php endif;?>
							<?php endwhile; ?>
						<?php endif; ?>	
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
