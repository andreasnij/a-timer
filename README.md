# A Timer

[![Latest Stable Version](https://poser.pugx.org/jandreasn/a-timer/v/stable)](https://packagist.org/packages/jandreasn/a-timer)
[![Build Status](https://travis-ci.org/jandreasn/a-timer.svg?branch=master)](https://travis-ci.org/jandreasn/a-timer)
[![License](https://poser.pugx.org/jandreasn/a-timer/license)](https://packagist.org/packages/jandreasn/a-timer)

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
```


##Requirements
- PHP 5.6 or above.

##Author
Andreas Nilsson <http://github.com/jandreasn>

##License
Licensed under the MIT License - see the `LICENSE` file for details.
