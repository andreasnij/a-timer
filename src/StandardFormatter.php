<?php

namespace ATimer;

class StandardFormatter implements FormatterInterface
{
    public const SECONDS_IN_A_YEAR = 365 * self::SECONDS_IN_A_DAY; // Not accounting for leap years
    public const SECONDS_IN_A_DAY = 24 * self::SECONDS_IN_AN_HOUR;
    public const SECONDS_IN_AN_HOUR = 60 * self::SECONDS_IN_A_MINUTE;
    public const SECONDS_IN_A_MINUTE = 60;

    public function format(float $duration, bool $millisecondPrecision = true): string
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

    protected function getDurationParts(float $duration, bool $millisecondPrecision = true): array
    {
        $parts = [];

        $years = floor($duration / self::SECONDS_IN_A_YEAR);
        $parts['y'] = $years;

        $daySeconds = (int) $duration % self::SECONDS_IN_A_YEAR;
        $days = floor($daySeconds / self::SECONDS_IN_A_DAY);
        $parts['d'] = $days;

        $hourSeconds = (int) $duration % self::SECONDS_IN_A_DAY;
        $hours = floor($hourSeconds / self::SECONDS_IN_AN_HOUR);
        $parts['h'] = $hours;

        $minuteSeconds = (int) $duration % self::SECONDS_IN_AN_HOUR;
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
