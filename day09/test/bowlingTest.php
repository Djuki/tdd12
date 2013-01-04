<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 7:32 PM
 * To change this template use File | Settings | File Templates.
 */

include_once __DIR__.'/../src/bowling.php';

class BowlingTest extends PHPUnit_Framework_TestCase
{
    public function testScore()
    {
        $bowling = new Bowling();

        $this->assertEquals(300, $bowling->getScore('X|X|X|X|X|X|X|X|X|X||XX'));
        $this->assertEquals(90, $bowling->getScore('9-|9-|9-|9-|9-|9-|9-|9-|9-|9-||'));
        $this->assertEquals(150, $bowling->getScore('5/|5/|5/|5/|5/|5/|5/|5/|5/|5/||5'));
    }
}