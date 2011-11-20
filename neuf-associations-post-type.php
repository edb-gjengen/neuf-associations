<?php
/* Setup the custom post type */
function neuf_associations_post_type() {
	$labels = array(
		'name'                  =>      __( 'Associations'                       ),
		'singular_name'         =>      __( 'Association'                         ),
		'add_new'               =>      __( 'Add New Association'                 ),
		'add_new_item'          =>      __( 'Add New Association'                 ),
		'edit_item'             =>      __( 'Edit Association'                    ),
		'new_item'              =>      __( 'Add New Association'                 ),
		'view_item'             =>      __( 'View Association'                    ),
		'search_items'          =>      __( 'Search Associations'                ),
		'not_found'             =>      __( 'No associations found'              ),
		'not_found_in_trash'    =>      __( 'No associations found in trash'     )
	);
	register_post_type(
		'association',
		array(
			'labels'             => $labels,
			'menu_position'      => 5,
			'public'             => true,
			'publicly_queryable' => true,
			'query_var'          => 'association',
			'show_ui'            => true,
			'capability_type'    => 'post',
			'supports'           => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments',
				'revisions',
				'administrator',
				'custom-fields'
			),
			'register_meta_box_cb' => 'add_associations_metaboxes',
		)
	);

}
/* When the post is saved, saves our custom data */
function neuf_associations_save_postdata( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( empty($_POST) || !wp_verify_nonce( $_POST['neuf_associations_nonce'], 'neuf_associations_nonce' ) )
		return;

	// Check permissions
	if ( 'page' == $_POST['post_type'] ) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	}
	// OK, we're authenticated.

	// prefix with protocol if not present
	$mydata = esc_url( $_POST['_neuf_associations_homepage'] );

	// Do something with $mydata 
	// probably using add_post_meta(), update_post_meta(), or 
	// a custom table (see Further Reading section below)
	update_post_meta($post_id, '_neuf_associations_homepage', $mydata);
}
?>
