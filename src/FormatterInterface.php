<?php

namespace ATimer;

interface FormatterInterface
{
    public function format(float $duration, bool $millisecondPrecision = true): string;
}
