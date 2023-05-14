<?php // /src/Bank.php

namespace App;

class Bank
{
    public function reduce(Expression $source, string $targetCurrency): Money
    {
        return $source->reduce($targetCurrency);
    }
}
