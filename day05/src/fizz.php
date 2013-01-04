<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 5:48 PM
 * To change this template use File | Settings | File Templates.
 */


class Fizz
{
    /**
     * Fizzalize number
     * @param $number
     * @return string
     */
    public function fizzalize($number)
    {
        $fizzed = '';

        if ($number % 3 === 0)
        {
            $fizzed .= 'Fizz';
        }

        if ($number % 5 === 0)
        {
            $fizzed .= 'Buzz';
        }

        return empty($fizzed) ? $number : $fizzed;
    }
}