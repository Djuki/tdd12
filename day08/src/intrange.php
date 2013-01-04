<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/4/13
 * Time: 7:08 PM
 * To change this template use File | Settings | File Templates.
 */

class IntegerRange extends Range
{
    /**
     * Create Range object
     * @param $from
     * @param $to
     */
    public function __construct($from, $to)
    {
        $this->from = (int)$from;

        $this->to = (int)$to;
    }
}