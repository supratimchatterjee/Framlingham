<?php
/**
 * Template Name: Search
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Framlingham
 */

get_header(); ?>

<div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true, kenburns:true}">
	<ul class="uk-slideshow uk-slideshow-fullscreen">
		<li>			
			<img src="<?php echo get_template_directory_uri();?>/images/Brandeston-Hall-400.jpg">
			<div class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-middle uk-flex-center">
				
					<div class="uk-text-center">
						<h1><?php esc_html_e( 'Search', 'framlingham' ); ?></h1>
						<p><b><?php esc_html_e( 'Search by word, name, keyword', 'framlingham' ); ?></b></p>
			<p><?php get_search_form();?></p>
					</div>
				
			</div>
		</li>
	</ul>
</div>


	
<?php
get_footer();
