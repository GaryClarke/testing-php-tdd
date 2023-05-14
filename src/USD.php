<?php // /src/USD.php

namespace App;

class USD extends Money
{
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): USD
    {
        return new USD($this->amount * $multiplier);
    }
}
