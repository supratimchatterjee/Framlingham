<?php
add_theme_support('woocommerce');

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

function my_theme_wrapper_start() {
  echo '<div class="uk-container uk-container-center article-type1">';
  	echo '<div class="uk-grid uk-grid-collapse">';
  		
  		echo '<div class="uk-width-medium-1-1 uk-block-muted white-bg">';
  			echo '<div class="uk-panel uk-panel-space">';
  				echo '<div class="featured-image-panel">';
}
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);

function my_theme_wrapper_end() {
  echo '</div></div></div></div></div>';
}

add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);


function override_page_title() {
	if(is_shop()):
		return false;
	endif;
}
add_filter('woocommerce_show_page_title', 'override_page_title');

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}



add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}


function clear_div_add() {
  echo '<div class="clear"></div>';
}
add_action('woocommerce_after_single_product_summary', 'clear_div_add', 19);





function remove_loop_button()
{
  if( is_product_category() || is_shop()) { 
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
  }
}

add_action( 'woocommerce_after_shop_loop_item', 'remove_loop_button', 1 );

