<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Embed a PDF viewer
 *
 * Example:
 * - [embedpdf width="xxxpx" height="xxxpx"]http://www.yoursite.com/your.pdf[/embedpdf]
 */
function viewpdf($attr, $url) {
  return '<iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" style="width:' .$attr['width']. '; height:' .$attr['height']. ';" frameborder="0">Your browser should support iFrame to view this PDF document</iframe>';
}
add_shortcode('embedpdf', 'viewpdf');

/**
 * Embed a Youtube video
 *
 * Example:
 * - [youtube width="xxxpx" height="xxxpx" id=XXX](optional text)[/embedpdf]
 */
function embed_youtube($atts, $content=null){
  extract(shortcode_atts( array('id' => '', 'width'=>480, 'height'=>320), $atts));
  $return = $content;
  if($content) $return .= "<br /><br />";
  $return .= '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';   
  return $return; 
}
add_shortcode('youtube', 'embed_youtube');