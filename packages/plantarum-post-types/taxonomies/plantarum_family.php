<?php

/**
 * Registers the `plantarum_family` taxonomy,
 * for use with 'plantarum_plant'.
 */
function plantarum_family_init() {
	register_taxonomy( 'plantarum_family', [ 'plantarum_plant' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Plantarum families', 'plantarum' ),
			'singular_name'              => _x( 'Plantarum family', 'taxonomy general name', 'plantarum' ),
			'search_items'               => __( 'Search Plantarum families', 'plantarum' ),
			'popular_items'              => __( 'Popular Plantarum families', 'plantarum' ),
			'all_items'                  => __( 'All Plantarum families', 'plantarum' ),
			'parent_item'                => __( 'Parent Plantarum family', 'plantarum' ),
			'parent_item_colon'          => __( 'Parent Plantarum family:', 'plantarum' ),
			'edit_item'                  => __( 'Edit Plantarum family', 'plantarum' ),
			'update_item'                => __( 'Update Plantarum family', 'plantarum' ),
			'view_item'                  => __( 'View Plantarum family', 'plantarum' ),
			'add_new_item'               => __( 'Add New Plantarum family', 'plantarum' ),
			'new_item_name'              => __( 'New Plantarum family', 'plantarum' ),
			'separate_items_with_commas' => __( 'Separate plantarum families with commas', 'plantarum' ),
			'add_or_remove_items'        => __( 'Add or remove plantarum families', 'plantarum' ),
			'choose_from_most_used'      => __( 'Choose from the most used plantarum families', 'plantarum' ),
			'not_found'                  => __( 'No plantarum families found.', 'plantarum' ),
			'no_terms'                   => __( 'No plantarum families', 'plantarum' ),
			'menu_name'                  => __( 'Plantarum families', 'plantarum' ),
			'items_list_navigation'      => __( 'Plantarum families list navigation', 'plantarum' ),
			'items_list'                 => __( 'Plantarum families list', 'plantarum' ),
			'most_used'                  => _x( 'Most Used', 'plantarum_family', 'plantarum' ),
			'back_to_items'              => __( '&larr; Back to Plantarum families', 'plantarum' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'plantarum_family',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'plantarum_family_init' );

/**
 * Sets the post updated messages for the `plantarum_family` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `plantarum_family` taxonomy.
 */
function plantarum_family_updated_messages( $messages ) {

	$messages['plantarum_family'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Plantarum family added.', 'plantarum' ),
		2 => __( 'Plantarum family deleted.', 'plantarum' ),
		3 => __( 'Plantarum family updated.', 'plantarum' ),
		4 => __( 'Plantarum family not added.', 'plantarum' ),
		5 => __( 'Plantarum family not updated.', 'plantarum' ),
		6 => __( 'Plantarum families deleted.', 'plantarum' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'plantarum_family_updated_messages' );
