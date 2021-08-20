<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page_clarisa() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		$log_clarisa = get_transient( 'log_clarisa' );
		
		$log_clarisa = 	"<b>Last update: </b>".$log_clarisa['date']."<br>".
						"<h3>SDGs</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['sdg_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['sdg_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['sdg_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['sdg_insert_term']).'<br>'.
						"<h3>Impact Areas</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['impact_areas_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['impact_areas_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['impact_areas_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['impact_areas_insert_term']).'<br>'.
						"<h3>Regions</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['regions_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['regions_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['regions_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['regions_insert_term']).'<br>';
						


		acf_add_local_field_group(
			[
				'key' => 'group_foresight_settings_clarisa',
				'title' => 'IMPORT LOG',
				'fields' => [
					[
						'key' => 'field_list_control',
						'name' => '',
						'type' => 'message',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'message' => $log_clarisa,
						'esc_html' => 0,
					],
				],
				'location' => [
					[
						[
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'theme-general-settings',
						],
					],
				],
				'menu_order' => 1,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			]
		);
	}
}

add_action( 'init', 'register_custom_acf_fields_settings_page_clarisa' );