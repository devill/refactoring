<?php

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
        return $this->getMovie()->getFrequentRenterPoints($this->getDaysRented());
    }
}