# Nova Intercom Viewer

Laravel Nova resource tool to view user's data from [intercom.io](https://www.intercom.com/)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/itainathaniel/nova-intercom-viewer.svg?style=flat-square)](https://packagist.org/packages/itainathaniel/nova-intercom-viewer)
[![Total Downloads](https://img.shields.io/packagist/dt/itainathaniel/nova-intercom-viewer.svg?style=flat-square)](https://packagist.org/packages/itainathaniel/nova-intercom-viewer)

Need to update photos
**User profile partial panel**
![screenshot of the user profile partial panel](https://itainathaniel.github.io/nova-nexmo/balance.png)
**More data** view, including some extra data, location & custom attributes
![screenshot of the more data view, including some extra data, location & custom attributes](https://itainathaniel.github.io/nova-nexmo/balance.png)
**Events view**
![screenshot of the events view](https://itainathaniel.github.io/nova-nexmo/balance.png)
**Conversations view**
![screenshot of the conversations view](https://itainathaniel.github.io/nova-nexmo/balance.png)
**Notes view**
![screenshot of the notes view](https://itainathaniel.github.io/nova-nexmo/balance.png)

## Installation

This package relies on [Intercom's Laravel package](https://github.com/intercom/intercom-php). If you hadn't installed it already, do that now and follow their instructions, and at the end you need to add Intercom's data to you `config/services.php` file as follows:

```php
'intercom' => [
    'app_id' => env('INTERCOM_APP_ID'),
    'token' => env('INTERCOM_TOKEN'),
    'secret_key' => env('INTERCOM_SECRET_KEY'),
],
```

Install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require itainathaniel/nova-intercom-viewer
```

Now you can register this resource tool in your `App\Nova\User` or any other model who uses Intercom on your application. I'll use the User for demonstration purposes:

```php
// in app/Nova/User.php

use Itainathaniel\IntercomViewer\IntercomViewer;

// ...

public function fields()
{
    return [
        // ...
        IntercomViewer::make()->onlyOnDetail(),
    ];
}
```

The default view in the user profile page contains all the field Intercom provide. You can selectively hide them, by chaining hide function of the maker, like so:

```php
// in app/Nova/User.php

IntercomViewer::make()
	->onlyOnDetail()
	->hideEmail()
	->hideLastseenip(),
```

And so on. The complete list of functions you could use is this:

- `hideAvatar()`
- `hideId()`
- `hideEmail()`
- `hidePhone()`
- `hideName()`
- `hideAnonymous()`
- `hidePseudonym()`
- `hideLastseenip()`
- `hideSessioncount()`
- `hideUnsubscribedfromemails()`
- `hideMarkedemailasspam()`
- `hideHashardbounced()`
- `hideUseragentdata()`
- `hideAnalytics()`

### Security

If you discover any security related issues, please email itainathaniel@gmail.com or use the issue tracker.

## Credits

- [Itai Nathaniel](https://github.com/itainathaniel)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
