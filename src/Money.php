<?php // /src/Money.php

namespace App;

class Money
{
    protected ?float $amount = null;

    public function equals(Money $money): bool
    {
        return get_class($this) === get_class($money)
            && $this->amount === $money->amount;
    }
}
