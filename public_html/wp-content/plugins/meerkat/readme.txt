=== Meerkat ===
Contributors: dartiss
Tags: meerkat, video, stream, embed
Requires at least: 2.8
Tested up to: 4.2.2
Stable tag: 1.0

Embed your Meerkat stream on your site so your followers, friends and fans can watch your stream anywhere.

== Description ==

The embedded player is smart. It will show your live stream if you're live. If you're not live, if will show your next upcoming stream. If you have no upcoming streams, it will display stats from your last stream. If you have not streamed yet, it will show your profile.

The embedded player enables you to decide exactly what appears on your site. You can toggle participation, load the player muted, set a predefined cover image and choose the shape of your player.

To add your stream to your site, simply use the following shortcode

`[meerkat username="meerkatapi"]`

Where you will replace the username of 'meerkatapi' with the stream username - yours or anybody elses.

There are a number of other parameters available, to allow you to personalise the output further.

* **username** - The user to show the embed for. This must be specified.
* **type** - The embedded player is available in 3 sizes - "portrait" (437 x 246), "square" (246 x 246) and "bigsquare" (360 x 360). The default is "portrait".
* **participation** - Set to "true" to include comments, likes & restreams or set to "false" to show just the video. The default is "true".
* **cover** - Override the image for the embedded player in a non-live state. Point it at an image on the web.
* **muted** - Set to "false" and the player will load with audio playing if there is a current live stream or set to "true" and the player will load with audio muted by default. The default is "false".
* **debug** - By default, debug information is output to the page as hidden comments. These are useful when reporting any issues but can be switched off by setting this to "false".

For example...

`[meerkat username="meerkatapi" type="bigsquare" participation="false" muted="true"]`

This would display the stream for the username of "meerkatapi", in a big square format, with social options switched off and the video audio muted.

**Coming soon - display the stream in a widget!**

== Licence ==

This WordPress plugin is licensed under the [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License").

== Installation ==

Meerkat can be found and installed via the Plugin menu within WordPress administration. Alternatively, it can be downloaded and installed manually...

1. Upload the entire `meerkat` folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it, you're done - you just need to add the shortcode!

== Changelog ==

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* Initial release