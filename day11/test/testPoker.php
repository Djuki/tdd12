<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 3:41 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/card.php';
include __DIR__.'/../src/hand.php';
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

    /**
     * Test hand basic functionality
     */
    public function testCardHand()
    {
        $hand = new Hand('2H 4S 4C 2D 4H'); // Full house
        $hand_two = new Hand('2H 3S 7C 4D 8H'); // Different cards


        $this->assertEquals(2, $hand->getDifferentCards());

        $this->assertEquals(5, $hand_two->getDifferentCards());
    }

    /**
     * test hand poker detection
     */
    public function testHand()
    {
        $hand = new Hand('3H 2H 4H 6H 5H'); // Straight Flush

        $this->assertTrue($hand->isStraightFlush());
        $this->assertEquals('StraightFlush', $hand->getPokerLevelName());

        $hand_two = new Hand('3H 2D 4H 6C 5H'); // Straight Flush
        $this->assertFalse($hand_two->isStraightFlush());
        $this->assertEquals('Straight', $hand_two->getPokerLevelName());


        $hand_two = new Hand('2H 2D 4H 6C 2H'); // Three of a kind
        $this->assertTrue($hand_two->isThreeOfaKind());
        $this->assertEquals('ThreeOfaKind', $hand_two->getPokerLevelName());

        $hand_two = new Hand('KH KD 4H KC 2H'); // Three of a kind
        $this->assertTrue($hand_two->isThreeOfaKind());
        $this->assertEquals('ThreeOfaKind', $hand_two->getPokerLevelName());

        $hand_two = new Hand('KH KD 4H KC KH'); // four od the same
        $this->assertTrue($hand_two->isFourOfaKind());
        $this->assertEquals('FourOfaKind', $hand_two->getPokerLevelName());

        $hand_two = new Hand('AC KC AC AC AH'); // four of the same
        $this->assertTrue($hand_two->isFourOfaKind());
        $this->assertEquals('FourOfaKind', $hand_two->getPokerLevelName());


        $hand_two = new Hand('AC KC AC AC AH'); // PAIR
        $this->assertTrue($hand_two->isFourOfaKind());
        $this->assertEquals('FourOfaKind', $hand_two->getPokerLevelName());

        $hand_two = new Hand('AC 3C 3C 4C 8H'); // four of the same
        $this->assertFalse($hand_two->isFourOfaKind());
        $this->assertEquals('Pair', $hand_two->getPokerLevelName());


        $hand_two = new Hand('AC AH 4C 4C 8H'); // Two pairs
        $this->assertTrue($hand_two->isTwoPairs());
        $this->assertEquals('TwoPairs', $hand_two->getPokerLevelName());

        $hand_two = new Hand('3H 2D 4H 6C 5C'); // Straight
        $this->assertTrue($hand_two->isStraight());
        $this->assertEquals('Straight', $hand_two->getPokerLevelName());


        $hand_two = new Hand('5C 5D 5H 6C 6D'); // Full House
        $this->assertTrue($hand_two->isFullHouse());
        $this->assertEquals('FullHouse', $hand_two->getPokerLevelName());

        $hand_two = new Hand('3H 2D 4H 6C 5C'); // Straight
        $this->assertFalse($hand_two->isFullHouse());
        $this->assertEquals('Straight', $hand_two->getPokerLevelName());




    }


    /**
     * Test poker level score calculate
     */
    public function testPokerLevel()
    {
        $hand = new Hand('5C 5D 5H 6C 6D'); // Full house
        $hand->calculatePokerLevel();

        $this->assertEquals(7, $hand->getPokerLevelScore());

        $hand_two = new Hand('AC AH 4C 4C 8H'); // Two pairs
        $hand_two->calculatePokerLevel();
        $this->assertEquals(3, $hand_two->getPokerLevelScore());

        $hand_two = new Hand('3H 2H 4H 6H 5H'); // Two pairs
        $hand_two->calculatePokerLevel();
        $this->assertEquals(9, $hand_two->getPokerLevelScore());

        $hand_two = new Hand('2H 4D 5H 7C JH'); // Two pairs
        $hand_two->calculatePokerLevel();
        $this->assertEquals(1, $hand_two->getPokerLevelScore());
    }


    /**
     * Test poker score in hands
     */
    public function testPokerScores()
    {
        $hand = new Hand('5C 5D 6H 6C 5D');

        $this->assertEquals(27, $hand->getScoreInHands());
        $this->assertEquals(0, $hand->getScoreForOtherCards());

        $hand = new Hand('AC AH 4C 4C 8H');

        $this->assertEquals(38, $hand->getScoreInHands());
        $this->assertEquals(8, $hand->getScoreForOtherCards());


        $hand = new Hand('3H 2D 4H 6C 5C');

        $this->assertEquals(20, $hand->getScoreInHands());
        $this->assertEquals(0, $hand->getScoreForOtherCards());

        $hand = new Hand('KH KD KH KC 7C');

        $this->assertEquals(56, $hand->getScoreInHands());
        $this->assertEquals(7, $hand->getScoreForOtherCards());

        $hand = new Hand('7H KD AH 6C 7C');

        $this->assertEquals(14, $hand->getScoreInHands());
        $this->assertEquals(35, $hand->getScoreForOtherCards());


    }

    /**
     * Test game winner
     */
    public function testGame()
    {
        $poker = new Poker();

        $this->assertEquals('white', $poker->playRound('5C 5D 5H 6C 6D', 'AC 3C 3C 4C 8H'));
        $this->assertEquals('black', $poker->playRound('3H 2D 4H 6C 5C', '3H 2H 4H 6H 5H'));
        $this->assertEquals('tie', $poker->playRound('2C 2D 7H 8C 9D', '2C 7C 9H 8C 2D'));
        $this->assertEquals('tie', $poker->playRound('2H 3D 5S 9C KD', '2D 3H 5C 9S KH'));
    }
}