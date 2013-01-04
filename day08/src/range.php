<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 5:27 PM
 * To change this template use File | Settings | File Templates.
 */

abstract class Range
{

    /**
     * Range is this number ang greater
     * @var int
     */
    protected $from;

    /**
     * Range is this number and lower
     * @var int
     */
    protected $to;

    /**
     * Get from
     * @return int
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get to
     * @return int
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Is number in range
     * @param $number
     * @return bool
     */
    public function isInRange($number)
    {
        return ($number >= $this->from) and ($number <= $this->to);
    }

    /**
     * Range intersection
     * @param Range $range
     * @return bool|Range
     */
    public function intersection (Range $range)
    {
        $first_range = range((int)$this->from, (int)$this->to);
        $second_range = range((int)$range->getFrom(), (int)$range->getTo());

        if ($intersection = array_intersect($first_range, $second_range))
        {
            return new static(min($intersection), max($intersection));
        }

        return false;

    }

}