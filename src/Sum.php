<?php // /src/Sum.php

namespace App;

class Sum implements Expression
{
    public function __construct(
        public Expression $augend,
        public Expression $addend
    )
    {
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function times(int $multiplier): Expression
    {
        return new Sum(
            $this->augend->times($multiplier),
            $this->addend->times($multiplier)
        );
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->reduce($bank, $to)->amount
            + $this->addend->reduce($bank, $to)->amount;

        return new Money($amount, $to);
    }
}
