Application Settings
====================

This scaffold brings a modified settings object to your project called `ApplicationSettings`. You can either
use the class directly, however like all setting objects it's best if you extend the class and provide your
own @property definitions on the doc comment to give your IDE some idea of what settings you're looking to
support.

The key difference with this settings object is that settings are persisted in a repository through the
`ApplicationSetting` model (not singular not plural).

You should not use the `ApplicationSetting` model directly; always use the `ApplicationSettings` class.

Only use ApplicationSettings for settings that can be changed by users in the interface. All other 'static'
settings should be contained in normal setting objects.

~~~ php
$settings = new ApplicationSettings();
$settings->GlobalBounceEmail = "postmaster@widgets.com"
~~~

~~~ php
$settings = new ApplicationSettings();

if ( $settings->InFireSale )
{
    dropPrices();
}
~~~

Defining your own extension of the class:

~~~ php

/**
 * @property string $CurrentRealexToken The token needed to use the realex API
 * @property string $PanicEmailAdddress The email address we're sending panic emails to
 */
class MyApplicationSettings extends ApplicationSettings
{
}
