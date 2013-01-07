<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/7/13
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/monty.php';
include __DIR__.'/../src/strategy.php';

class TestMonty extends PHPUnit_Framework_TestCase
{
    /**
     * Test that player must pick the door first
     * @expectedException PlayerMustPickFirstException
     */
    public function testPlayerMustPlayFirst()
    {
        $montyGame = new Monty();
        $montyGame->hostOpenDoorWithGoat();
    }

    /**
     * Test what is behind door which host opened
     */
    public function testHostOpenDoorWithGoat()
    {
        $montyGame = new Monty();
        $montyGame->randomlyPickDoor();
        $doorId = $montyGame->hostOpenDoorWithGoat();

        $this->assertTrue(is_integer($doorId));
        $this->assertEquals('Goat', $montyGame->getWhatIsBehindDoor($doorId));

        $montyGame->restartGame();
        $montyGame->randomlyPickDoor();
        $doorId = $montyGame->hostOpenDoorWithGoat();

        $this->assertTrue(is_integer($doorId));
        $this->assertEquals('Goat', $montyGame->getWhatIsBehindDoor($doorId));

    }

    /**
     * Test strategy results
     * If we change door after host open one We have more chances to win the Car
     */
    public function testStrategy()
    {
        $strategy = new MontyStrategy();
        $strategyChange = $strategy->runMontyGames(true);
        $strategyStick = $strategy->runMontyGames(false);

        $this->assertArrayHasKey('Car', $strategyChange);
        $this->assertArrayHasKey('Goat', $strategyChange);
        $this->assertArrayHasKey('Car', $strategyStick);
        $this->assertArrayHasKey('Goat', $strategyStick);

        $this->assertGreaterThan($strategyStick['Car'], $strategyChange['Car']);
    }
}