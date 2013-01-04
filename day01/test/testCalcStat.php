<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/28/12
 * Time: 11:20 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/calcStat.php';


class RangeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test for min value
     */
    public function testMinValue()
    {
        $range = new CalcStat(array(33, -4, 66, 7, 90, 12));
        $this->assertEquals(-4, $range->minValue());
    }

    /**
     * Test for max value
     */
    public function testMaxValue()
    {
        $range = new CalcStat(array(9, 876, 54, 0, -22, 3, 1202));

        $this->assertEquals(1202, $range->maxValue());
    }

    /**
     * Test for count method
     */
    public function testCount()
    {
        $range = new CalcStat(array(9, 876, 54, 0, -22, 3, 46));

        $this->assertEquals(7, $range->count());
    }

    /**
     * Test for average method
     */
    public function testAverage()
    {
        $range = new CalcStat(array(5, 10, 11, 1, 3, 8));

        $this->assertEquals(6.33, $range->averageValue());
    }


}