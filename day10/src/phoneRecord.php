<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 1:57 PM
 * To change this template use File | Settings | File Templates.
 */

class PhoneRecord
{
    /**
     * First and Last name
     * @var
     */
    protected $name;

    /**
     * Phone number
     * Just numbers and space
     * @var
     */
    protected $phone;

    /**
     * Raw number - just numbers
     * @var
     */
    protected $rawNumber;

    /**
     * Create phone record
     * @param $name
     * @param $number
     */
    public function __construct($name, $number)
    {
        $this->name = $name;

        $this->phone = $number;

        $this->rawNumber = str_replace(' ', '', $number);
    }

    /**
     * Get raw number
     */
    public function getRawNumber()
    {
        return $this->rawNumber;
    }


    /**
     * Check is phone number start with given numbers
     * @param $number
     */
    public function isPhoneStartWith($number)
    {
        return strpos($this->rawNumber, $number) === 0;
    }
}