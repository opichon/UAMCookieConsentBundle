(function() {
    var plugin = function( $ ) {
        $( document ).ready( function() {
            var warning = $( ".cookie-consent" ),
                button = $( "button.close", warning );

               console.log( "cookie consent" );
            warning.show();

            button.click (function() {
                warning.hide();

                var expiry = new Date();

                expiry.setTime(expiry.getTime() + (warning.data( "cookie-expiry" ) * 1000 * 60 * 60 * 24));

                document.cookie = warning.data( "cookie-name" ) + "=1; expires=" + expiry.toGMTString();
            });
        });
    };

    if ( typeof define === 'function' && define.amd ) {
        define(
            "cookie_consent",
            [ "jquery" ],
            function( $ ) {
                return plugin( $ );
            }
        );
    } else {
        plugin( jQuery );
    }
}());
