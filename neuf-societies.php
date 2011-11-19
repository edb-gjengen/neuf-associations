<?php
/*
  Plugin Name: neuf-societies
  Plugin URI: http://www.studentersamfundet.no
  Description: Society custom post type
  Version 0.1
  Author: EDB-web
  Author URI: http://www.studentersamfundet.no
  License: GPL v2 or later
 */

/* TODO (nikolark):
 *  - Pickup stuff from: http://codex.wordpress.org/Post_Types
 */
require_once( 'neuf-societies-post-type.php' );
require_once( 'neuf-societies-admin.php' );

/* Register the post type */
add_action( 'init' , 'neuf_societies_post_type' , 0 );
add_action( 'save_post' , 'neuf_societies_save_postdata');
//add_action( 'publish_post' , 'neuf_societies_save_postdata' );

?>
