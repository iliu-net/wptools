<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Perform a header redirect in PHP
 *
 * Attributes:
 * - target : Where to 
 *
 * Example:
 * - [html_redirect target="target"]
 */
function html_redirect_shortcode( $atts ) {
  extract(shortcode_atts(array(
    'target' => '',
  ), $atts));
  if (!$target) return '<code>html_redirect</code> missing <code>target</code>';
  $code = '
    <noscript>
	<meta http-equiv="refresh" content="0;URL='.$target.'">
    </noscript>
    <!--[if lt IE 9]><script type="text/javascript">var IE_fix=true;</script><![endif]-->
    <script type="text/javascript">
	var url = "'.$target.'";
	if(typeof IE_fix != "undefined") // IE8 and lower fix to pass the http referer
	{
		document.write("redirecting..."); // Do not remove this line or appendChild() will fail because it is called before document.onload to make the redirect as fast as possible. Nobody will see this text, it is only a tech fix.
		var referLink = document.createElement("a");
		referLink.href = url;
		document.body.appendChild(referLink);
		referLink.click();
	}
	else { window.location.replace(url); } // All other browsers
    </script>
    <!-- Credit goes to http://insider.zone/ -->';
  $code .= '<a href="'.$target.'">Click here to go to the target page</a>';
  return $code;
}

add_shortcode( 'html_redirect', 'html_redirect_shortcode');
