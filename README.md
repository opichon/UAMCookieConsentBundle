UAMCookieConsentBundle
===================

A symfony 2 bundale that provides a convenient way to allow the user to consent to your symfony app's cookie policy.

Installation
------------

Add the bundle to your project's `composer.json`:

```json
{
    "require": {
        "uam/cookie-consent-bundle": "^1.0",
        ...
    }
}
```

Run `composer install` or `composer update` to install the bundle:

``` bash
$ php composer.phar update
```


Enable the bundle in the app's kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new UAM\CookieConsent\CookieConsentBundle\UAMCookieConsentBundle(),
    );
}
```

If your composer.json does not include the post-install or post-update `installAssets` script handler, then run the following command:

``` bash
$ php app/console assets:install
```

or

``` bash
$ php app/console assets:install --symlink
```

Usage
-----

``` twig
# base.html.twig

{% stylesheets filter="cssrewrite"
    'bundles/uamcookieconsent/css/cookie-consent.css'
%}
	<link href="{{ asset_url }}" type="text/css" rel="stylesheet" media="screen" />
{% endstylesheets %}

{% javascripts
	'bundles/uamcookieconsent/js/cookie-consent.js'
%}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

If you use assetic, you need to declare the UAMCookieConsentBundle in your config file's `assetic` section.

``` twig
# base.html.twig

{% stylesheets filter="cssrewrite"
    '@uam_cookie_consent_css'
%}
    <link href="{{ asset_url }}" type="text/css" rel="stylesheet" media="screen" />
{% endstylesheets %}

{% javascripts
    '@uam_cookie_consent_js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

Licence
-------

This bundle is licensed under the MIT license.

The dataTables jquery plugin is licensed under the MIT license.

Copyright
---------

This bundle is copyright [United Asian Management Limited](http://www.united-asian.com).

The dataTables jquery plugin is copyright [Allan Jardine (www.sprymedia.co.uk)](http://www.sprymedia.co.uk).

All rights reserved by their respective copyright holders.
