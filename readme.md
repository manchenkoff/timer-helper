# Timer

[![Latest Stable Version](http://poser.pugx.org/manchenkoff/timer-helper/v)](https://packagist.org/packages/manchenkoff/timer-helper)
[![Total Downloads](http://poser.pugx.org/manchenkoff/timer-helper/downloads)](https://packagist.org/packages/manchenkoff/timer-helper)
[![License](http://poser.pugx.org/manchenkoff/timer-helper/license)](https://packagist.org/packages/manchenkoff/timer-helper)
[![PHP Version Require](http://poser.pugx.org/manchenkoff/timer-helper/require/php)](https://packagist.org/packages/manchenkoff/timer-helper)

**Timer** is a class to help build time interval value in seconds by object-oriented style

## Installation 

You have to run following command to add a dependency to your project

```bash
composer require manchenkov/timer
```

or you can add this line to `require` section of `composer.json`

```
"manchenkov/timer": "*"
```

## Usage

```php
use Manchenkov\Timer\Timer;

$timer = Timer::get()->hours(5)->minutes(10)->seconds(34);

$intervalValue = $timer->asNumber(); // <int> -> 18634 = 34 + (10 * 60) + (5 * 3600)

$intervalString = $timer->asString(); // <string> -> 05:10:34
// or
$intervalString = (string)$timer; // <string> -> 05:10:34
```

## Testing

To run test cases you should execute the following command

```bash
./vendor/bin/phpunit tests --testdox
```
