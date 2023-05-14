<?php // /src/GBP.php

namespace App;

class GBP extends Money
{
    public function times(int $multiplier): Money
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }
}
