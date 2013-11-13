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
        $result = 0;
        switch ($this->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($this->getDaysRented() > 2)
                    $result += ($this->getDaysRented() - 2) * 1.5;
                break;
            case Movie::NEW_RELEASE:
                $result += $this->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($this->getDaysRented() > 3)
                    $result += ($this->getDaysRented() - 3) * 1.5;
                break;

        }
        return $result;
    }

    public function getFrequentRenterPoints()
    {
        if (($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE) && $this->getDaysRented() > 1)
            return 2;
        else
            return 1;
    }
}