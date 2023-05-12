<?php

/**
 * Registers the `plantarum_plant` post type.
 */
function plantarum_plant_init() {
	register_post_type(
		'plantarum_plant',
		[
			'labels'                => [
				'name'                  => __( 'Plants', 'plantarum' ),
				'singular_name'         => __( 'Plant', 'plantarum' ),
				'all_items'             => __( 'All Plants', 'plantarum' ),
				'featured_image'        => _x( 'Featured Image', 'plantarum_plant', 'plantarum' ),
				'set_featured_image'    => _x( 'Set featured image', 'plantarum_plant', 'plantarum' ),
				'remove_featured_image' => _x( 'Remove featured image', 'plantarum_plant', 'plantarum' ),
				'use_featured_image'    => _x( 'Use as featured image', 'plantarum_plant', 'plantarum' ),
				'filter_items_list'     => __( 'Filter plants list', 'plantarum' ),
				'items_list_navigation' => __( 'Plants list navigation', 'plantarum' ),
				'items_list'            => __( 'Plants list', 'plantarum' ),
				'new_item'              => __( 'New Plant', 'plantarum' ),
				'add_new'               => __( 'Add New', 'plantarum' ),
				'add_new_item'          => __( 'Add New Plant', 'plantarum' ),
				'edit_item'             => __( 'Edit Plant', 'plantarum' ),
				'view_item'             => __( 'View Plant', 'plantarum' ),
				'view_items'            => __( 'View Plants', 'plantarum' ),
				'search_items'          => __( 'Search plants', 'plantarum' ),
				'not_found'             => __( 'No plants found', 'plantarum' ),
				'not_found_in_trash'    => __( 'No plants found in trash', 'plantarum' ),
				'menu_name'             => __( 'Plants', 'plantarum' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title' ],
			'register_meta_box_cb'	=> 'plantarum_meta_box_cb',
			'has_archive'           => false,
			'rewrite'               => [
				'slug' => 'plants'
			],
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'plantarum_plant',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'plantarum_plant_init' );

/**
 * Sets the post updated messages for the `plantarum_plant` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `plantarum_plant` post type.
 */
function plantarum_plant_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['plantarum_plant'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Plantarum plant updated. <a target="_blank" href="%s">View plant</a>', 'plantarum' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'plantarum' ),
		3  => __( 'Custom field deleted.', 'plantarum' ),
		4  => __( 'Plantarum plant updated.', 'plantarum' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Plantarum plant restored to revision from %s', 'plantarum' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Plantarum plant published. <a href="%s">View plantarum plant</a>', 'plantarum' ), esc_url( $permalink ) ),
		7  => __( 'Plantarum plant saved.', 'plantarum' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Plantarum plant submitted. <a target="_blank" href="%s">Preview plantarum plant</a>', 'plantarum' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Plantarum plant scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview plantarum plant</a>', 'plantarum' ), date_i18n( __( 'M j, Y @ G:i', 'plantarum' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Plantarum plant draft updated. <a target="_blank" href="%s">Preview plantarum plant</a>', 'plantarum' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'plantarum_plant_updated_messages' );

/**
 * Sets the bulk post updated messages for the `plantarum_plant` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `plantarum_plant` post type.
 */
function plantarum_plant_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['plantarum_plant'] = [
		/* translators: %s: Number of plantarum plants. */
		'updated'   => _n( '%s plantarum plant updated.', '%s plantarum plants updated.', $bulk_counts['updated'], 'plantarum' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 plantarum plant not updated, somebody is editing it.', 'plantarum' ) :
						/* translators: %s: Number of plantarum plants. */
						_n( '%s plantarum plant not updated, somebody is editing it.', '%s plantarum plants not updated, somebody is editing them.', $bulk_counts['locked'], 'plantarum' ),
		/* translators: %s: Number of plantarum plants. */
		'deleted'   => _n( '%s plantarum plant permanently deleted.', '%s plantarum plants permanently deleted.', $bulk_counts['deleted'], 'plantarum' ),
		/* translators: %s: Number of plantarum plants. */
		'trashed'   => _n( '%s plantarum plant moved to the Trash.', '%s plantarum plants moved to the Trash.', $bulk_counts['trashed'], 'plantarum' ),
		/* translators: %s: Number of plantarum plants. */
		'untrashed' => _n( '%s plantarum plant restored from the Trash.', '%s plantarum plants restored from the Trash.', $bulk_counts['untrashed'], 'plantarum' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'plantarum_plant_bulk_updated_messages', 10, 2 );

function plantarum_meta_box_cb( $post ) {
	add_meta_box( 'plantarum-image-gallery', __( 'Images', 'plantarum' ), 'plantarum_render_gallery_meta_box', null, 'normal', 'high' );
}

function plantarum_render_gallery_meta_box( $post ) {
	$images = get_attached_media( 'image' );
	?>
	<div class="plantarum-mb-images">
		<?php foreach( $images as $image ) : ?>
			<div class="plantarum-mb-image">
				<button class="plantarum-mb-image-remove"><?php _e( 'Remove', 'plantarum' ); ?></button>
				<?php echo wp_get_attachment_image( $image->ID ); ?>
		<?php endforeach; ?>
		<div id="plantarum-mb-add-image"><?php _e( 'Add New' ); ?></div>
	</div><!--.plantarum-mb-images-->
	<?php
}