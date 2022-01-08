<?php

namespace ATimer\Tests;

use ATimer\Timer;
use ATimer\StandardFormatter;
use PHPUnit\Framework\TestCase;

class TimerTest extends TestCase
{
    public function testConstructorStart(): void
    {
        $timer = new Timer(true);

        $this->assertNotNull($timer->getDuration());
    }

    public function testConstructorWithoutStarting(): void
    {
        $timer = new Timer();

        $this->expectException(\LogicException::class);
        $timer->stop();
    }

    public function testDoubleStart(): void
    {
        $timer = new Timer(true);

        $this->expectException(\LogicException::class);
        $timer->start();
    }

    public function testDurationFormatted(): void
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 215 * StandardFormatter::SECONDS_IN_A_DAY
            + 14 * StandardFormatter::SECONDS_IN_AN_HOUR + 45 * StandardFormatter::SECONDS_IN_A_MINUTE + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('2y 215d 14h 45m 27s', $timer->getDurationFormatted(false));
    }

    public function testMoreComplexDurationFormatted(): void
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 366 * StandardFormatter::SECONDS_IN_A_DAY
            + 25 * StandardFormatter::SECONDS_IN_AN_HOUR + 61 * StandardFormatter::SECONDS_IN_A_MINUTE + 61;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('3y 2d 2h 2m 1s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedWithMillisecondPrecision(): void
    {
        $duration = 0.5;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertStringContainsString('.', $timer->getDurationFormatted(true));
    }

    public function testDurationFormattedZeroYears(): void
    {
        $duration =  215 * StandardFormatter::SECONDS_IN_A_DAY + 45 * StandardFormatter::SECONDS_IN_A_MINUTE;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('215d 0h 45m 0s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroDays(): void
    {
        $duration = 14 * StandardFormatter::SECONDS_IN_AN_HOUR + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('14h 0m 27s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroHours(): void
    {
        $duration = 45 * StandardFormatter::SECONDS_IN_A_MINUTE + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('45m 27s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroMinutes(): void
    {
        $duration = 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('27s', $timer->getDurationFormatted(false));
    }

    public function testToString(): void
    {
        $timer = new Timer();
        $timer->start();

        $this->assertStringContainsString('s', (string) $timer);
    }

    public function testToStringWithoutStarting(): void
    {
        $timer = new Timer();

        $this->assertEquals('', (string) $timer);
    }
}
