<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 3:46 PM
 * To change this template use File | Settings | File Templates.
 */

class NotValidCard extends Exception {}

class Card
{
    /**
     * Card numbers definition
     * @var array
     */
    static protected $numbers = array(
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 'T',
        12 => 'J',
        13 => 'Q',
        14 => 'K',
        15 => 'A'
    );

    /**
     * Card suits definition
     * @var array
     */
    static protected $suits = array(
        'C', // Clubs
        'D', // Diamonds
        'H', // Harts
        'S'  // Spades
    );


    /**
     * Card Number
     * @var
     */
    protected $cardNumber;

    /**
     * Card Suit
     * @var
     */
    protected $cardSuit;

    /**
     * Create card object
     * @param $number
     * @param $suit
     */
    public function __construct($number, $suit)
    {
        if ( ! in_array($number, self::$numbers) or ! in_array($suit, self::$suits))
        {
            throw new NotValidCard('Card is not valid');
        }

        $this->cardNumber = $number;

        $this->cardSuit = $suit;
    }

    /**
     * Get card number
     * @return mixed
     */
    public function getValue()
    {
        return $this->cardNumber;
    }

    /**
     * Get card suit
     * @return mixed
     */
    public function getSuit()
    {
        return $this->cardSuit;
    }

    /**
     * Get key index (value) by name
     * @param $name
     * @return mixed
     */
    static public function getValueByName($name)
    {
        return array_search($name, self::$numbers);
    }
}