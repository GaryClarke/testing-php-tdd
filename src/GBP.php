<?php // /src/GBP.php

namespace App;

class GBP
{
    public ?float $amount = null;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): GBP
    {
        return new GBP($this->amount * $multiplier);
    }
}
