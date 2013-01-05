<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/5/13
 * Time: 1:46 PM
 * To change this template use File | Settings | File Templates.
 */


class PhoneList implements Iterator, Countable
{
    /**
     * Phone list
     * @var array
     */
    protected $list = array();

    /**
     * Add phone record in list
     * @param PhoneRecord $record
     */
    public function add(PhoneRecord $record)
    {
        $this->list[] = $record;
    }

    /**
     * Is list consistent
     * In a consistent phone list no number is a prefix of another.
     */
    public function isConsistent()
    {
        $consistent = true;

        $thisClone = clone($this);
        foreach ($this as $phoneRecord)
        {
            foreach ($thisClone as $phoneRecordCheck)
            {
                if ($phoneRecord->getRawNumber() != $phoneRecordCheck->getRawNumber() and
                    $phoneRecord->isPhoneStartWith($phoneRecordCheck->getRawNumber()))
                {
                    $consistent = false;
                    break;
                }
            }
        }

        return $consistent;
    }



    /**
     * Count list
     * @return int
     */
    public function count()
    {
        return count($this->list);
    }

    /**
     * Position of the list
     * @var int
     */
    private $position = 0;

    function rewind() {

        $this->position = 0;
    }

    function current() {

        return $this->list[$this->position];
    }

    function key() {

        return $this->position;
    }

    function next() {

        ++$this->position;
    }

    function valid() {

        return isset($this->list[$this->position]);
    }
}