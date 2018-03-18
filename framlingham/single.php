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
						<div class="uk-width-medium-6-12">
							<h2><?php the_title(); ?></h2>
						</div>
						<?php if(in_category(95)): ?>
						<?php else: ?>
							<span class="publish-date"><?php the_date('l j M Y' ); ?></span>
						<?php endif; ?>
						<div class="uk-grid" data-uk-grid-margin="">
							<div class="uk-width-large-7-10">
								<figure>
									<?php the_post_thumbnail('large', array('class' => 'uk-width-1-1'));?>
								</figure>
								<div class="uk-margin-top tm-page-content">
									<?php the_content();?>
								</div>

								<div class="uk-grid uk-grid-width-medium-1-3" data-uk-margin="{cls:'uk-margin-top'}">
									<div class="prev">
										<?php previous_post_link( '%link', '<img class="uk-position-absolute" src="'. get_template_directory_uri() .'/images/angle_left.svg" data-uk-svg>PREVIOUS', TRUE, '', 'category' ); ?> 
									</div>
									<div>
										<a href="<?php echo get_the_permalink(12);?>" class="uk-button uk-button-secondary uk-text-center uk-width-1-1">BACK TO NEWS</a>
									</div>
									<div class="next">
										<?php next_post_link( '%link', '<img class="uk-position-absolute" src="'. get_template_directory_uri() .'/images/angle_right.svg" data-uk-svg>NEXT', TRUE, '', 'category' ); ?>	
									</div>
								</div>
							</div>
							<div class="uk-width-large-3-10">
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
								<article class="tm-article sidebar-latest-tweet">
									<h5 class="tm-article-title">LATEST TWEETS </h5>

									<?php $college = get_field('twitter_framcollege','option'); ?>
									<?php $school = get_field('twitter_framprep', 'option'); ?>

									<?php $tweets = getTweets(2, $college, array("trim_user" => false)); ?>
									<?php $tweets_school = getTweets(1, $school, array("trim_user" => false)); ?>

									<?php $newtweets =(array_merge($tweets,$tweets_school));?>

									


									<?php foreach($newtweets as $tweet) : ?>
									<div class="tm-article-content">
										<p>
										<?php $tweet_desc =  $tweet['text'];?>
										
										<?php $tweet_desc = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1">$1</a>',$tweet_desc);?>
										<?php $tweet_desc = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $tweet_desc);?>
										<?php $tweet_desc = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $tweet_desc);	?>
										<?php echo $tweet_desc;?>							
																				
										<?php $dt = DateTime::createFromFormat('D M d H:i:s P Y', $tweet['created_at']); ?>
										<?php echo $dt->format('Y-m-d H:i:s'); ?>
										</p>
										<span>@<?php echo $tweet['user']['screen_name']." ";?><?php echo $dt->format('j M'); ?></span>
									</div>
									<?php endforeach;?>
									
								</article>

								<div class="tm-archive">
									<h5 class="tm-article-title">Recents posts</h5>
									<div class="monthly-archive">
									<?php $args = array(
										'type'            => 'monthly',
										'limit'           => '3',
										'format'          => 'html', 
										'before'          => '',
										'after'           => '',
										'show_post_count' => false,
										'echo'            => 1,
										'order'           => 'DESC',
									    'post_type'     => 'post'
									);
									wp_get_archives( $args ); ?>
									</div>
									<div class="yearly-archive">
									<?php wp_get_archives( array( 
									    'type'  =>  'yearly',
									    'limit' =>  '4'
									)); ?>
									</div>

								</div>


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
