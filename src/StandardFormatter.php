<?php
/**
 * A Timer.
 *
 * @copyright Copyright (c) 2015 Andreas Nilsson
 * @license   MIT
 */

namespace ATimer;

/**
 * Standard time formatter.
 *
 * @author Andreas Nilsson <http://github.com/jandreasn>
 */
class StandardFormatter implements FormatterInterface
{
    /**
     * @const int
     */
    const SECONDS_IN_A_YEAR = 365 * self::SECONDS_IN_A_DAY; // Not accounting for leap years

    /**
     * @const int
     */
    const SECONDS_IN_A_DAY = 24 * self::SECONDS_IN_AN_HOUR;

    /**
     * @const int
     */
    const SECONDS_IN_AN_HOUR = 60 * self::SECONDS_IN_A_MINUTE;

    /**
     * @const int
     */
    const SECONDS_IN_A_MINUTE = 60;

    /**
     * @param float $duration
     * @param bool  $millisecondPrecision
     * @return string
     */
    public function format($duration, $millisecondPrecision = true)
    {
        $durationParts = $this->getDurationParts($duration, $millisecondPrecision);

        $formattedTime = '';
        foreach ($durationParts as $unit => $value) {
            if ($value || $formattedTime || $unit === 's') {
                $formattedTime .= sprintf('%g%s ', $value, $unit);
            }
        }

        return trim($formattedTime);
    }

    /**
     * @param float $duration
     * @param bool  $millisecondPrecision
     * @return array
     */
    protected function getDurationParts($duration, $millisecondPrecision = true)
    {
        $parts = [];

        $years = floor($duration / self::SECONDS_IN_A_YEAR);
        $parts['y'] = $years;

        $daySeconds = $duration % self::SECONDS_IN_A_YEAR;
        $days = floor($daySeconds / self::SECONDS_IN_A_DAY);
        $parts['d'] = $days;

        $hourSeconds = $duration % self::SECONDS_IN_A_DAY;
        $hours = floor($hourSeconds / self::SECONDS_IN_AN_HOUR);
        $parts['h'] = $hours;

        $minuteSeconds = $duration % self::SECONDS_IN_AN_HOUR;
        $minutes = floor($minuteSeconds / self::SECONDS_IN_A_MINUTE);
        $parts['m'] = $minutes;

        $remainingSeconds = $minuteSeconds % self::SECONDS_IN_A_MINUTE;
        $seconds = floor($remainingSeconds);
        if ($millisecondPrecision) {
            $milliseconds = round($duration - floor($duration), 3);
            $seconds += $milliseconds;
        }
        $parts['s'] = $seconds;

        return $parts;
    }
}
