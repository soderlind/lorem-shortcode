=== lorem shortcode ===
Contributors: PerS
Donate link: http://soderlind.no/donate/
Tags: lorem ipsum, dummy text, shortcode
Requires at least: 2.8.6
Tested up to: 3.0.2
Stable tag: trunk

The lorem shortcode for WordPress plugin adds a new shortcode to WordPress, the [lorem] shortcode.

== Description ==

The shortcode generates dummy text when needed. Use shortcode `[lorem]` to generate 5 paragraphs with 3 lines in each ,or `[lorem p="4" l="5"]`, p = number of paragraphs and l = number of lines per paragraph

== Installation ==

= Requirement =
* PHP: 5.2.x or newer

= Manual Installation =
* Upload the files to wp-content/plugins/lorem-shortcode/
* Activate the plugin

= Automatic Installation =
* On your WordPress blog, open the Dashboard
* Go to Plugins->Install New
* Search for "lorem shortcode"
* Click on install to install the lorem shortcode

= Usage = 
* Add the `[lorem]` shortcode to a post or page

= Parameters =
* p="number of paragraphs" eg p="5"
* l="number of lines per paragraph" eg l="3"


== Frequently Asked Questions ==

= What are shortcodes? =

Shortcode, a "shortcut to code", makes it easy to add funtionality to a page or post. When a page with a shortcode is saved, WordPress execute the linked code and embedds the output in the page.

= Writing your own shortcode plugin =

* [Smashing Magazine](http://www.smashingmagazine.com/) has a nice (as allways) article about [Mastering WordPress shortcodes](http://www.smashingmagazine.com/2009/02/02/mastering-wordpress-shortcodes/). The article has several examples you can use as a starting point for writing your own.
* At codplex, you'll find the [Shortcode API documented](http://codex.wordpress.org/Shortcode_API)
* Also, feel free to use this plugin as a template for you own shortcode plugin


== Changelog ==

= 1.0 = 
* initial release