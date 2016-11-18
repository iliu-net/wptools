# iliu-tools

* Contributors: aliuly
* Tested up to: 4.5.3
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

A miscellaneous collection of shortcodes and other small
improvements.

Features:

- categories : shortcode that shows the current post's 
  categories.
- cond_content : Different way to conditionally show (or hide)
  text in posts.
- embed : shortcodes to embed content in the page
- list_add_ons : Show the installed (not necessarily active)
  plugins with its upgrade estatus.  You should use the
  cond_content shortcodes to make sure data is not shown
  publicly.
- newestpost : simple shortcode to show the newest post
- post_link_shortcode : A hacked version of this
  [plugin](https://wordpress.org/plugins/post-link-shortcode/)
  to show post permalinks.
- related : show related posts based on tags.
- xml_sitemap_generator : Creates a url {wordpress}/xml_sitemap.xml
  which can be submitted to search engines.
- update notifier: Lets non-admin member that plugins need updating.
  I use this myself because I usually do not login as network admin.
- redirect_shortcode : A short code to help redirect pages.



## Installation

1. Upload to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress


## Changes

- 1.3 :
  - Redirect short code
- 1.2 : 
  - Added a little update notifier for non-admin members
  - Fixed member shortcodes
- 1.1 : Updated youtube shortcode
- 1.0 : First release
