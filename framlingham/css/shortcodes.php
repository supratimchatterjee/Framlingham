<?php
/**
 *
 * Block comment
 *
 */

function button_shortcode_func($atts, $content = null) {
	extract(shortcode_atts(array(
		"href" => '#'
	), $atts));
	return '<a class="uk-button uk-button-secondary uk-margin-small-top" href="'.$href.'">'.$content.'</a>';
}
add_shortcode("button", "button_shortcode_func");


/**
 *
 * Table Shortcode
 *
 */

function table_shortcode_func($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));
	
	if(!$id)
		return;

	$table = get_field('table', $id);

	$results_table = get_field('results_table',$id);



	$output = '';

	if($results_table == 'results'):
		 if( have_rows('results', $id) ):
		 	$output .= '<table border="0" class="uk-table tm-results-table">';
		 		$output .= '<thead><tr><th colspan="6">'.get_the_title($id).'</th></tr></thead>';
		 		$output .= '<tbody>';
			 	while( have_rows('results', $id) ): the_row(); 
				 	$output .= '<tr class="uk-text-center">';
				 	$output .= '<td class="match-result-new">'.get_sub_field('date').'</td>';
				 	$output .= '<td class="team-name">'.get_sub_field('team_1_name').'</td>';

				 	if(get_sub_field('match_results') == 'C') :
				 	
				 	$output .= '<td class="match-cancelled" colspan="3">CANCELLED</td>';
				 	
				 	else :

					 	$output .= '<td class="team-points">'.get_sub_field('team_1_points').'</td>';
					 	$output .= '<td class="match-result">'.get_sub_field('match_results').'</td>';
					 	$output .= '<td class="team-points">'.get_sub_field('team_2_points').'</td>';

				 	endif;
				 	
				 	$output .= '<td class="team-name">'.get_sub_field('team_2_name').'</td>';
				 	$output .= '</tr>';
			 	endwhile;
			 	$output .= '</tbody>';
		 	$output .= '</table>'; 
		 endif; 

	elseif($results_table == 'cricket'):

		if( have_rows('cricket', $id) ):
		 	$output .= '<table border="0" class="uk-table  tm-results-table">';
		 		$output .= '<thead><tr><th colspan="5">'.get_the_title($id).'</th></tr></thead>';
		 		$output .= '<tbody>';
			 	while( have_rows('cricket', $id) ): the_row(); 
				 	$output .= '<tr class="uk-text-center">';
				 	$output .= '<td class="team-name">'.get_sub_field('team_1').'</td>';
					$output .= '<td>'.get_sub_field('team_2').'</td>';
					$output .= '<td class="team-name">'.get_sub_field('results').'</td>';
				 	$output .= '</tr>';
			 	endwhile;
			 	$output .= '</tbody>';
		 	$output .= '</table>'; 
		 endif; 

	elseif($results_table == 'equal'):
	
		if ( $table ) :

			$column_count = count($table['header']);
			$column_class = 'uk-width-1-'.$column_count;


			$output .= '<table border="0" class="uk-table uk-margin-remove equal-table">';

				if ( $table['header'] ) {

					$output .= '<thead>';

						$output .= '<tr>';
							$count = 1;
							foreach ( $table['header'] as $th ) {
								$output .= '<th class="'.$column_class.'">';
									$output .= $th['c'];
								$output .= '</th>';
								$count++;
							}

						$output .= '</tr>';

					$output .= '</thead>';
				}

				$output .= '<tbody>';

					foreach ( $table['body'] as $tr ) {

						$output .= '<tr>';
							$count = 1;
							foreach ( $tr as $td ) {
								$output .= '<td class="'.$column_class.'">';
									$data = $td['c'];
									if( preg_match('~@(.*?)@~', $data, $data_out) ) :
										$subHeading = $data_out[1];
										$replaceText = '@' . $subHeading . '@';
										$subHeading = '<span>'.$subHeading.'</span>';
										$td['c'] = str_replace($replaceText, '', $data) . $subHeading;
									endif;
									$output .= $td['c'];
								$output .= '</td>';
								$count++;
							}

						$output .= '</tr>';
					}

				$output .= '</tbody>';

			$output .= '</table>';
	
		endif;

	else:

		if ( $table ) :

			$column_count = count($table['header']);
			$first_column_class = 'uk-width-medium-'. (5 - ( $column_count - 1 ) ) .'-5';
			$other_column_class = 'uk-width-1-5 uk-text-center';


			$output .= '<table border="0" class="uk-table uk-margin-remove">';

				if ( $table['header'] ) {

					$output .= '<thead>';

						$output .= '<tr>';
							$count = 1;
							foreach ( $table['header'] as $th ) {
								$class = $count == 1 ? $first_column_class : $other_column_class;
								$output .= '<th class="'.$class.'">';
									$output .= $th['c'];
								$output .= '</th>';
								$count++;
							}

						$output .= '</tr>';

					$output .= '</thead>';
				}

				$output .= '<tbody>';

					foreach ( $table['body'] as $tr ) {

						$output .= '<tr>';
							$count = 1;
							foreach ( $tr as $td ) {
								$class = $count == 1 ? $first_column_class : $other_column_class;
								$output .= '<td class="'.$class.'">';
									$data = $td['c'];
									if( preg_match('~@(.*?)@~', $data, $data_out) ) :
										$subHeading = $data_out[1];
										$replaceText = '@' . $subHeading . '@';
										$subHeading = '<span>'.$subHeading.'</span>';
										$td['c'] = str_replace($replaceText, '', $data) . $subHeading;
									endif;
									$output .= $td['c'];
								$output .= '</td>';
								$count++;
							}

						$output .= '</tr>';
					}

				$output .= '</tbody>';

			$output .= '</table>';
	
		endif;

	endif;

	return $output;

}
add_shortcode("table", "table_shortcode_func");

/**
 * Register meta box(es).
 */
function table_shortcode_meta_boxes() {
	add_meta_box( 'meta-box-table-shortcode', __( 'Table Shortcode', 'textdomain' ), 'table_shortcode_display_callback', 'table', 'side' );
}
add_action( 'add_meta_boxes', 'table_shortcode_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function table_shortcode_display_callback( $post ) {
	// Display code/markup goes here. Don't forget to include nonces!
	global $post;
	$id = $post->ID;
	$shortcode = "[table id=".$id."]";	
	echo '<input type="text" value="'.$shortcode.'" readonly>';
}


?>
