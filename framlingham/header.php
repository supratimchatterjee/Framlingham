<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Framlingham
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel='shortcut icon' type='image/x-icon' href='<?php echo get_template_directory_uri();?>/images/favicon.ico' />
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-63383464-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1635134710074527');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1635134710074527&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</head>

<body <?php body_class(); ?>>
    <header id="header">
		<div class="uk-navbar utility-bar">
			<div class="uk-container uk-container-center">
				<ul class="uk-subnav uk-navbar-nav tm-nav-bar-new">
					<li>
						<a href="<?php the_field('left_label_link','option'); ?>"><?php the_field('left_label_text','option'); ?></a>
					</li>
					<li>
						<a href="<?php the_field('parents_portal_link','option') ?>"><?php the_field('parents_portal','option');?></a>
					</li>
				</ul>
				<div class="uk-navbar-flip">
					<ul class="uk-subnav uk-navbar-nav tm-nav-bar-new">
						<li>
							<a href="<?php the_field('right_link','option'); ?>"><?php the_field('right_label_text','option'); ?></a>
						</li>
						<li>
							<a href="<?php the_field('stay_connected_link','option'); ?>"><?php the_field('stay_connected_text','option'); ?></a>
						</li>
						<li class="tm-search-icon-new">
							<a href="http://www.framcollege.co.uk/search/"><i class="uk-icon-search uk-icon-medium"></i></a>
						</li>
					</ul>
				</div>
				
				<div class="responsive-header">
				</div>
			</div>
			<div class="main-menu-button">
				<span class="line line1"></span>
				<span class="line line2"></span>
				<span class="line line3"></span>
			</div>
		</div>
		<nav class="tm-main-menu uk-position-z-index" data-uk-sticky="{top:-68, media: 1220}">
			<div class="uk-container uk-container-center">
				<div class="uk-grid">
					<div class="uk-width-medium-4-10 uk-flex uk-flex-right uk-flex-bottom">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'uk-subnav uk-navbar-nav', 'container' => false ) ); ?>
						
					</div>
					<div class="uk-width-medium-2-10 uk-text-center logo">
						<a class="" href="<?php echo home_url( '/' ); ?>"><img src="<?php the_field('logo','option'); ?>" ></a>
					</div>
					<div class="uk-width-medium-4-10 uk-flex uk-flex-bottom">
						<?php wp_nav_menu( array( 'theme_location' => 'primary_right', 'menu_id' => 'primary-menu-right', 'menu_class' => 'uk-subnav uk-navbar-nav', 'container' => false ) ); ?>
					
					</div>

				</div>
			</div>
		</nav>
		<div class="tm-mobile-nav-drop uk-position-absolute uk-text-center">
			<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_id' => 'primary-menu-mobile',  'container' => false ) ); ?>
			<ul class="uk-grid uk-grid-collapse uk-grid-width-1-1 uk-text-center tm-mobile-utility">
				<li>
					<a href="<?php the_field('left_label_link','option'); ?>"><?php the_field('left_label_text','option'); ?></a>
				</li>
				<li>
					<a href="<?php the_field('parents_portal_link','option') ?>"><?php the_field('parents_portal','option');?></a>
				</li>
				<li>
					<a href="<?php the_field('right_link','option'); ?>"><?php the_field('right_label_text','option'); ?></a>
				</li>
				<li>
					<a href="<?php the_field('stay_connected_link','option'); ?>"><?php the_field('stay_connected_text','option'); ?></a>
				</li>
				<li>
					<a href="http://www.framcollege.co.uk/search/"><i class="uk-icon-search"></i></a>
				</li>
			</ul>
		</div>


		<?php if(is_shop()):?>

			<div class="uk-slidenav-position uk-margin-large-bottom home-banner" data-uk-slideshow="{autoplay:true}">
				<?php if( have_rows('image_shop','option') ): ?>
				<ul class="uk-slideshow">
					
					<?php while( have_rows('image_shop','option') ): the_row(); ?>
					<?php $sf_image  = wp_get_attachment_image_src( get_sub_field('image'), array(1300,600));?>
					<li><img src="<?php echo $sf_image[0]; ?>"></li>
					
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>

				<?php if( have_rows('image_shop','option') ): ?>
					<?php $i = 0; ?>
				<ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
					<?php while( have_rows('image_shop','option') ): the_row(); ?>
	    			<li data-uk-slideshow-item="<?php echo $i; ?>"><a href=""></a></li>
	    			<?php $i++; ?>
	    			<?php endwhile; ?>
				</ul>
				<?php endif; ?>
			</div>

		<?php endif;?>



    </header>