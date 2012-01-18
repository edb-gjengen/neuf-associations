<?php
/*
  Plugin Name: neuf-associations
  Plugin URI: http://www.studentersamfundet.no
  Description: Association custom post type
  Version 0.1
  Author: EDB-web
  Author URI: http://www.studentersamfundet.no
  License: GPL v2 or later
 */

/* TODO (nikolark):
 *  - Pickup stuff from: http://codex.wordpress.org/Post_Types
 *  - Translate it: http://codex.wordpress.org/I18n_for_WordPress_Developers
 */
require_once( 'neuf-associations-post-type.php' );
require_once( 'neuf-associations-admin.php' );

/* Register the post type */
add_action( 'init' , 'neuf_associations_post_type' , 0 );
add_action( 'save_post' , 'neuf_associations_save_postdata');
//add_action( 'publish_post' , 'neuf_associations_save_postdata' );

?>
