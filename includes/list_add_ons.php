<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * List installed plugins
 *
 * Example:
 * - [list_plugins]
 */
function list_plugins_shortcode( $atts ) {
  if (!function_exists('get_plugins')) require_once (ABSPATH."wp-admin/includes/plugin.php");
  if (!function_exists('wp_update_plugins')) require_once (ABSPATH."wp-includes/update.php");
  wp_update_plugins();
  $transient = get_site_transient('update_plugins');

  $txt = '<table>';
  $txt .= '<tr><th>Plugin</th><th colspan=3>Info</th></tr>';
  $plugins = get_plugins();
  foreach ($plugins as $id=>$dat) {
    $txt .= '<tr>';
    $txt .= '<td rowspan=2>'.$dat['Name'].'</td>';
    $txt .= '<td colspan=3>'.$dat['Description'].'</td>';
    $txt .= '</tr>';
    $txt .= '<tr>';
    $txt .= '<td>'.$dat['Version'];
    if (isset($transient->response[$id])) {
      $new = $transient->response[$id];
      $txt .= '<br/><strong>New Version '.$new->new_version.' available</strong>';
    }
    $txt .= '</td>';
    $txt .= '<td>';
    if ($dat['AuthorURI']) {
      $txt .= '<a href="'.$dat['AuthorURI'].'">'.$dat['Author'].'</a>';
    } else {
      $txt .= $dat['Author'];
    }
    $txt .= '</td>';
    $txt .= '<td>';
    $txt .= '<a href="'.$dat['PluginURI'].'">Details</a>';
    $txt .= '</td>';
    $txt .= '</tr>';
  }
  $txt .= '</table>';
  return $txt;
}
add_shortcode( 'list_plugins', 'list_plugins_shortcode');

/**
 * List installed themes
 *
 * Example:
 * - [list_themes]
 */
function list_themes_shortcode( $atts ) {
  if (!function_exists('wp_update_themes')) require_once (ABSPATH."wp-includes/update.php");
  wp_update_themes();
  $transient = get_site_transient('update_themes');

  $themes = wp_get_themes();
  $txt = '<table>';
  $txt .= '<tr><th>Theme</th><th colspan=3>Info</th></tr>';
  foreach ($themes as $id=>$dat) {
    $txt .= '<tr>';
    $txt .= '<td rowspan=2>'.$dat->Name.'</td>';
    $txt .= '<td colspan=3>'.$dat->Description.'</td>';
    $txt .= '</tr>';
    $txt .= '<tr>';
    $txt .= '<td>'.$dat->Version;
    if (isset($transient->response[$id])) {
      $new = $transient->response[$id];
      $txt .= '<br/><strong>New Version '.$new->new_version.' available</strong>';
    }
    $txt .= '</td>';
    $txt .= '<td>';
    if ($dat->AuthorURI) {
      $txt .= '<a href="'.$dat->AuthorURI.'">'.$dat->Author.'</a>';
    } else {
      $txt .= $dat->Author;
    }
    $txt .= '</td>';
    $txt .= '<td>';
    $txt .= '<a href="'.$dat->ThemeURI.'">Details</a>';
    $txt .= '</td>';
    $txt .= '</tr>';
  }
  $txt .= '</table>';
  return $txt;
}

add_shortcode( 'list_themes', 'list_themes_shortcode');
