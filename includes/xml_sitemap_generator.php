<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action('parse_request', 'my_xml_sitemap_generator');
function my_xml_sitemap_generator($wp) {
  if ($wp->request == 'sitemap.xml') {
    // Auto generate sitemap.xml
    
    Header("Content-type: text/xml");
    //print_r($wp);
    $postsForSitemap = get_posts(array(
      'numberposts' => -1,
      'orderby' => 'modified',
      'post_type'  => array('post','page','product'),
      'order'    => 'DESC'
    ));

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

    foreach($postsForSitemap as $post) {
      setup_postdata($post);

      $postdate = explode(" ", $post->post_modified);

      $sitemap .= '<url>'.
	'<loc>'. get_permalink($post->ID) .'</loc>'.
	'<lastmod>'. $postdate[0] .'</lastmod>'.
	'<changefreq>daily</changefreq>'.
	'<priority>0.8</priority>'.
	'</url>'.PHP_EOL;
    }

    $sitemap .= '</urlset>';

    echo $sitemap;
    
    exit();
  }
}
