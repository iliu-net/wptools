<?php
/*
 * The five default user roles are:
 *
 * * Administrator – Has access to all administrative options and features.
 * * Editor – Can manage and publish posts. Traditionally, editors review posts
 *   submitted by contributors and then schedule them for review.
 * * Author – Can publish their own posts when they wish.
 * * Contributor – Can write posts but cannot publish them. Instead, they need to
 *   submit their posts for review.
 * * Subscriber – Has basic functionality such as changing their profile and
 *   leaving comments.
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Hide the content.
 *
 * Usage example:
 * - [hideme]Content to hide[/hideme]
 */
function hideme_shortcode( $atts, $content = "" ) {
	return "";
}
add_shortcode( 'hideme', 'hideme_shortcode');

/**
 * Show/display content depending on the user roles.
 *
 * Roles can be one of: administrator, editor, author, contirbutor, subscriber
 *
 * Usage example:
 * - [enrole editor]Content to show[/enrole] : Content is only show to editors and admins
 * - [enrole !contributor]text[/enrole]: Content shown only to subscribers (not contributors and above).
 */
function enrole_shortcode( $atts, $content = "" ) {
  if (!is_user_logged_in()) return '';
  global $current_user;
  
  $roles = [];
  foreach (["administrator","editor","author","contributor","subscriber"] as $j) {
    if (!count($roles)) {
      if (!in_array($j,$current_user->roles)) continue;
    }    
    $roles[$j] = $j;
  }
  foreach ($atts as $j) {
    if ($j{0} == '!' || $j{0} == '~') {
      if (!isset($roles[substr($j,1)])) {
	return do_shortcode($content);
      }
      continue;
    }
    if (isset($roles[$j])) {
      return do_shortcode($content);
    }
  }
  return '';
}

add_shortcode( 'enrole', 'enrole_shortcode');

/**
 * Show content only to guests
 *
 * Usage example:
 * - [guest]Shown text[/guest]
 */
function visitor_check_shortcode( $atts, $content = null ) {
  if ( ( !is_user_logged_in() && !is_null( $content ) ) || is_feed() )
    return do_shortcode($content);
  return '';
}
add_shortcode( 'guest', 'visitor_check_shortcode' );


/**
 * Show content only to registered users
 *
 * Usage example:
 * - [member]Shown text[/member]
 */
function member_check_shortcode( $atts, $content = null ) {
  if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
    return do_shortcode($content);
  return '';
}
add_shortcode( 'member', 'member_check_shortcode' );

/**
 * Show content only to RSS feeds
 *
 * Usage example:
 * - [feendonly]Shown text[/feedonly]
 */
function feedonly_shortcode( $atts, $content = null) {
  if (!is_feed()) return "";
  return do_shortcode($content);
}
add_shortcode('feedonly', 'feedonly_shortcode');
