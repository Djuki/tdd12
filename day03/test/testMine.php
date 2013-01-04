<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/2/13
 * Time: 11:28 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/mine.php';

class MineTest extends PHPUnit_Framework_TestCase
{
    protected $mineGame;

    public function setUp()
    {
        $minefield = array(
            0 => array ('*', '.', '.', '.'),
            1 => array ('.', '.', '*', '.'),
            2 => array ('.', '.', '.', '.'),
        );

        $this->mineGame = new Mine($minefield);
    }
    public function testMineField()
    {
        $minefield = $this->mineGame->getMineField();

        $this->assertTrue(is_array($minefield));

        $this->assertTrue(is_array($minefield[0]));
        $this->assertTrue(is_array($minefield[1]));
        $this->assertTrue(is_array($minefield[2]));

        $this->assertCount(4, $minefield[0]);
        $this->assertCount(4, $minefield[1]);
        $this->assertCount(4, $minefield[2]);
    }

    public function testIsMine()
    {
        $this->isTrue($this->mineGame->isMine(0, 0));
        $this->assertEquals(false, $this->mineGame->isMine(0, 1));
        $this->assertEquals(false, $this->mineGame->isMine(0, 2));
        $this->assertEquals(false, $this->mineGame->isMine(0, 3));

        $this->assertEquals(false, $this->mineGame->isMine(1, 0));
        $this->assertEquals(false, $this->mineGame->isMine(1, 1));
        $this->isTrue($this->mineGame->isMine(1, 2));
        $this->assertEquals(false, $this->mineGame->isMine(1, 3));

        $this->assertEquals(false, $this->mineGame->isMine(2, 0));
        $this->assertEquals(false, $this->mineGame->isMine(2, 1));
        $this->assertEquals(false, $this->mineGame->isMine(2, 2));
        $this->assertEquals(false, $this->mineGame->isMine(2, 3));

    }

    public function testMinesAround()
    {
        $this->assertEquals(2, $this->mineGame->getMinesAround(0, 1));
        $this->assertEquals(1, $this->mineGame->getMinesAround(0, 2));
        $this->assertEquals(1, $this->mineGame->getMinesAround(0, 3));

        $this->assertEquals(1, $this->mineGame->getMinesAround(1, 0));
        $this->assertEquals(2, $this->mineGame->getMinesAround(1, 1));
        $this->assertEquals(1, $this->mineGame->getMinesAround(1, 3));

        $this->assertEquals(0, $this->mineGame->getMinesAround(2, 0));
        $this->assertEquals(1, $this->mineGame->getMinesAround(2, 1));
        $this->assertEquals(1, $this->mineGame->getMinesAround(2, 2));
        $this->assertEquals(1, $this->mineGame->getMinesAround(2, 3));


    }
}