/* Map tinymce scripts */
(function() {
	"use strict";
	tinymce.PluginManager.add( 'swpsocialshortcodes', function( editor, url ) {
		editor.addButton( 'swpsocialshortcodes', {
			type	: 'menubutton',
			text	: '',
			icon	: 'spost-grid',
			tooltip	: 'Social Stream',
			onselect: function(e) {
			},
			menu: swp_social_shortcodes
		});
	});
})();
