<?php
/* Add custom columns. */
function neuf_societies_change_columns( $cols ) {
	$custom_cols = array(
		'cb'        => '<input type="checkbox" />',
		'homepage'     => __( 'Hjemmeside', 'trans' ),
		/*'author'    => __( 'Forfatter', 'trans' ),
		'date'      => __( 'Publiseringsdato', 'trans' ),
		'type'      => __( 'Type', 'trans' ),
		'starttime' => __( 'Dato og klokkeslett', 'trans' ),
		'endtime'   => __( 'Sluttdato og -klokkeslett', 'trans' ),
		'venue'     => __( 'Sted', 'trans' )*/
	);
	return array_merge($cols, $custom_cols);
}
add_filter( "manage_society_posts_columns", "neuf_societies_change_columns" );

// Add values to the custom columns
function neuf_societies_custom_columns( $column, $post_id ) {
	switch ( $column ) {
	case "homepage":
		echo get_post_meta( $post_id, '_neuf_societies_homepage', true);
		break;
	}
}
add_action( "manage_posts_custom_column" , "neuf_societies_custom_columns", 10, 2 );

// Make these columns sortable
function neuf_societies_sortable_columns( $cols ) {
	/*$custom_cols = array(
		'starttime' => 'starttime',
		'endtime'   => 'endtime',
		'type'      => 'type',
		'venue'     => 'venue',
	);*/
	return $cols;
}
add_filter( "manage_edit-society_sortable_columns", "neuf_societies_sortable_columns" );

/* Add metaboxes (with styles) */
function add_societies_metaboxes() {
	add_meta_box(
		'neuf_societies_div',
		__('Foreningsinformasjon'),
		'neuf_societies_div',
		'society',
		'side'
	);
}


/* Metabox with additional info. */
function neuf_societies_div(){
	global $post;

	$society_homepage = get_post_meta($post->ID, '_neuf_societies_homepage', true);
	?>
	<div class="misc-pub-section misc-pub-section-last">
		<label for="_neuf_societies_homepage">Hjemmeside:</label>
		<input type="text" name="_neuf_societies_homepage" value="<?php echo $society_homepage ? $society_homepage : ""; ?>" />
		<?php wp_nonce_field( 'neuf_societies_nonce', 'neuf_societies_nonce' ); ?>
	</div>
	<?php
}
?>
