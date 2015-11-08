<?php
/**
 * A Timer.
 *
 * @copyright Copyright (c) 2015 Andreas Nilsson
 * @license   MIT
 */

namespace ATimer;

/**
 * Interface for time formatters.
 *
 * @author Andreas Nilsson <http://github.com/jandreasn>
 */
interface FormatterInterface
{
    /**
     * @param float $duration
     * @param bool  $millisecondPrecision
     * @return string
     */
    public function format($duration, $millisecondPrecision = true);
}
