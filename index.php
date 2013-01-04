<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/29/12
 * Time: 11:49 PM
 * To change this template use File | Settings | File Templates.
 */

error_reporting(E_ALL);
include 'day06/src/list.php';



$list = new ReadList(5);

$list->add('32323');
$list->add('Dobrop je');

foreach ($list as $item)
{
    var_dump($item);
}