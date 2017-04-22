(function( factory ) {
 	if ( typeof define === "function" && define.amd ) {
        define([ "jQuery" ], factory );
    } else if (typeof module === "object" && module.exports) {
		module.exports = function( root, jQuery ) {
            if ( jQuery === undefined ) {
                if ( typeof window !== "undefined" ) {
                    jQuery = require( "jquery" );
                }
                else {
                    jQuery = require( "jquery" )( root );
                }
            }

            factory( jQuery );

            return jQuery;
        };
    } else {
        factory( jQuery );
    }
}( function( $ ) {
    $.fn.cookie_consent = function () {
		var $this = $( this ),
			button = $( "button.close", $this );

		$this.show();

		button.click (function() {
			$this.hide();

			var expiry = new Date();

			expiry.setTime( expiry.getTime() + ( $this.data( "cookie-expiry" ) * 1000 * 60 * 60 * 24 ) );

			document.cookie = $this.data( "cookie-name" ) + "=1; expires=" + expiry.toGMTString();
		});
    };

    $( document ).ready( function() {
    	$( ".cookie-consent" ).cookie_consent();
    });
}));
