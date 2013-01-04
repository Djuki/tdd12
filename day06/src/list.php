<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/3/13
 * Time: 6:44 PM
 * To change this template use File | Settings | File Templates.
 */


class EmptyItemException extends Exception {}
class DuplicateItemException extends Exception {}

class ReadList implements Iterator
{
    /**
     * List with read stuff LIFO type
     * @var array
     */
    private $readList = array();

    /**
     * List capacity
     * @var
     */
    private $capacity;

    /**
     * Position
     * @var
     */
    private $position;

    /**
     * Construct ReadLust with capacity
     * @param $capacity
     */
    public function __construct($capacity = false)
    {
        $this->capacity = $capacity;
        $this->position = 0;
    }

    /**
     * Is ReadList empty
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->readList);
    }

    /**
     * Add item into ReadList
     * @param $item
     * @throws DuplicateItemException
     * @throws EmptyItemException
     */
    public function add($item)
    {
        if (empty($item))
        {
            throw new EmptyItemException('Item can\'t be empty.');
        }

        if (in_array($item, $this->readList))
        {
            throw new DuplicateItemException('Can\'t have duplicate items in list');
        }

        $this->readList[] = $item;
    }

    /**
     * Read and remove item from list
     * LIFO
     * @return string
     */
    public function read()
    {
        if (($position = count($this->readList)) == 0)
        {
            return '';
        }

        $read = $this->readList[$position - 1];
        unset($this->readList[$position - 1]);

        return $read;
    }

    /**
     * Read and remove item from list
     * @param $index
     * @return bool
     */
    public function getByIndex($index)
    {
        if (array_key_exists($index, $this->readList))
        {
            $read = $this->readList[$index];
            unset($this->readList[$index]);

            return $read;
        }

        return false;
    }

    function rewind() {

        $this->position = 0;
    }

    function current() {

        return $this->readList[$this->position];
    }

    function key() {

        return $this->position;
    }

    function next() {

        ++$this->position;
    }

    function valid() {

        return isset($this->readList[$this->position]);
    }
}