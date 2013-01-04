<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 6:44 PM
 * To change this template use File | Settings | File Templates.
 */


include_once __DIR__.'/../src/list.php';

class TestList extends PHPUnit_Framework_TestCase
{

    /**
     * Test is iterator empty at start
     */
    public function testIterator()
    {
        $list = new ReadList(5);

        $this->assertTrue($list->isEmpty());
    }

    /**
     * We test is ReadList act as LIFO list
     */
    public function testLifo()
    {
        $list = new ReadList(5);
        $this->assertTrue($list->isEmpty());

        $list->add('First');
        $list->add('Second');
        $list->add('Third');
        $this->assertFalse($list->isEmpty());

        $this->assertEquals('Third', $list->read());
        $this->assertEquals('Second', $list->read());
        $this->assertEquals('First', $list->read());

        $this->assertTrue($list->isEmpty());

    }

    /**
     * We test can we add empty item in Read list
     * @expectedException EmptyItemException
     */
    public function testEmtyItem()
    {
        $list = new ReadList(5);

        $list->add('');

        $list->add(null);

    }

    /**
     *  @expectedException DuplicateItemException
     */
    public function testDoubleItem()
    {
        $list = new ReadList(5);

        $list->add('one');

        // Double one expected Exception
        $list->add('one');
    }

    /**
     * We test getByIndex method
     */
    public function testGetByIndex()
    {
        $list = new ReadList(5);

        $this->assertFalse($list->getByIndex(1));

        $list->add('one');
        $list->add('two');
        $list->add('three');
        $list->add('4');

        $this->assertFalse($list->getByIndex(9));
        $this->assertEquals('two', $list->getByIndex(1));
        $this->assertEquals('4', $list->getByIndex(3));
        $this->assertEquals('one', $list->getByIndex(0));
        $this->assertEquals('three', $list->getByIndex(2));

        $this->assertTrue($list->isEmpty());

    }

}