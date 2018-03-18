<?php
/**
 Template Name: School intro page
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
		<div class="uk-container uk-container-center article-type2">
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
				<div class="uk-width-medium-3-4">
					<?php
					$sf_image = get_post_thumbnail_id();
					$sf_image  = wp_get_attachment_image_src( $sf_image, array(928,484));
					$sf_image = $sf_image[0];
					?>

					<img src="<?php echo $sf_image; ?>">
					<div class="uk-panel uk-margin-large-top uk-margin-large-bottom">
						<h2 class="uk-text-center"><?php the_field('title_school');?></h2>
						<div class="uk-width-9-10 uk-container-center">	
							<div class="uk-grid a-type2" data-uk-margin>
								<div class="uk-width-medium-3-10 uk-text-right left-block">
									<p><?php the_field('left_content');?></p>
								</div>
								<div class="uk-width-medium-7-10 uk-text-left right-block">
									<?php the_field('right_content');?>
									<?php $download = get_field('download_file_school');?>
									<?php if($download ):?>
									<a href="<?php echo $download;?>" class="uk-button tm-button3 uk-flex uk-flex-center uk-flex-middle uk-margin-top">DOWNLOAD A PROSPECTUS</a>
									<?php endif?>
								</div>
							</div>
						</div>

					</div>
					<?php
					$sf_image = get_field('image_school');
					$sf_image  = wp_get_attachment_image_src( $sf_image, array(928,484));
					$sf_image = $sf_image[0];
					?>
					<img src="<?php echo $sf_image; ?>">
				</div>
			</div>
		</div>
		<!--================================
		=            Section end           =
		=================================-->
		
		
		
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();
