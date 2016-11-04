<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function dumb_get_update_data() {
  if (!function_exists('get_core_updates')) require_once(ABSPATH.'wp-admin/includes/update.php');

  $counts = ['plugins' => 0, 'themes' => 0, 'wordpress' => 0, 'translations' => 0 ];
  $update_plugins = get_site_transient( 'update_plugins' );
  if (!empty($update_plugins->response)) $counts['plugins'] = count( $update_plugins->response );
  $update_themes = get_site_transient( 'update_themes' );
  if (!empty($update_themes->response)) $counts['themes'] = count( $update_themes->response );
  $update_wordpress = get_core_updates(['dismissed' => false]);
  if (!empty($update_wordpress) && !in_array($update_wordpress[0]->response, ['development', 'latest'])) $counts['wordpress'] = 1;
  if (wp_get_translation_updates() ) $counts['translations'] = 1;

  $counts['total'] = $counts['plugins'] + $counts['themes'] + $counts['wordpress'] + $counts['translations'];

  $titles = [];
  if ( $counts['wordpress'] )
    $titles['wordpress'] = sprintf( __( '%d WordPress Update'), $counts['wordpress'] );
  if ( $counts['plugins'] )
    $titles['plugins'] = sprintf( _n( '%d Plugin Update', '%d Plugin Updates', $counts['plugins'] ), $counts['plugins'] );
  if ( $counts['themes'] )
    $titles['themes'] = sprintf( _n( '%d Theme Update', '%d Theme Updates', $counts['themes'] ), $counts['themes'] );
  if ( $counts['translations'] )
    $titles['translations'] = __( 'Translation Updates' );

  $update_title = $titles ? esc_attr( implode( ', ', $titles ) ) : '';

  return [ 'counts' => $counts, 'title' => $update_title  ];
}

function wptools_update_notice($wp_admin_bar) {
  //if (current_user_can('update_plugins')||current_user_can('update_themes')||current_user_can('update_core')) return;
  $update_data = dumb_get_update_data();
  if ( !$update_data['counts']['total'] ) return;
  $title = '<span class="ab-icon"></span>';
  $title .= '<span class="ab-label">'.number_format_i18n($update_data['counts']['total']).'</span>';
  $title .= '<span class="screen-reader-text">' . $update_data['title'] . '</span>';
  $wp_admin_bar->add_menu( [
    'id'    => 'updates',
    'title' => $title,
    'href'  => network_admin_url( 'update-core.php' ),
    'meta'  => [
      'title' => $update_data['title'],
    ],
  ]);
}

add_action('admin_bar_menu','wptools_update_notice',50);
