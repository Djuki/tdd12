<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/phoneRecord.php';
include __DIR__.'/../src/phonelist.php';


class TestPhoneList extends PHPUnit_Framework_TestCase
{
    /**
     * Test countable functionality
     */
    public function testCount()
    {
        $list = new PhoneList();

        $this->assertEquals(0, count($list));

        $list->add(new PhoneRecord('John', '334 445 566'));
        $list->add(new PhoneRecord('Eric', '94 025 536'));
        $list->add(new PhoneRecord('John Entario', '904 345 33'));

        $this->assertEquals(3, count($list));
    }


    /**
     * Test is list consistent or not
     */
    public function testConsistency()
    {
        $consistentList = new PhoneList();

        $consistentList->add(new PhoneRecord('Mike', '011 112 323'));
        $consistentList->add(new PhoneRecord('Luk', '023 234 67'));
        $consistentList->add(new PhoneRecord('Joe', '013 22 34 90'));

        $this->assertTrue($consistentList->isConsistent());

        // Not consistent list

        $notConsistentList = new PhoneList();

        $notConsistentList->add(new PhoneRecord('Bob', '91 12 54 26'));
        $notConsistentList->add(new PhoneRecord('Alice', '97 625 992'));
        $notConsistentList->add(new PhoneRecord('Emergency', '911'));

        $this->assertFalse($notConsistentList->isConsistent());
    }


    /**
     * Test phone start with numbers function
     */
    public function testPhoneStartWith()
    {
        $phone = new PhoneRecord('Mike', '91 12 54 26');

        $this->assertTrue($phone->isPhoneStartWith('911'));
        $this->assertTrue($phone->isPhoneStartWith('9'));
        $this->assertTrue($phone->isPhoneStartWith('91'));

        $this->assertFalse($phone->isPhoneStartWith('93'));
        $this->assertFalse($phone->isPhoneStartWith('456'));
    }
}