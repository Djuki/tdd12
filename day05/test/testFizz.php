<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 5:51 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/fizz.php';

class FizzTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test for fizzalize method
     */
    public function testFizzalize()
    {
        $fizz = new Fizz();

        $this->assertEquals(1, $fizz->fizzalize(1));
        $this->assertEquals(2, $fizz->fizzalize(2));
        $this->assertEquals('Fizz', $fizz->fizzalize(3));
        $this->assertEquals(4, $fizz->fizzalize(4));
        $this->assertEquals('Buzz', $fizz->fizzalize(5));
        $this->assertEquals('Fizz', $fizz->fizzalize(6));
        $this->assertEquals(8, $fizz->fizzalize(8));
        $this->assertEquals('Fizz', $fizz->fizzalize(9));
        $this->assertEquals('Buzz', $fizz->fizzalize(10));
        $this->assertEquals(14, $fizz->fizzalize(14));
        $this->assertEquals('FizzBuzz', $fizz->fizzalize(15));
        $this->assertEquals(16, $fizz->fizzalize(16));
        $this->assertEquals('Buzz', $fizz->fizzalize(20));

        $this->assertEquals('FizzBuzz', $fizz->fizzalize(120));
        $this->assertEquals('121', $fizz->fizzalize(121));
    }
}