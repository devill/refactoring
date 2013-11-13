<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 10:48 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Refactoring;


class Rental
{

    private $movie;
    private $daysRented;

    function __construct($movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented()
    {
        return $this->daysRented;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    public function getCharge()
    {
        return $this->getMovie()->getCharge($this->getDaysRented());
    }

    public function getFrequentRenterPoints()
    {
        if (($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE) && $this->getDaysRented() > 1)
            return 2;
        else
            return 1;
    }
}