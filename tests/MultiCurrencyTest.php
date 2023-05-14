<?php // /tests/MultiCurrencyTest.php

use App\Bank;
use App\Money;
use App\Sum;
use PHPUnit\Framework\TestCase;

class MultiCurrencyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = Money::gbp(5);
        $this->assertEquals(Money::gbp(10), $five->times(2));
        $this->assertEquals(Money::gbp(15), $five->times(3));
    }

    public function testEquality(): void
    {
        $this->assertTrue((Money::gbp(5))->equals(Money::gbp(5)));
        $this->assertFalse((Money::gbp(5))->equals(Money::gbp(6)));
        $this->assertFalse((Money::usd(5))->equals(Money::gbp(5)));
    }

    public function testCurrency(): void
    {
        $this->assertEquals('GBP', Money::gbp(1)->currency());
        $this->assertEquals('USD', Money::usd(1)->currency());
    }

    public function testSimpleAddition(): void
    {
        $five = new Money(5, 'GBP');
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, 'GBP');
        $this->assertEquals(Money::gbp(10), $reduced);
    }

    public function testPlusReturnsSum(): void
    {
        $five = Money::gbp(5);
        $sum = $five->plus($five);
        $this->assertInstanceOf(Sum::class, $sum);
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }

    public function testReduceSum(): void
    {
        $sum = new Sum(Money::gbp(3), Money::gbp(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, 'GBP');
        $this->assertEquals(Money::gbp(7), $result);
    }

    public function testReduceMoney(): void
    {
        $bank = new Bank();
        $bank->addRate('GBP', 'GBP', 999);
        $result = $bank->reduce(Money::gbp(1), 'GBP');
        $this->assertEquals(Money::gbp(1), $result);
    }

    public function testReduceMoneyUsingDifferentCurrency(): void
    {
        $bank = new Bank();
        $bank->addRate('USD', 'GBP', 1);
        $bank->addRate('USD', 'GBP', 2);
        $result = $bank->reduce(Money::usd(2), 'GBP');
        $this->assertEquals(Money::gbp(1), $result);
    }

    public function testMixedAddition(): void
    {
        $fiveGbp = Money::gbp(5);
        $tenUsd = Money::usd(10);
        $bank = new Bank();
        $bank->addRate('USD', 'GBP', 2);
        $result = $bank->reduce($fiveGbp->plus($tenUsd), 'GBP');
        $this->assertEquals(Money::gbp(10), $result);
    }

    public function testSumPlusMoney(): void
    {
        $fiveGbp = Money::gbp(5);
        $tenUsd = Money::usd(10);
        $bank = new Bank();
        $bank->addRate('USD', 'GBP', 2);
        $sum = (new Sum($fiveGbp, $tenUsd))->plus($fiveGbp);
        $result = $bank->reduce($sum, 'GBP');
        $this->assertEquals(Money::gbp(15), $result);
    }

    public function testSumTimes(): void
    {
        $fiveGbp = Money::gbp(5);
        $tenUsd = Money::usd(10);
        $bank = new Bank();
        $bank->addRate('USD', 'GBP', 2);
        $sum = (new Sum($fiveGbp, $tenUsd))->times(2);
        $result = $bank->reduce($sum, 'GBP');
        $this->assertEquals(Money::gbp(20), $result);
    }

    public function testLetsGoCrazy(): void
    {
        $fiveGbp = Money::gbp(5);
        $tenUsd = Money::usd(10);
        $bank = new Bank();
        $bank->addRate('USD', 'GBP', 2);
        $sum1 = (new Sum($fiveGbp, $tenUsd))->times(2)
            ->plus(new Sum($fiveGbp, $tenUsd)); // 30
        $sum2 = (new Sum($fiveGbp, $tenUsd))
            ->plus(new Sum($fiveGbp, $tenUsd))->times(4); // 80
        $result1 = $bank->reduce($sum1, 'GBP');
        $result2 = $bank->reduce($sum2, 'GBP');
        $this->assertEquals(Money::gbp(30), $result1);
        $this->assertEquals(Money::gbp(80), $result2);
    }
}
