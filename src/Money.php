<?php // /src/Money.php

namespace App;

abstract class Money
{
    protected ?float $amount = null;

    abstract public function times(int $multiplier): Money;

    public function equals(Money $money): bool
    {
        return get_class($this) === get_class($money)
            && $this->amount === $money->amount;
    }

    public static function gbp(float $amount): Money
    {
        return new GBP($amount);
    }

    public static function usd(float $amount): Money
    {
        return new USD($amount);
    }
}
