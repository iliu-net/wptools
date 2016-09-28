<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Show a list of hyperlink with categories that this post belongs to.
 *
 * Usage example:
 * - [postcategories]
 */
function post_categories_shortcode( $atts ) {
  $category = get_the_category();
  if (empty($category)) return;
  $list = [];
  foreach ($category as $cc) {
    $list[$cc->name] = '<a href="'.
      esc_url(get_category_link($cc->term_id)).
      '">'.esc_html($cc->name).'</a>';
  }
  return implode(', ',$list);
}

add_shortcode( 'postcategories', 'post_categories_shortcode');
