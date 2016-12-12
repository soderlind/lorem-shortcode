=== lorem shortcode ===
Contributors: PerS
Donate link: http://soderlind.no/donate/
Tags: lorem ipsum, dummy text, dummy image, shortcode, shortcake, shortcode-ui
Requires at least: 2.8.6
Tested up to: 4.7
Stable tag: 1.3.3

The plugin contains two shortcodes, lorem and loremimage, the loremimage shortcode can be nested in the lorem shortcode.

== Description ==
The plugin contains two shortcodes, `[lorem]` and `[loremimage]`, the `[loremimage]` shortcode can be nested in the `[lorem]` shortcode. The shortcodes generates dummy text and image when needed.

= Usage =
Add the `[lorem]` and/or `[loremimage]` shortcode to a post or page, or if the [Shortcode UI](https://wordpress.org/plugins/shortcode-ui/) plugin is installed and activated, in the visual editor, click `Add Media->Insert Post Element->Lorem Ipsum` to add the shortcode.

= Parameters, all are optional =

**[lorem]**

* p="3" Number of paragraphs. Default is 5
* l="7", Number of lines per paragraph. Default is 3
* align="right" This tells how you'd like to allign a nested shortcode. There are two alternatives, left or right. Default is right

**[loremimage]**

The loremimage is created using [http://dummyimage.com/](http://dummyimage.com/), and hence the shortcode supports the same parameters as [http://dummyimage.com/](http://dummyimage.com/).

* size="400x400" Image size. Default is 300x200
* text="lorem ipsum" Default is empty
* fgcolor="fff" Image foreground color. Default is "ccc"
* bgcolor="ccc" Image foreground color. Default is  "eee"
* format="png", Image format. Default is "png"

I've added two additional parameters/values

* size="thumb" This will create a thumbnail, size based on your WordPress image settings. The thumb links to another image and support Lightbox et al (has attribute `rel="lightbox[lorem]"`).
* style="padding:5px;" Adds a style to the loremimage. Default is empty

= Example =

`
[lorem p="1" l="20"]
    [loremimage size="300x300" style="padding:5px;"]
[/lorem]
`

For more information and screenshots, please see the [plugin home page](http://soderlind.no/archives/2010/11/17/lorem-shortcode/)


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

= Optional =

Install the [Shortcode UI](https://wordpress.org/plugins/shortcode-ui/) plugin and activate it.

== Frequently Asked Questions ==

= Where's the Shortcode UI? =

You need to install the [Shortcode UI](https://wordpress.org/plugins/shortcode-ui/) plugin. When the Shortcode UI plugin is installed and activated, in the visual editor, click `Add Media->Insert Post Element->Lorem Ipsum` to add the shortcode.

= What are shortcodes? =

Shortcode, a "shortcut to code", makes it easy to add funtionality to a page or post. When a page with a shortcode is saved, WordPress execute the linked code and embedds the output in the page.

= Writing your own shortcode plugin =

* [Smashing Magazine](http://www.smashingmagazine.com/) has a nice (as allways) article about [Mastering WordPress shortcodes](http://www.smashingmagazine.com/2009/02/02/mastering-wordpress-shortcodes/). The article has several examples you can use as a starting point for writing your own.
* At codplex, you'll find the [Shortcode API documented](http://codex.wordpress.org/Shortcode_API)
* Also, feel free to use this plugin as a template for you own shortcode plugin

== Screenshots ==

1. Using Shortcode UI, insert `[lorem]` shortcode.
2. Using Shortcode UI, edit existing `[lorem]` shortcode.

== Changelog ==
= 1.3.3 =
* Tested & found compatible with WP 4.7.
= 1.3.2 =
* Fix bug in `rand()` max value
= 1.3.1 =
* Remove `extract()` *blush*
* Tested & found compatible with WP 4.6.
= 1.3.0 =
* Update plugin to WPCS standards. Update Shortcode UI support.
* Remove old Shortcode UI files
* Add .pot language file
= 1.1.1 =
* Tested with 3.9, bumped version number
= 1.1 =
* Added support for embedded shortcodes and added the [loremimage] short code. The [loremimage] can be used by itself. The image is created using [http://dummyimage.com/](http://dummyimage.com/)
= 1.0 =
* initial release
