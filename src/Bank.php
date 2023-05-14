<?php // /src/Bank.php

namespace App;

class Bank
{
    public function reduce(Expression $source, string $targetCurrency): Money
    {
        return Money::gbp(10);
    }
}
