# WordPress Olegs Theme

Version: 1.0.0

## Author:

Olegs Belousovs ( [@sgelob](https://twitter.com/sgelob) / [olegs.be](http://olegs.be) )

## Summary

WordPress Olegs Theme for use as a photo blog template. Uses SCSS and Normalize.css, and Grunt for all processing tasks. Tested up to WordPress 4.2.1.

## Usage

The theme is setup to use [Grunt](http://gruntjs.com/) to compile SCSS (with source maps). Alternatively, you can use [CodeKit](http://incident57.com/codekit/) or whatever else you prefer to compile the SCSS.

Rename folder to your theme name, change the `sass/style.scss` intro block to your theme information. Open the theme directory in terminal and run `npm install` to pull in all Grunt dependencies. Run `grunt` to execute tasks. Code as you will.

### Features

1. Normalized stylesheet for cross-browser compatibility using Normalize.css version 3 (IE8+)
2. Media Queries can be nested in each selector using SASS
3. SCSS with plenty of mixins ready to go
4. Grunt for processing all SASS

### Suggested Plugins

* [Disqus Comment System](https://wordpress.org/plugins/disqus-comment-system/)
* [PBD AJAX Load Posts](https://github.com/sgelob/wp-ajax-load-more-posts)
* [RICG Responsive Images](https://wordpress.org/plugins/ricg-responsive-images/)
* [WordPress SEO by Yoast](https://wordpress.org/extend/plugins/wordpress-seo/)
* [W3 Total Cache](https://wordpress.org/extend/plugins/w3-total-cache/)

### Contributing

Anyone and everyone is welcome to contribute.

### Credits

Without these projects, this WordPress Olegs Theme wouldn't be here.

* [Normalize.css](http://necolas.github.com/normalize.css)
* [SASS / SCSS](http://sass-lang.com/)
* [Grunt](http://gruntjs.com/)
