=== LUG MAP ===
Contributors: c00l2sv
Donate link: http://stas.nerd.ro/donate/
Tags: map, lug, google maps, geolocation, markers, georss
Requires at least: 2.6
Tested up to: 2.9.2
Stable tag: 1.6

Create a map with locations (markers), powered by Google Maps API and jQuery jmap.

== Description ==

The plugin creates a map (using [Google Maps](http://maps.google.com/)) witch can be populated 
by users with markers (for us it represents their 
LUG "Linux Users Group" location, name, web site, coordinator and geographical position.

We are using it for example to show everyone 
how many LUGs are in your country. :) 

It can be also modified to suit your needs.
For example it creates a GeoRSS webservice, once you update the database with markers,
the GeoRSS will be updated live.

== Updates ==

Version 1.6 is a complete OO rewrite.
Moved all the javascript part to jQuery and [jmaps](http://github.com/digitalspaghetti/jmaps)
All the data is now served using a [GeoRSS](http://georss.org/GeoRSS_Simple) feed.
Much cleaner code, easier to hack!

== Installation ==

1. Upload `lug-map` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Settings menu where you'll find the 'Lug Map' settings page

== Changelog ==

= 1.6 =
* Complete OO rewrite. Moved to jQuery. Added GeoRSS webservice.

= 1.5 =
* Sidebar widget and aditional Google Maps related improvements.

= 1.4 =
* Improved plugin styling in admin CP

= 1.3 =
* GMaps API bugfixes and CSS updates.

= 1.2 =
* Fixed bugs with utf-8 encodings, revised translation, moved lug-map page.

= 1.1 =
* First public release.

= 1.0 =
* More or less a hack.

== Frequently Asked Questions ==

= This plugin does...? =

Nothing but a form to add markers and a Google Map with those markers
to any of your pages/articles you wish.

= Want to translate? =

Get the [pot](http://svn.wp-plugins.org/lug-map/trunk/i18n/lug-map.pot) file.

= Want to submit your translation? =

[Send me an email](http://stas.nerd.ro/index.php/about/) directly.
