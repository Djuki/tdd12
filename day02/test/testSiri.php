<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/29/12
 * Time: 11:29 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/siri.php';

class SiriTest extends PHPUnit_Framework_TestCase
{
    /**
     * Siri object
     * @var
     */
    protected $siri;


    /**
     * Set up testing
     */
    public function setUp()
    {
        $this->siri = new Siri();
    }

    /**
     * Test for one digit numbers
     */
    public function testOneDigit()
    {
        $this->assertEquals('nine', $this->siri->say(9));
        $this->assertEquals('two', $this->siri->say(2));
        $this->assertEquals('three', $this->siri->say(3));
        $this->assertEquals('seven', $this->siri->say(7));
        $this->assertEquals('eight', $this->siri->say('08'));
        $this->assertEquals('', $this->siri->say(0));
    }


    /**
     * Test for small numbers
     */
    public function testDecimals()
    {
        $this->assertEquals('ninety nine', $this->siri->say(99));
        $this->assertEquals('twelve', $this->siri->say(12));
        $this->assertEquals('thirty four', $this->siri->say(34));
        $this->assertEquals('seventy seven', $this->siri->say(77));
        $this->assertEquals('twenty five', $this->siri->say(25));
        $this->assertEquals('eighty three', $this->siri->say(83));

    }


    /**
     * Test for big numbers
     */
    public function testBigNumbers()
    {
        $this->assertEquals('three hundred', $this->siri->say(300));
        $this->assertEquals('three hundred and ten', $this->siri->say(310));
        $this->assertEquals('one thousand, five hundred and one', $this->siri->say(1501));
        $this->assertEquals('twelve thousand, six hundred and nine', $this->siri->say(12609));
        $this->assertEquals('five hundred and twelve thousand, six hundred and seven', $this->siri->say(512607));
        $this->assertEquals('forty three million, one hundred and twelve thousand, six hundred and three', $this->siri->say(43112603));
    }
}