# A Timer

[![Latest Stable Version](https://poser.pugx.org/andreasnij/a-timer/v/stable)](https://packagist.org/packages/andreasnij/a-timer)

A simple timer to time/benchmark operations with a short human-readable result.

## Installation
Add the package as a requirement to your `composer.json`:
```bash
$ composer require andreasnij/a-timer
```

## Usage
```php
use ATimer\Timer;

$timer = new Timer();

// Some operations that take time
echo $timer->getDurationFormatted();

// Example output: 1.237s
```

## Author
Andreas Nilsson (<https://github.com/andreasnij>)

## License
Licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details.
