<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/28/12
 * Time: 11:17 PM
 * To change this template use File | Settings | File Templates.
 */


class CalcStat
{
    /**
     * Range
     * @var array
     */
    protected $range = array();

    /**
     * Constructor create range object
     * @param array $range
     */
    public function __construct(array $range)
    {
        $this->range = $range;
    }


    /**
     * Get min value
     * @return mixed
     */
    public function minValue()
    {
        return min($this->range);
    }

    /**
     * Get max value from range
     * @return mixed
     */
    public function maxValue()
    {
        return max($this->range);
    }

    /**
     * Count items in range
     * @return int
     */
    public function count()
    {
        return count($this->range);
    }

    /**
     * Get average value of items
     * @return float
     */
    public function averageValue()
    {
        $count = $this->count();
        $sum = array_sum($this->range);

        return round($sum / $count, 2);
    }
}