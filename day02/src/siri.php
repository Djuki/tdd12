<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/29/12
 * Time: 11:11 PM
 * To change this template use File | Settings | File Templates.
 */

class Siri
{
    /**
     * Digits represent numbers
     * @var array
     */
    protected $digits = array(
        0 => '',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    );


    /**
     * Represent tens
     * @var array
     */
    protected $tens = array(
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
    );

    /**
     * Represent large number groups
     * @var array
     */
    protected $digitsGroup = array(
        1 => '',
        2 => 'thousand',
        3 => 'million',
        4 => 'billion',
        5 => 'trillion',
        6 => 'quadrillion',
        7 => 'quintillion',
        8 => 'sextillion',
        9 => 'septillion',
        10 => 'octillion',
        11 => 'nonillion',
        12 => 'decillion',
    );


    /**
     * Turns number into words
     * @param $input_number
     * @return string
     */
    public function say($input_number)
    {
        $input_number = $this->clear($input_number);
        $groups = str_split((string) $input_number, 3);

        $count_groups = count($groups);
        $words = '';
        foreach ($groups as $level => $group)
        {
            $words .= $this->sayGroup($group);

            if ($count_groups > 1)
            {
                $words .= ' '.$this->digitsGroup[$count_groups].', ';
            }
            --$count_groups;
        }

        return $words;
    }

    /**
     * Say for one single number
     * @param $number
     * @return mixed
     */
    private function saySingle($number)
    {
        return $this->digits[(int)$number];
    }

    /**
     * Say for group of three numbers
     * @param $group
     * @return mixed|string
     */
    private function sayGroup($group)
    {

        $digits = str_split($group);

        if ($digits[0] == 0 and $digits[1] == 0)
        {
            return $this->saySingle($digits[2]);
        }

        if ($digits[0] == 0)
        {
            return $this->sayTens($digits[1], $digits[2]);
        }

        $say = $this->saySingle($digits[0]).' hundred';

        if ($digits[1] != 0 or $digits[2] != 0)
        {
            $say .= ' and '.$this->sayTens($digits[1], $digits[2]);
        }

        return $say;
    }

    /**
     * Say for tens, group of two numbers
     * @param $tens
     * @param $single
     * @return mixed|string
     */
    private function sayTens($tens, $single)
    {
        if ($tens == 0 and $single != 0)
        {
            return $this->saySingle($single);
        }

        if ($tens.$single == '00')
        {
            return '';
        }

        if (isset($this->tens[$tens.$single]))
        {
            return $this->tens[$tens.$single];
        }

        return $this->tens[(string)$tens.'0'].' '.$this->saySingle($single).'';
    }

    /**
     * Clear and prepare number for converting
     * @param $input_number
     * @return mixed|string
     */
    private function clear($input_number)
    {

        $input_number = str_replace(',', '', $input_number);

        $length = strlen((string)$input_number);
        $left = $length % 3;
        $pad = 3 - $left;

        if ($left == 0)
        {
            return $input_number;
        }

        return str_pad($input_number, $length + (3 - $left), '0', STR_PAD_LEFT);
    }
}

