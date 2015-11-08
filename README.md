# A Timer
A simple timer to time/benchmark operations with a nice human readable result.

## Installation
Add the package as a requirement to your `composer.json`:
```bash
$ composer require jandreasn/a-timer
```

##Usage
```php
<?php

use ATimer\Timer;

$timer = new Timer(true);
// Some operations that takes time
echo $timer->getDurationFormatted();



##Requirements
- PHP 5.6 or above.

##Author
Andreas Nilsson <http://github.com/jandreasn>

##License
Licensed under the MIT License - see the `LICENSE` file for details.
