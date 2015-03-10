lorem shortcode
===


Donate link: http://soderlind.no/donate/
Tags: lorem ipsum, dummy text, dummy image, shortcode
Requires at least: 2.8.6
Tested up to: 3.9
Stable tag: 1.2.0

The plugin contains two shortcodes, `lorem` and `loremimage`, the `loremimage` shortcode can be nested in the `lorem` shortcode.

Description 
---

The plugin contains two shortcodes, `[lorem]` and `[loremimage]`, the `[loremimage]` shortcode can be nested in the `[lorem]` shortcode. The shortcodes generate dummy text and image when needed.

Usage
---

Add the `[lorem]` and/or `[loremimage]` shortcode to a post or page

**Parameters, all are optional**

**[lorem]**

* p="3" Number of paragraphs. Default is 5
* l="7", Number of lines per paragraph. Default is 3
* w="3" Number of words per line.
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

 **Example** 

[lorem p="1" l="20" w="5"]
    [loremimage size="300x300" style="padding:5px;"]
[/lorem]
`

For more information and screenshots, please see the [plugin home page](http://soderlind.no/archives/2010/11/17/lorem-shortcode/)

Installation 
---

**Requirement** 
* PHP: 5.2.x or newer

**Manual Installation** 
* Upload the files to wp-content/plugins/lorem-shortcode/
* Activate the plugin

 **Automatic Installation** 
* On your WordPress blog, open the Dashboard
* Go to Plugins->Install New
* Search for "lorem shortcode"
* Click on install to install the lorem shortcode


== Changelog ==
= 1.2.0 =
* Added [Shortcake](https://github.com/fusioneng/Shortcake)
= 1.1.1 =
* Tested with 3.9, bumped version number
= 1.1 =
* Added support for embedded shortcodes and added the [loremimage] short code. The [loremimage] can be used by itself. The image is created using [http://dummyimage.com/](http://dummyimage.com/)
= 1.0 = 
* initial release

Contributors
---

- [Per Søderlind](https://github.com/soderlind)
