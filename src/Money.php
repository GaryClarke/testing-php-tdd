<?php // /src/Money.php

namespace App;

abstract class Money
{
    protected ?float $amount = null;
    protected string $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    abstract public function times(int $multiplier): Money;

    public function currency(): string
    {
        return $this->currency;
    }

    public function equals(Money $money): bool
    {
        return get_class($this) === get_class($money)
            && $this->amount === $money->amount;
    }

    public static function gbp(float $amount): Money
    {
        return new GBP($amount, 'GBP');
    }

    public static function usd(float $amount): Money
    {
        return new USD($amount, 'USD');
    }
}
