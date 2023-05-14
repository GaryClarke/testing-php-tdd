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
}
