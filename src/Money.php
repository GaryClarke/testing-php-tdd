<?php // /src/Money.php

namespace App;

class Money
{
    protected ?float $amount = null;
    protected string $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function times(int $multiplier): Money
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function equals(Money $money): bool
    {
        return $this->currency === $money->currency
            && $this->amount === $money->amount;
    }

    public static function gbp(float $amount): Money
    {
        return new Money($amount, 'GBP');
    }

    public static function usd(float $amount): Money
    {
        return new Money($amount, 'USD');
    }
}
