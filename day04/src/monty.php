<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/7/13
 * Time: 2:13 PM
 * To change this template use File | Settings | File Templates.
 */

class PlayerMustPickFirstException extends Exception {}

class Monty
{
    /**
     * Closed doors
     * @var array
     */
    protected $doors = array();


    /**
     * Door number player picked (1 - 3)
     * @var int
     */
    protected $playerPicked = null;

    /**
     * Door number host opened. Behind door is goat
     * @var int
     */
    protected $hostOpened = null;

    /**
     * Init game
     * Place car and goats behind the  doors
     */
    public function __construct()
    {
        $this->randomHideCar();
    }


    /**
     * Restart game
     */
    public function restartGame()
    {
        $this->playerPicked = null;
        $this->hostOpened = null;
        $this->doors = array();

        $this->randomHideCar();
    }

    /**
     * Return what is behind door
     * @param int $doorId
     */
    public function getWhatIsBehindDoor($doorId)
    {
        return $this->doors[$doorId];
    }


    /**
     * Hide car and goats randomly
     */
    private function randomHideCar()
    {
        $carPlace = rand(1, 3);
        $this->doors[$carPlace] = 'Car';

        for ($i=1; $i<4; $i++)
        {
            ($i != $carPlace) and $this->doors[$i] = 'Goat';
        }
    }

    /**
     * Pick door randomly (1 - 3)
     *
     * @return int
     */
    public function randomlyPickDoor()
    {
        $pickDoor = rand(1, 3);

        $this->playerPicked = $pickDoor;

        return $pickDoor;
    }

    /**
     * Host open door with goat
     * @throws PlayerMustPickFirstException
     *
     * @return int
     */
    public function hostOpenDoorWithGoat()
    {
        if (is_null($this->playerPicked))
        {
            throw new PlayerMustPickFirstException('Player must puck door before host open one.');
        }

        do
        {
            $openDoor = rand(1, 3);
        } while ( $openDoor == $this->playerPicked or $this->doors[$openDoor] != 'Goat');

        $this->hostOpened = $openDoor;

        return $openDoor;
    }

    /**
     * @param bool $changeDoor
     */
    public function openTheDoor($changeDoor)
    {
        if ( ! $changeDoor)
        {
            return $this->doors[$this->playerPicked];
        }

        for ($i=1; $i<4; $i++)
        {
            if ($i != $this->playerPicked and $i != $this->hostOpened)
            {
                return $this->doors[$i];
            }
        }
    }


}