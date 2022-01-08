<?php

namespace ATimer;

use LogicException;

class Timer
{
    protected FormatterInterface $formatter;
    protected ?float $startTime = null;
    protected ?float $duration = null;

    public function __construct(bool $start = false, ?FormatterInterface $formatter = null)
    {
        $this->formatter = $formatter ?: new StandardFormatter();

        if ($start) {
            $this->start();
        }
    }

    public function start(?float $startTime = null): void
    {
        if ($this->startTime !== null) {
            throw new LogicException('Timer already started');
        }

        $this->startTime = $startTime ?: microtime(true);
    }

    public function stop(): float
    {
        if ($this->startTime === null) {
            throw new LogicException('Timer has not started');
        }

        $this->duration = microtime(true) - $this->startTime;
        $this->startTime = null;

        return $this->duration;
    }

    public function getDuration(): float
    {
        if ($this->duration === null) {
            $this->stop();
        }

        return $this->duration;
    }

    public function getDurationFormatted(bool $millisecondPrecision = true): string
    {
        $duration = $this->getDuration();

        return $this->formatter->format($duration, $millisecondPrecision);
    }

    public function __toString(): string
    {
        try {
            return $this->getDurationFormatted();
        } catch (LogicException $e) {
            return '';
        }
    }
}
