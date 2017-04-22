(function() {
	var plugin = function( $ ) {
		var warning = $( ".cookie-policy" ),
			button = $( "button.close", warning );

		warning.show();

		button.click (function() {
			warning.hide();

			var expiry = new Date();

			expiry.setTime(expiry.getTime() + (warning.data( "cookie-expiry" ) * 1000 * 60 * 60 * 24));

			document.cookie = warning.data( "cookie-name" ) + "=1; expires=" + expiry.toGMTString();
		});
	};

	if ( typeof define === 'function' && define.amd ) {
		define(
			"cookie_policy",
			[ "jquery" ],
			function( $ ) {
				return plugin( $ );
			}
		);

		require([ "cookie_policy" ]);
	} else {
		plugin( jQuery );
	}
}());
