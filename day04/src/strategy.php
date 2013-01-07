<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/7/13
 * Time: 3:05 PM
 * To change this template use File | Settings | File Templates.
 */

class MontyStrategy
{
    /**
     * Run 1000 Monty Games
     * Pick strategy to change doors after host pick one,
     * or to stick with the first choice
     *
     * @param $changeDoor
     */
    public function runMontyGames($changeDoor)
    {
        $gameMemory = array(
            'Car' => 0,
            'Goat' => 0,
        );

        $montyGame = new Monty();
        for ($i=1; $i <=1000; $i++)
        {
            $montyGame->randomlyPickDoor();
            $montyGame->hostOpenDoorWithGoat();

            $result = $montyGame->openTheDoor($changeDoor);

            $gameMemory[$result] ++;
        }

        return $gameMemory;
    }
}