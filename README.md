# Horaro API PHP Client

This is a PHP library to consume the Horaro API from your PHP projects.

## Installation

Install it via composer :

```
composer require ylorant/horaro-php-client
```

## Usage

Here is an example of how to use the library :

```php
<?php
use Horaro\Client as HoraroClient;

$client = new HoraroClient();
$schedule = $client->getSchedule('speedcombo', 'sta-twitch');

// $schedule is a stdClass object.
```

You can check https://horaro.org/-/api for more info about the objects returned by the API.

Have fun.