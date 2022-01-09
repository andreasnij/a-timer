# A Timer

[![Latest Stable Version](https://poser.pugx.org/jandreasn/a-timer/v/stable)](https://packagist.org/packages/jandreasn/a-timer)
[![License](https://poser.pugx.org/jandreasn/a-timer/license)](https://packagist.org/packages/jandreasn/a-timer)

A simple timer to time/benchmark operations with a nice human readable result.

## Installation
Add the package as a requirement to your `composer.json`:
```bash
$ composer require jandreasn/a-timer
```

## Usage
```php
use ATimer\Timer;

$timer = new Timer();

// Some operations that take time
echo $timer->getDurationFormatted();

// Example output: 1.237 s
```


## Requirements
- PHP 7.4 or above.

## Author
Andreas Nilsson (<https://github.com/andreasnij>)

## License
Licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details.
