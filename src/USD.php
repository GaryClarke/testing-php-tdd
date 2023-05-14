<?php // /src/USD.php

namespace App;

class USD
{
    private ?float $amount = null;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): USD
    {
        return new USD($this->amount * $multiplier);
    }

    public function equals(USD $usd): bool
    {
        return $this->amount === $usd->amount;
    }
}