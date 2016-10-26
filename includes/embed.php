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
 * You can specify the video ID or a Playlist (or both).
 *
 * Example:
 * - [youtube width="xxxpx" height="xxxpx" id=XXX playlist=YYYY](optional text)[/embedpdf]
 */
function embed_youtube($atts, $content=null){
  extract(shortcode_atts( array('id' => '', 'width'=>480, 'height'=>320, 'playlist'=>''), $atts));
  $return = $content;
  if($content) $return .= "<br /><br />";
  if ($id || $playlist) {
    $return .= '<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/';
    $return .= $id ? $id : 'videoseries';
    if ($playlist) $return .= '?list='.$playlist;
    $return .= '" frameborder="0" allowfullscreen>';
    $return .= '</iframe>';
  } else {
    $return .= 'MISSING_ID_OR_PLAYLIST';
  }
  
  return $return; 
}
add_shortcode('youtube', 'embed_youtube');