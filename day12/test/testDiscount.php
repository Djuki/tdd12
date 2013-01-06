<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/6/13
 * Time: 10:45 PM
 * To change this template use File | Settings | File Templates.
 */

include __DIR__.'/../src/books.php';

class TestDiscount extends PHPUnit_Framework_TestCase
{
    /**
     * Test discount
     */
    public function testDiscount()
    {
        $books = new HarryBooks();

        $books->buyBook(1, 2);
        $books->buyBook(2, 2);
        $books->buyBook(3, 2);
        $books->buyBook(4, 1);
        $books->buyBook(5, 1);

        $this->assertEquals(51.2, $books->getLowestPrice());
    }

    /**
     * Test one book
     */
    public function testOneBook()
    {
        $books = new HarryBooks();

        $books->buyBook(2, 1);

        $this->assertEquals(8, $books->getLowestPrice());
    }

    /**
     * Test two same books
     */
    public function testTwoBooks()
    {
        $books = new HarryBooks();

        $books->buyBook(3, 2);

        $this->assertEquals(16, $books->getLowestPrice());

        $books = new HarryBooks();

        $books->buyBook(1, 1);
        $books->buyBook(2, 1);

        $this->assertEquals(15.2, $books->getLowestPrice());
    }
}