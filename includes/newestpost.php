<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Show the newest post
 *
 * Example:
 * - [newest_post]
 */

function newest_post_shortcode( $atts ) {
  $getpost = get_posts( array('number' => 1) );
  $getpost = $getpost[0];
  $return = $getpost->post_title . "<br />" . $getpost->post_excerpt . "…";
  $return .= "<br /><a href='" . get_permalink($getpost->ID) . "'><em>read more →</em></a>";
  return $return;
}

add_shortcode( 'newest_post', 'newest_post_shortcode');

