<?php // /src/Sum.php

namespace App;

class Sum implements Expression
{
    public function __construct(
        public Money $augend,
        public Money $addend
    )
    {
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->amount + $this->addend->amount;

        return new Money($amount, $to);
    }
}
