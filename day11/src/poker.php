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


    public function playRound($whiteCards, $blackCards)
    {
        $playerWhite = new Hand($whiteCards);
        $playerBlack = new Hand($blackCards);

        $level_w = $playerWhite->getPokerLevelScore();
        $level_b = $playerBlack->getPokerLevelScore();


        if ($level_b != $level_w)
        {
            return ($level_b > $level_w) ? 'black' : 'white';
        }

        $hand_score_w =  $playerWhite->getScoreInHands();
        $hand_score_b =  $playerBlack->getScoreInHands();

        if ($hand_score_b != $hand_score_w)
        {
            return ($hand_score_b > $hand_score_w) ? 'black' : 'white';
        }

        $score_other_w = $playerWhite->getScoreForOtherCards();
        $score_other_b = $playerBlack->getScoreForOtherCards();

        if ($score_other_b != $score_other_w)
        {
            return ($score_other_b > $score_other_w) ? 'black' : 'white';
        }

        return 'tie';
    }
}