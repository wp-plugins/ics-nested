=== Nested image caption shortcode ===
Contributors: tychay  
Donate link: http://www.kiva.org/lender/tychay  
Tags: caption, img caption, shortcode, nested shortcode
Tested up to: 4.2.2  
Stable tag: trunk  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

Allows caption shortcode to have shortcodes

== Description ==

The core [`img_caption_shortcode()`](https://developer.wordpress.org/reference/functions/img_caption_shortcode/#source-code) function [doesn't process shortcodes when they're in the caption (just when they're in the image)](https://core.trac.wordpress.org/ticket/24990#comment:13). This simple plugin changes it so that captions can contain shortcodes.

It also fixes some other small edge-case bugs in the original code.

== Installation ==

See ["Installing Plugins" article on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)

Once installed and activated, there's nothing more you need to do (though you
can use filters in your themes `functions.php` to change the behaviors)

== Frequently Asked Questions ==

= How do I use it =

Just activate the plugin.

= What else does it fix =

* When there is no image, core WordPress forgets to process content for shortcodes
* When there is no image or width specified, core WordPress prunes out the entire caption, this tries (sort of) to restore that caption and process it for shortcodes.

== Changelog ==

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* There can only be one (first release)!