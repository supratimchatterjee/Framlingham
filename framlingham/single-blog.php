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
				<div class="uk-width-medium-3-4 uk-block-muted tm-thumb">
					<div class="uk-panel uk-panel-space">
						<div class="uk-width-medium-6-10">
							<h2><?php the_title(); ?></h2>
						</div>
						<span class="publish-date"><?php the_date('l j M Y' ); ?></span>
						<div class="uk-grid" data-uk-grid-margin="">
							<div class="uk-width-medium-7-10">
								<figure>
									<?php the_post_thumbnail('large', array('class' => 'uk-width-1-1'));?>
									<figcaption class="uk-margin-top" style="color:rgb(81, 53, 40)">
										<?php the_content();?>
									</figcaption>
								</figure>

								<div class="uk-grid uk-grid-width-medium-1-3" data-uk-margin="{cls:'uk-margin-top'}">
									<div class="prev">
										<?php previous_post_link( '%link', '<img class="uk-position-absolute" src="'. get_template_directory_uri() .'/images/angle_left.svg" data-uk-svg>PREVIOUS', FALSE, '', 'category' ); ?>        							
									</div>
									<div>
										<a href="<?php echo get_the_permalink(341);?>" class="uk-button uk-button-secondary uk-text-center uk-width-1-1">BACK TO Blogs</a>
									</div>
									<div class="next">
										<?php next_post_link( '%link', '<img class="uk-position-absolute" src="'. get_template_directory_uri() .'/images/angle_right.svg" data-uk-svg>NEXT', FALSE, '', 'category' ); ?>	
									</div>
								</div>
							</div>
							<div class="uk-width-medium-3-10">
								<article class="tm-article">
									<h5 class="tm-article-title">SHARE THIS POST</h5>
									<ul class="uk-padding-remove social-icon-panel">
										<li>
											<a target="_blank" href="https://twitter.com/home?status=<?php the_permalink();?>">
											<span class="uk-border-circle mod-icon-two"><i class="uk-icon-twitter"></i></span> Twitter
											</a>
										</li>
										<li>
											<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><span class="uk-border-circle mod-icon-two"><i class="uk-icon-facebook"></i></span> Facebook</a>
										</li>
									</ul>
								</article>
								<article class="tm-article">
									<h5 class="tm-article-title">LATEST TWEETS FROM @FRAMCOLLEGE</h5>

									<?php $college = get_field('twitter_framcollege','option'); ?>
									<?php $tweets = getTweets(3, $college); ?>
									<?php foreach($tweets as $tweet) : ?>
									<div class="tm-article-content">
										<p>
										<?php echo $tweet['text'];?>
										<?php $dt = DateTime::createFromFormat('D M d H:i:s P Y', $tweet['created_at']); ?>
										<?php echo $dt->format('Y-m-d H:i:s'); ?>
										</p>
										<span>@FramCollege <?php echo $dt->format('j M'); ?></span>
									</div>
									<?php endforeach;?>
									
								</article>
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
