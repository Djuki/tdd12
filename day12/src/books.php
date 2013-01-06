<?php
/**
 * Created by JetBrains PhpStorm.
 * User: djuki
 * Date: 1/6/13
 * Time: 10:43 PM
 * To change this template use File | Settings | File Templates.
 */

class HarryBooks
{
    /**
     * Book codes
     * @var array
     */
    protected $books = array(
        1 => 'First Book',
        2 => 'Second Book',
        3 => 'Third Book',
        4 => 'Fourth Book',
        5 => 'Fifth Book',
    );

    /**
     * Store basket
     * @var array
     */
    protected $basket = array();


    /**
     * Buy Harry Potter's book
     * @param $bookId
     * @param $quantity
     */
    public function buyBook($bookId, $quantity = 1)
    {
        if ( ! isset($this->basket[$bookId]))
        {
            $this->basket[$bookId] = 0;
        }

        $this->basket[$bookId] += $quantity;
    }

    /**
     * Get Lowest price as can
     * @return mixed
     */
    public function getLowestPrice()
    {
        $booksInBasket = count($this->basket); // Different books in basket

        $calculatedPrices = array();

        for ($i=$booksInBasket; $i>=1; $i--)
        {

            $groups = $this->combineGroups($i);

            $calculatedPrices[] = $this->calculateDiscount($groups);
        }

        return min($calculatedPrices);
    }

    /**
     * Group books
     *
     * @param $maxBooksInGroup
     * @return array
     */
    private function combineGroups($maxBooksInGroup)
    {
        $copyBasket = $this->basket;
        $groups = array();

        do
        {
            $subGroup = array();
            $itemsInBasket = count($copyBasket);
            $i = 0;

            foreach ($copyBasket as $bookItem => $bookQuantity)
            {

                if (count($subGroup) < $maxBooksInGroup and $bookQuantity > 0)
                {
                    $subGroup[] = $bookItem;
                    $copyBasket[$bookItem]--;
                }

                if ($copyBasket[$bookItem] == 0)
                {
                    //echo 'unset for'. $bookItem."\n";
                    unset($copyBasket[$bookItem]);
                }
            }

            $groups[] = $subGroup;

        } while ( ! empty($copyBasket));

        return $groups;
    }

    /**
     * Calculate books price in groups with discount
     * @param $groups
     * @return int
     */
    private function calculateDiscount($groups)
    {
        $pricePerBook = 8; // Bad but this is just for this example
        $price = 0;

        foreach ($groups as $group)
        {
            $booksInGroup = count($group);

            if ($booksInGroup <= 1)
            {
                $price +=  $pricePerBook;
                continue;
            }

            $discountForGroup = $this->getDiscount($booksInGroup);
            $priceForGroup = ($booksInGroup * ($pricePerBook - ( ($pricePerBook*$discountForGroup) / 100)));

            $price +=  $priceForGroup;
        }

        return $price;
    }

    /**
     * Get discount
     * In real world we can get discount form DB
     * This is just for TDD learning
     *
     * @param $booksInGroup
     * @return int
     */
    private function getDiscount($booksInGroup)
    {
        switch ($booksInGroup)
        {
            case 5 : return 25;
            case 4 : return 20;
            case 3 : return 10;
            case 2 : return 5;
            default : return 0;
        }
    }



}