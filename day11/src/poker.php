<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 3:40 PM
 * To change this template use File | Settings | File Templates.
 */

class Poker
{

    /**
     * Definition of poker hands
     * @var array
     */
    static protected $pokerHands = array (
        1 => 'High',
        2 => 'Pair',
        3 => 'TwoPairs',
        4 => 'ThreeOfaKind',
        5 => 'Straight',
        6 => 'Flush',
        7 => 'FullHouse',
        8 => 'FourOfaKind',
        7 => 'StraightFlush',
    );

    /**
     * Player one cards
     * @var array
     */
    protected $playerWhite = array();

    /**
     * Player Two cards
     * @var array
     */
    protected $playerBlack = array();


    public function playRound($whiteCards, $blackCards)
    {
        $this->playerWhite = $this->readCards($whiteCards);
        $this->playerBlack = $this->readCards($blackCards);
    }


    /**
     * Read car input and turd it into Card array
     * @param $cards
     * @return array
     */
    private function readCards($cards)
    {
        $cards = explode(' ', $cards);

        $cardsArray = array();

        foreach ($cards as $card)
        {
            list($number, $suit) = str_split($card);

            $cardsArray[] = new Card($number, $suit);
        }

        return  $cardsArray;
    }


}