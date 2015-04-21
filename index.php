<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan
 * Date: 12/29/12
 * Time: 11:49 PM
 * To change this template use File | Settings | File Templates.
 */

error_reporting(E_ALL);
include 'day11/src/card.php';
include 'day11/src/poker.php';


$poker = new Poker();

$poker->playRound('2C 3H 4S 8C AH', '2H 3D 5S 9C KD');
