<?php
/**
 * A Timer.
 *
 * @copyright Copyright (c) 2015 Andreas Nilsson
 * @license   MIT
 */

namespace ATimer;

/**
 * A simple timer.
 *
 * @author Andreas Nilsson <http://github.com/jandreasn>
 */
class Timer
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @var float
     */
    protected $startTime;

    /**
     * @var float
     */
    protected $duration;

    /**
     * Constructor.
     *
     * @param bool                   $start
     * @param FormatterInterface $formatter
     */
    public function __construct($start = false, FormatterInterface $formatter = null)
    {
        $this->formatter = $formatter ?: new StandardFormatter();

        if ($start) {
            $this->start();
        }
    }

    /**
     * @param float $startTime
     */
    public function start($startTime = null)
    {
        if ($this->startTime !== null) {
            throw new \LogicException("Timer already started");
        }

        $this->startTime = $startTime ?: microtime(true);
    }

    /**
     * @return float
     */
    public function stop()
    {
        if ($this->startTime === null) {
            throw new \LogicException("Timer has not started");
        }

        $this->duration = microtime(true) - $this->startTime;
        $this->startTime = null;

        return $this->duration;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        if ($this->duration === null) {
            $this->stop();
        }

        return $this->duration;
    }

    /**
     * @param bool $millisecondPrecision
     * @return string
     */
    public function getDurationFormatted($millisecondPrecision = true)
    {
        $duration = $this->getDuration();

        return $this->formatter->format($duration, $millisecondPrecision);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->getDurationFormatted();
        } catch (\LogicException $e) {
            return '';
        }
    }
}
