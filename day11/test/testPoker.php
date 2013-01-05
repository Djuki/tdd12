<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 3:41 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/card.php';
include __DIR__.'/../src/poker.php';


class TestPoker extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException NotValidCard
     */
    public function testCardException()
    {
        $card = new Card(23, 'D');
    }
}