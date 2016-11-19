<?php

namespace ATimer\Tests;

use ATimer\Timer;
use ATimer\StandardFormatter;

class TimerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorStart()
    {
        $timer = new Timer(true);

        $this->assertNotNull($timer->getDuration());
    }

    public function testConstructorWithoutStarting()
    {
        $timer = new Timer();

        $this->expectException(\LogicException::class);
        $timer->stop();
    }

    public function testDoubleStart()
    {
        $timer = new Timer(true);

        $this->expectException(\LogicException::class);
        $timer->start();
    }

    public function testDurationFormatted()
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 215 * StandardFormatter::SECONDS_IN_A_DAY
            + 14 * StandardFormatter::SECONDS_IN_AN_HOUR + 45 * StandardFormatter::SECONDS_IN_A_MINUTE + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('2y 215d 14h 45m 27s', $timer->getDurationFormatted(false));
    }

    public function testMoreComplexDurationFormatted()
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 366 * StandardFormatter::SECONDS_IN_A_DAY
            + 25 * StandardFormatter::SECONDS_IN_AN_HOUR + 61 * StandardFormatter::SECONDS_IN_A_MINUTE + 61;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('3y 2d 2h 2m 1s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedWithMillisecondPrecision()
    {
        $duration = 0.5;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertContains('.', $timer->getDurationFormatted(true));
    }

    public function testDurationFormattedZeroYears()
    {
        $duration =  215 * StandardFormatter::SECONDS_IN_A_DAY + 45 * StandardFormatter::SECONDS_IN_A_MINUTE;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('215d 0h 45m 0s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroDays()
    {
        $duration = 14 * StandardFormatter::SECONDS_IN_AN_HOUR + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('14h 0m 27s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroHours()
    {
        $duration = 45 * StandardFormatter::SECONDS_IN_A_MINUTE + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('45m 27s', $timer->getDurationFormatted(false));
    }

    public function testDurationFormattedZeroMinutes()
    {
        $duration = 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('27s', $timer->getDurationFormatted(false));
    }

    public function testToString()
    {
        $timer = new Timer();
        $timer->start();

        $this->assertContains('s', (string) $timer);
    }

    public function testToStringWithoutStarting()
    {
        $timer = new Timer();

        $this->assertEquals('', (string) $timer);
    }
}
