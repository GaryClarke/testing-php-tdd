<?php // /tests/MultiCurrencyTest.php

use App\GBP;
use PHPUnit\Framework\TestCase;

class MultiCurrencyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = new GBP(5);
        $five->times(2);
        $this->assertEquals(10, $five->amount);
    }
}