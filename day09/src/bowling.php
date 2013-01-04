<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 7:32 PM
 * To change this template use File | Settings | File Templates.
 */


class Bowling
{
    /**
     * Get score for game
     * @param $table_score
     */
    public function getScore($table_score)
    {
        list($frames, $bonus) = explode("||", $table_score);

        $bonus_score = $this->getFrameScore($bonus);

        $frames_scores = explode('|', $frames);

        $game_score = 0;
        foreach ($frames_scores as $frame_score)
        {
            $game_score += (int)$this->getFrameScore($frame_score) + (int)$bonus_score;
        }

        return $game_score;
    }

    /**
     * Get score for one frame, two balls
     * @param $score
     * @return int
     */
    private function getFrameScore($score)
    {
        $score = trim($score);

        if ($score == 'X')
        {
            // Hit all frame with one ball
            return 10;
        }

       if ($score = str_split($score))
       {

            if (isset($score[1]) and $score[1] == '/')
            {
                // Hit all with second ball
                return 10;
            }

            $game_score = 0;
            foreach ($score as $scored_pins)
            {
                $game_score += (int)$this->getScoredPins($scored_pins);
            }

            return (int)$game_score;
       }

        return 0;

    }

    /**
     * Get score for one ball hit
     * @param $pins
     * @return int
     */
    private function getScoredPins($pins)
    {
        // Missed pins
        if ($pins == '-')
        {
            return 0;
        }

        // All pins are down
        if ($pins == 'X')
        {
            return 10;
        }

        // Some pins are down
        return $pins;
    }
}