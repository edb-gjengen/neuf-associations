<?php
/* Add custom columns. */
function neuf_associations_change_columns( $cols ) {
	$custom_cols = array(
		'cb'        => '<input type="checkbox" />',
		'title'     => __( 'Forening', 'trans' ),
		'image'     => __( 'Bilde', 'trans' ),
		'homepage'     => __( 'Hjemmeside', 'trans' ),
		/*'author'    => __( 'Forfatter', 'trans' ),
		'date'      => __( 'Publiseringsdato', 'trans' ),
		'type'      => __( 'Type', 'trans' ),*/
	);
	return $custom_cols;
}
add_filter( "manage_association_posts_columns", "neuf_associations_change_columns" );

// Add values to the custom columns
function neuf_associations_custom_columns( $column, $post_id ) {
	switch ( $column ) {
	case "homepage":
		$homepage = get_post_meta( $post_id, '_neuf_associations_homepage', true );
		// default to permalink if not set
		$homepage = $homepage ? $homepage : get_permalink( $post_id );
		echo '<a href="'.$homepage.'" alt="'.$homepage.'" target="_blank">'.$homepage.'</a>';
		break;
	case "image":
		$thumb = get_the_post_thumbnail( $post_id, array(100, 50) );
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
		echo '<a href="'.$large_image_url[0].'" alt="'.$large_image_url[0].'">'.$thumb.'</a>';
		break;
	}
}
add_action( "manage_posts_custom_column" , "neuf_associations_custom_columns", 10, 2 );

// Make these columns sortable
function neuf_associations_sortable_columns( $cols ) {
	/*$custom_cols = array(
		'starttime' => 'starttime',
		'endtime'   => 'endtime',
		'type'      => 'type',
		'venue'     => 'venue',
	);*/
	return $cols;
}
add_filter( "manage_edit-association_sortable_columns", "neuf_associations_sortable_columns" );

/* Add metaboxes (with styles) */
function add_associations_metaboxes() {
	add_meta_box(
		'neuf_associations_div',
		__('Foreningsinformasjon'),
		'neuf_associations_div',
		'association',
		'side'
	);
}


/* Metabox with additional info. */
function neuf_associations_div(){
	global $post;

	$association_homepage = get_post_meta( $post->ID, '_neuf_associations_homepage', true );
	?>
	<div class="misc-pub-section misc-pub-section-last">
		<label for="_neuf_associations_homepage">Hjemmeside:</label>
		<input type="text" name="_neuf_associations_homepage" value="<?php echo $association_homepage ? $association_homepage : ""; ?>" />
		<?php wp_nonce_field( 'neuf_associations_nonce', 'neuf_associations_nonce' ); ?>
	</div>
	<?php
}
?>
