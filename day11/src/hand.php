<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/6/13
 * Time: 3:24 PM
 * To change this template use File | Settings | File Templates.
 */

class Hand implements Iterator
{
    /**
     * Card position for iterator
     * @var int
     */
    protected $position = 0;

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
        9 => 'StraightFlush',
    );


    /**
     * Level of poker hand
     * @var
     */
    protected $pokerLevelScore = 1;

    protected $_is_High = false;
    protected $_is_Pair = false;
    protected $_is_TwoPairs = false;
    protected $_is_ThreeOfaKind = false;
    protected $_is_Straight = false;
    protected $_is_Flush = false;
    protected $_is_FullHouse = false;
    protected $_is_FourOfaKind = false;
    protected $_is_StraightFlush = false;


    /**
     * Cards in players hand
     * @var array
     */
    protected $handCards = array();


    /**
     * Sorted cards in hand
     * @var array
     */
    protected $handCardsSorted = array();

    /**
     * Number of different cards in hand
     * @var int
     */
    protected $differentCards;

    /**
     * Score for hand poker
     * @var int
     */
    protected $scoreHands = 0;


    /**
     * Score for other card
     * Count if players have the same card score
     * @var int
     */
    protected $scoreForOtherCards = 0;


    public function __construct($handCardsAsString)
    {
        $this->handCards = $this->readCards($handCardsAsString);
        $this->handCardsSorted = $this->getSortedByValue($this->handCards);

        $this->differentCards = count($this->handCardsSorted);

        $this->calculatePokerLevel();
        $this->countScore();

    }

    /**
     * Calculate poker level and remember poker hand, so we don't need to call same functions twice
     */
    public function calculatePokerLevel()
    {
        for ($i=9; $i>1; $i--)
        //foreach (self::$pokerHands as $level => $handName)
        {
            $level = $i;
            $handName = self::$pokerHands[$i];

            $methodName = 'is'.$handName;
            if ($this->{$methodName}())
            {
                $remember_variable = '_is_'.$handName;
                $this->{$remember_variable} = true;

                $this->pokerLevelScore = $level;

                break;
            }
        }
    }

    /**
     * Get poker level score
     * Represents hand strength
     * @return mixed
     */
    public function getPokerLevelScore()
    {
        return $this->pokerLevelScore;
    }

    /**
     * Poker hand name
     * @return mixed
     */
    public function getPokerLevelName()
    {
        return self::$pokerHands[$this->pokerLevelScore];
    }

    /**
     * Get score in hands
     * @return int
     */
    public function getScoreInHands()
    {
        return $this->scoreHands;
    }

    /**
     * Get score for other cards
     * Count if players have same score
     * @return int
     */
    public function getScoreForOtherCards()
    {
        return $this->scoreForOtherCards;
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

    /**
     * Sorted cards in hand by value
     * We don't have suits value in this array
     * @param $cardsArray
     * @return bool
     */
    public function getSortedByValue($cardsArray)
    {
        $sorted = array();
        foreach($cardsArray as $card)
        {
            if ( ! isset($sorted[$card->getValue()]))
            {
                $sorted[$card->getValue()] = 0;
            }
            $sorted[$card->getValue()]++;
        }
        ksort($sorted);
        return $sorted;
    }

    /**
     * Count score in hands
     */
    public function countScore()
    {
        $this->scoreHands = 0;
        $this->scoreForOtherCards = 0;

        if ($this->_is_Pair or $this->_is_TwoPairs)
        {
            $this->countScoreInScope(2, 2);
        }
        else if ($this->_is_FullHouse)
        {
            $this->countScoreInScope(2, 3);
        }
        else if ($this->_is_FourOfaKind)
        {
            $this->countScoreInScope(4, 4);
        }
        else if ($this->_is_Flush or $this->_is_High or $this->_is_Straight
            or $this->_is_StraightFlush)
        {
            foreach ($this->handCardsSorted as $cardValue => $sameCards)
            {
                $this->scoreHands += $cardValue;
            }
        }
    }

    /**
     * Help function to count score in score
     * Use full for pairs, three or four same cards in hand
     * @param $from
     * @param $to
     */
    private function countScoreInScope($from, $to)
    {
        foreach ($this->handCardsSorted as $cardIndex => $sameCards)
        {
            $cardValue = Card::getValueByName($cardIndex);

            if (($sameCards >= $from and $sameCards <= $to) or ($from == $sameCards))
            {
                $this->scoreHands += $cardValue * $sameCards;
            }
            else
            {
                $this->scoreForOtherCards += $cardValue * $sameCards;
            }
        }
    }

    /**
     * Is Pair in hand
     * @return bool
     */
    public function isPair()
    {
        return $this->isSameValues(2);
    }

    /**
     * Is two pairs in hand
     * @return bool
     */
    public function isTwoPairs()
    {
        $pairsNumber = 0;
        foreach ($this->handCardsSorted as $cardValue => $sameCards)
        {
            if ($sameCards >= 2)
            {
                $pairsNumber++;
            }
        }

        return $pairsNumber >= 2; // More than two pairs :)
    }

    /**
     * Is Three of a kind in hand
     * @return bool
     */
    public function isThreeOfaKind()
    {
        return $this->isSameValues(3);
    }

    /**
     * Is full house in the hand
     * @return bool
     */
    public function isFullHouse()
    {
        $pair = false;
        $three = false;

        foreach ($this->handCardsSorted as $cardValue => $sameCards)
        {
            if ($sameCards == 2)
            {
                $pair = true;
            }

            if ($sameCards == 3)
            {
                $three = true;
            }
        }

        return $pair and $three;
    }

    /**
     * Is flush in hand
     * @return bool
     */
    public function isFlush()
    {
        return $this->isSameSuits($this->handCards);
    }

    /**
     * Is four of a kind in hand
     * @return bool
     */
    public function isFourOfaKind()
    {
        return $this->isSameValues(4);
    }

    /**
     * Is straight in a hand
     * @return bool
     */
    public function isStraightFlush()
    {
        return $this->isStraight() and $this->isSameSuits($this->handCards);
    }

    /**
     * Helper function to check is same cards in hand
     * Use for pairs, three or four same in a hand
     * @param int $howMuchCards
     * @return bool
     */
    private function isSameValues($howMuchCards = 2)
    {
        foreach ($this->handCardsSorted as $cardValue => $sameCards)
        {
            if ($sameCards >= $howMuchCards)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Is straight in a hand
     * @return bool
     */
    public function isStraight()
    {
        $cardInHand = count($this->handCards);
        $straight = $this->differentCards == $cardInHand;

        if ($straight)
        {
            $prevCardValue= null;
            foreach ($this->handCardsSorted as $cardValue => $cardNumbers)
            {
                if ( ! is_null($prevCardValue) and ( $prevCardValue + 1 != $cardValue))
                {
                    $straight = false;
                    break;
                }

                $prevCardValue = $cardValue;
            }
        }

        return $straight;
    }

    /**
     * Is same suits in card array
     * @param $cards
     * @return bool
     */
    private function isSameSuits($cards)
    {
        $cardsInHand = count($cards);

        $same = true;
        for ($i=1; $i<$cardsInHand; $i++)
        {
            if ($cards[$i-1]->getSuit() != $cards[$i]->getSuit())
            {
                $same = false;
            }
        }

        return $same;
    }

    /**
     * Get different cards
     * @return int
     */
    public function getDifferentCards()
    {
        return $this->differentCards;
    }


    function rewind() {

        $this->position = 0;
    }

    function current() {

        return $this->handCards[$this->position];
    }

    function key() {

        return $this->position;
    }

    function next() {

        ++$this->position;
    }

    function valid() {

        return isset($this->handCards[$this->position]);
    }
}