<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 7:01 PM
 * To change this template use File | Settings | File Templates.
 */

class DoubleRange extends Range
{
    /**
     * Create Range object
     * @param $from
     * @param $to
     */
    public function __construct($from, $to)
    {
        $this->from = (float)$from;

        $this->to = (float)$to;
    }
}