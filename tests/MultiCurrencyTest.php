<?php // /tests/MultiCurrencyTest.php

use App\GBP;
use PHPUnit\Framework\TestCase;

class MultiCurrencyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = new GBP(5);
        $this->assertEquals(new GBP(10), $five->times(2));
        $this->assertEquals(new GBP(15), $five->times(3));
    }

    public function testEquality(): void
    {
        $this->assertTrue((new GBP(5))->equals(new GBP(5)));
        $this->assertFalse((new GBP(5))->equals(new GBP(6)));
    }
}
