<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 5:32 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/range.php';
include __DIR__.'/../src/intrange.php';
include __DIR__.'/../src/doublerange.php';

class TestRange extends PHPUnit_Framework_TestCase
{
    /**
     * Test is in range functionality
     */
    public function testIsInRange()
    {
        $range = new IntegerRange(2, 4);

        $this->assertTrue($range->isInRange(3));
        $this->assertFalse($range->isInRange(5));
        $this->assertTrue($range->isInRange(2));
        $this->assertTrue($range->isInRange(4));
        $this->assertFalse($range->isInRange(-1));


        $range = new DoubleRange(2.22, 4.9);

        $this->assertTrue($range->isInRange(3));
        $this->assertFalse($range->isInRange(5));
        $this->assertFalse($range->isInRange(2));
        $this->assertTrue($range->isInRange(4));
        $this->assertFalse($range->isInRange(-1));

    }

    /**
     * Test intersection functionality
     */
    public function testIntersection()
    {
        $range_first = new IntegerRange(0, 3);
        $range_second = new IntegerRange(2, 4);


        $range_intersection = $range_first->intersection($range_second);
        $this->assertTrue($range_intersection instanceof $range_first);

        $this->assertEquals(2, $range_intersection->getFrom());
        $this->assertEquals(3, $range_intersection->getTo());


        // Double Test
        $range_double = new DoubleRange(3.45, 6.78);
        $range_double_two = new DoubleRange(4.43, 10.78);

        $range_intersection = $range_double->intersection($range_double_two);
        $this->assertTrue($range_intersection instanceof $range_double);

        $this->assertEquals(4, $range_intersection->getFrom());
        $this->assertEquals(6, $range_intersection->getTo());


    }

    /**
     * Test empty range intersection
     */
    public function testEmptyRangeIntersection()
    {
        $range_three = new IntegerRange(4, 7);
        $range_four = new IntegerRange(8, 10);

        $this->assertFalse($range_three->intersection($range_four));

        $range_double = new DoubleRange(4.33, 7.43);
        $range_double_two = new DoubleRange(8.55, 13.4);

        $this->assertFalse($range_double->intersection($range_double_two));
    }


}