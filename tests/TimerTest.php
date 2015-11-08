<?php

use ATimer\Timer;
use ATimer\StandardFormatter;

class AuthenticatorTest extends PHPUnit_Framework_TestCase
{
     /**
     * @covers ATimer\Timer::__construct
     * @covers ATimer\Timer::start
     * @covers ATimer\Timer::stop
     */
    public function testConstructorStart()
    {
        $timer = new Timer(true);

        $this->assertNotNull($timer->getDuration());
    }

    /**
     * @covers ATimer\Timer::__construct
     * @covers ATimer\Timer::start
     * @covers ATimer\Timer::stop
     */
    public function testConstructorWithoutStarting()
    {
        $timer = new Timer();

        $this->setExpectedException('\LogicException');
        $timer->stop();
    }

    /**
     * @covers ATimer\Timer::start
     */
    public function testDoubleStart()
    {
        $timer = new Timer(true);

        $this->setExpectedException('\LogicException');
        $timer->start();
    }

    /**
     * @covers ATimer\Timer::getDuration
     * @covers ATimer\Timer::getDurationFormatted
     * @covers ATimer\StandardFormatter::format
     * @covers ATimer\StandardFormatter::getDurationParts
     */
    public function testDurationFormatted()
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 215 * StandardFormatter::SECONDS_IN_A_DAY
            + 14 * StandardFormatter::SECONDS_IN_AN_HOUR + 45 * StandardFormatter::SECONDS_IN_A_MINUTE + 27;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('2y 215d 14h 45m 27s', $timer->getDurationFormatted(false));
    }

    /**
     */
    public function testMoreComplexDurationFormatted()
    {
        $duration = 2 * StandardFormatter::SECONDS_IN_A_YEAR + 366 * StandardFormatter::SECONDS_IN_A_DAY
            + 25 * StandardFormatter::SECONDS_IN_AN_HOUR + 61 * StandardFormatter::SECONDS_IN_A_MINUTE + 61;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertEquals('3y 2d 2h 2m 1s', $timer->getDurationFormatted(false));
    }

    /**
     * @covers ATimer\StandardFormatter::getDurationParts
     */
    public function testDurationFormattedWithMillisecondPrecision()
    {
        $duration = 0.5;

        $timer = new Timer();
        $timer->start(microtime(true) - $duration);

        $this->assertContains('.', $timer->getDurationFormatted(true));
    }

    /**
     * @covers ATimer\Timer::__toString
     */
    public function testToString()
    {
        $timer = new Timer();
        $timer->start();

        $this->assertContains('s', (string) $timer);
    }

    /**
     * @covers ATimer\Timer::__toString
     */
    public function testToStringWithoutStarting()
    {
        $timer = new Timer();

        $this->assertEquals('', (string) $timer);
    }
}
