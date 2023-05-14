<?php // /src/GBP.php

namespace App;

class GBP extends Money
{
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): Money
    {
        return new GBP($this->amount * $multiplier);
    }
}
