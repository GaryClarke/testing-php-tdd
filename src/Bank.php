<?php // /src/Bank.php

namespace App;

class Bank
{
    private array $rates = [];

    public function reduce(Expression $source, string $targetCurrency): Money
    {
        return $source->reduce($this, $targetCurrency);
    }

    public function addRate(string $from, string $to, float $rate): void
    {
        $this->rates = array_replace($this->rates, [$from . $to => $rate]);
    }

    public function rate(string $from, string $to): float
    {
        if ($from === $to) {

            return 1;
        }

        $rate = $this->rates[$from . $to];

        return $rate;
    }
}
